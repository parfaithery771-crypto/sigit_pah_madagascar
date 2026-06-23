<?php
declare(strict_types=1);
namespace App\Controller;
class UsersController extends AppController
{
    public function login()
    {
        if (!$this->request->is("post")) {
            return $this->redirect("/");
        }
        $data = $this->request->getData();
        $email = trim($data["email"] ?? "");
        $password = $data["password"] ?? "";
        if (empty($email) || empty($password)) {
            $this->Flash->error("Remplissez tous les champs.");
            return $this->redirect("/");
        }
        $Users = $this->getTableLocator()->get("Users");
        $user = $Users->find()->where(["email" => $email])->first();
        if ($user && password_verify($password, $user->password)) {
            if (($user->status ?? "approved") === "pending") {
                $this->Flash->error("Votre compte est en attente d approbation par l administrateur.");
                return $this->redirect("/");
            }
            if (($user->status ?? "approved") === "refused") {
                $this->Flash->error("Votre demande a ete refusee. Contactez l administrateur.");
                return $this->redirect("/");
            }
            $session = $this->request->getSession();
            $session->write("Auth.id", $user->id);
            $session->write("Auth.nom", $user->nom);
            $session->write("Auth.email", $user->email);
            $session->write("Auth.role", $user->role);
            $session->write("Auth.loggedIn", true);
            $session->write("Auth.avatar", $user->avatar ?? "");
            return $this->redirect("/dashboard");
        }
        $this->Flash->error("Email ou mot de passe incorrect.");
        return $this->redirect("/");
    }

    public function register()
    {
        if ($this->request->is("post")) {
            $data = $this->request->getData();
            $password = $data["password"] ?? "";
            if (strlen($password) < 8) {
                $this->Flash->error("Le mot de passe doit contenir au moins 8 caracteres.");
                return $this->redirect("/");
            }
            if (!preg_match('/[A-Z]/', $password)) {
                $this->Flash->error("Le mot de passe doit contenir au moins une majuscule.");
                return $this->redirect("/");
            }
            if (!preg_match('/[0-9]/', $password)) {
                $this->Flash->error("Le mot de passe doit contenir au moins un chiffre.");
                return $this->redirect("/");
            }
            if (!preg_match('/[^a-zA-Z0-9]/', $password)) {
                $this->Flash->error("Le mot de passe doit contenir au moins un caractere special.");
                return $this->redirect("/");
            }
            $Users = $this->getTableLocator()->get("Users");
            $existing = $Users->find()->where(["email" => $data["email"]])->first();
            if ($existing) {
                $this->Flash->error("Email deja utilise.");
                return $this->redirect("/");
            }
            $user = $Users->newEntity([
                "nom"      => $data["nom"],
                "prenom"   => $data["prenom"] ?? "",
                "email"    => $data["email"],
                "password" => password_hash($password, PASSWORD_DEFAULT),
                "role"     => "technicien",
                "status"   => "pending",
            ]);
            if ($Users->save($user)) {
                $this->Flash->success("Demande envoyee ! Attendez l approbation de l administrateur.");
                return $this->redirect("/");
            }
            $this->Flash->error("Erreur inscription.");
        }
        return $this->redirect("/");
    }

    public function logout()
    {
        $this->request->getSession()->destroy();
        return $this->redirect("/");
    }

    public function forgot()
    {
        $this->render("/Pages/home");
    }

    public function profile()
    {
        $redirect = $this->requireLogin();
        if ($redirect) return $redirect;
        $session = $this->request->getSession();
        $userId = $session->read("Auth.id");
        if (!$userId) return $this->redirect("/");
        $Users = $this->getTableLocator()->get("Users");
        $user = $Users->find()->where(["id" => $userId])->first();
        if (!$user) return $this->redirect("/users/logout");
        $session->write("Auth.avatar", $user->avatar ?? "");
        $this->set("user", $user);
    }

