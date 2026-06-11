<?php
declare(strict_types=1);
namespace App\Controller;
class UsersController extends AppController
{
    public function login()
    {
        if ($this->request->is("post")) {
            $data = $this->request->getData();
            $email = trim($data["email"] ?? "");
            $password = $data["password"] ?? "";
            if (empty($email) || empty($password)) {
                $this->Flash->error("Remplissez tous les champs.");
                return;
            }
            $Users = $this->getTableLocator()->get("Users");
            $user = $Users->find()->where(["email" => $email])->first();
            if ($user && password_verify($password, $user->password)) {
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
            return;
        }
    }

    public function register()
    {
        if ($this->request->is("post")) {
            $data = $this->request->getData();
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
                "password" => password_hash($data["password"], PASSWORD_DEFAULT),
                "role"     => "technicien",
            ]);
            if ($Users->save($user)) {
                $session = $this->request->getSession();
                $session->write("Auth.id", $user->id);
                $session->write("Auth.nom", $user->nom);
                $session->write("Auth.email", $user->email);
                $session->write("Auth.role", $user->role);
                $session->write("Auth.loggedIn", true);
                $session->write("Auth.avatar", "");
                return $this->redirect("/dashboard");
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
        $Users = $this->getTableLocator()->get("Users");
        $user = $Users->get($session->read("Auth.id"));
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
            if (empty($newPwd) || strlen($newPwd) < 6) {
                $this->Flash->error("Mot de passe trop court.");
                return $this->redirect("/users/profile");
            }
            if ($newPwd !== $confirmPwd) {
                $this->Flash->error("Mots de passe differents.");
                return $this->redirect("/users/profile");
            }
            $session = $this->request->getSession();
            $Users = $this->getTableLocator()->get("Users");
            $user = $Users->get($session->read("Auth.id"));
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
                $uploadPath = WWW_ROOT . "uploads" . DS . "avatars" . DS . $filename;
                $file->moveTo($uploadPath);
                $Users = $this->getTableLocator()->get("Users");
                $user = $Users->get($userId);
                $old = $user->avatar ?? "";
                if ($old && file_exists(WWW_ROOT . "uploads" . DS . "avatars" . DS . $old)) {
                    unlink(WWW_ROOT . "uploads" . DS . "avatars" . DS . $old);
                }
                $user->avatar = $filename;
                if ($Users->save($user)) {
                    $session->write("Auth.avatar", $filename);
                    $this->Flash->success("Photo de profil mise a jour.");
                } else {
                    $this->Flash->error("Erreur lors de la sauvegarde.");
                }
            } else {
                $this->Flash->error("Aucun fichier selectionne.");
            }
        }
        return $this->redirect("/users/profile");
    }

    public function add()
    {
        return $this->redirect("/");
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