    public function changePassword()
    {
        $redirect = $this->requireLogin();
        if ($redirect) return $redirect;
        if ($this->request->is("post")) {
            $data = $this->request->getData();
            $newPwd = $data["new_password"] ?? "";
            $confirmPwd = $data["confirm_password"] ?? "";
            if (empty($newPwd) || strlen($newPwd) < 8) {
                $this->Flash->error("Mot de passe trop court (min 8 caracteres).");
                return $this->redirect("/users/profile");
            }
            if (!preg_match('/[A-Z]/', $newPwd)) {
                $this->Flash->error("Le mot de passe doit contenir au moins une majuscule.");
                return $this->redirect("/users/profile");
            }
            if (!preg_match('/[0-9]/', $newPwd)) {
                $this->Flash->error("Le mot de passe doit contenir au moins un chiffre.");
                return $this->redirect("/users/profile");
            }
            if (!preg_match('/[^a-zA-Z0-9]/', $newPwd)) {
                $this->Flash->error("Le mot de passe doit contenir au moins un caractere special.");
                return $this->redirect("/users/profile");
            }
            if ($newPwd !== $confirmPwd) {
                $this->Flash->error("Mots de passe differents.");
                return $this->redirect("/users/profile");
            }
            $session = $this->request->getSession();
            $Users = $this->getTableLocator()->get("Users");
            $userId = $session->read("Auth.id");
            if (!$userId) return $this->redirect("/");
            $user = $Users->find()->where(["id" => $userId])->first();
            if (!$user) return $this->redirect("/users/logout");
            $user->password = password_hash($newPwd, PASSWORD_DEFAULT);
            if ($Users->save($user)) {
                $this->Flash->success("Mot de passe modifie avec succes.");
            } else {
                $this->Flash->error("Erreur modification.");
            }
        }
        return $this->redirect("/users/profile");
    }

    public function uploadAvatar()
    {
        $redirect = $this->requireLogin();
        if ($redirect) return $redirect;
        try {
            if ($this->request->is("post")) {
                $file = $this->request->getUploadedFile("avatar");
                if ($file && $file->getError() === UPLOAD_ERR_OK) {
                    $ext = strtolower(pathinfo($file->getClientFilename(), PATHINFO_EXTENSION));
                    $allowed = ["jpg","jpeg","png","gif","webp"];
                    if (!in_array($ext, $allowed)) {
                        $this->Flash->error("Format non supporte. Utilisez JPG ou PNG.");
                        return $this->redirect("/users/profile");
                    }
                    if ($file->getSize() > 2 * 1024 * 1024) {
                        $this->Flash->error("Image trop grande. Maximum 2MB.");
                        return $this->redirect("/users/profile");
                    }
                    $session = $this->request->getSession();
                    $userId = $session->read("Auth.id");
                    $filename = "avatar_" . $userId . "_" . time() . "." . $ext;
                    $uploadDir = WWW_ROOT . "uploads" . DS . "avatars";
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }
                    $uploadPath = $uploadDir . DS . $filename;
                    $file->moveTo($uploadPath);
                    $Users = $this->getTableLocator()->get("Users");
                    $user = $Users->find()->where(["id" => $userId])->first();
                    if (!$user) return $this->redirect("/users/profile");
                    $old = $user->avatar ?? "";
                    if ($old && file_exists($uploadDir . DS . $old)) {
                        unlink($uploadDir . DS . $old);
                    }
                    $user->avatar = $filename;
                    if ($Users->save($user)) {
                        $session->write("Auth.avatar", $filename);
                        $this->Flash->success("Photo de profil mise a jour.");
                    } else {
                        $this->Flash->error("Erreur sauvegarde: " . json_encode($user->getErrors()));
                    }
                } else {
                    $this->Flash->error("Aucun fichier selectionne.");
                }
            }
        } catch (\Exception $e) {
            $this->Flash->error("Exception: " . $e->getMessage());
        }
        return $this->redirect("/users/profile");
    }

    public function add()
    {
        return $this->redirect("/");
    }

    public function index()
    {
        $redirect = $this->requireAdmin();
        if ($redirect) return $redirect;
        $Users = $this->getTableLocator()->get("Users");
        $users = $Users->find()->orderBy(["id" => "DESC"])->toArray();
        $this->set("users", $users);
    }

    public function approve($id = null)
    {
        $redirect = $this->requireAdmin();
        if ($redirect) return $redirect;
        $Users = $this->getTableLocator()->get("Users");
        $user = $Users->find()->where(["id" => $id])->first();
        if ($user) {
            $user->status = "approved";
            $Users->save($user);
            $this->Flash->success("Utilisateur approuve.");
        }
        return $this->redirect("/admin/users");
    }

    public function refuse($id = null)
    {
        $redirect = $this->requireAdmin();
        if ($redirect) return $redirect;
        $Users = $this->getTableLocator()->get("Users");
        $user = $Users->find()->where(["id" => $id])->first();
        if ($user) {
            $user->status = "refused";
            $Users->save($user);
            $this->Flash->error("Utilisateur refuse.");
        }
        return $this->redirect("/admin/users");
    }

    public function testlogin()
    {
        $this->autoRender = false;
        $session = $this->request->getSession();
        $session->write("Auth.loggedIn", true);
        $session->write("Auth.nom", "Admin");
        $session->write("Auth.id", 1);
        $session->write("Auth.role", "admin");
        $session->write("Auth.avatar", "");
        echo "SESSION OK! <a href=/dashboard>=> Dashboard</a>";
        exit;
    }
}