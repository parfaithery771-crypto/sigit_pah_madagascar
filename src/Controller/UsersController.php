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
            return $this->redirect("/?modal=login");
        }
        $Users = $this->getTableLocator()->get("Users");
        $user = $Users->find()->where(["email" => $email])->first();
        if ($user && password_verify($password, $user->password)) {
            if (($user->status ?? "approved") === "pending") {
                $this->Flash->error("Votre compte est en attente d approbation par l administrateur.");
                return $this->redirect("/?modal=login");
            }
            if (($user->status ?? "approved") === "refused") {
                $this->Flash->error("Votre demande a ete refusee. Contactez l administrateur.");
                return $this->redirect("/?modal=login");
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
        return $this->redirect("/?modal=login");
    }

    public function register()
    {
        if ($this->request->is("post")) {
            $data = $this->request->getData();
            $password = $data["password"] ?? "";
            if (strlen($password) < 8) {
                $this->Flash->error("Le mot de passe doit contenir au moins 8 caracteres.");
                return $this->redirect("/?modal=inscrire");
            }
            if (!preg_match('/[A-Z]/', $password)) {
                $this->Flash->error("Le mot de passe doit contenir au moins une majuscule.");
                return $this->redirect("/?modal=inscrire");
            }
            if (!preg_match('/[0-9]/', $password)) {
                $this->Flash->error("Le mot de passe doit contenir au moins un chiffre.");
                return $this->redirect("/?modal=inscrire");
            }
            if (!preg_match('/[^a-zA-Z0-9]/', $password)) {
                $this->Flash->error("Le mot de passe doit contenir au moins un caractere special.");
                return $this->redirect("/?modal=inscrire");
            }
            $Users = $this->getTableLocator()->get("Users");
            $existing = $Users->find()->where(["email" => $data["email"]])->first();
            if ($existing) {
                $this->Flash->error("Email deja utilise.");
                return $this->redirect("/?modal=inscrire");
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
                return $this->redirect("/?modal=login");
            }
            $this->Flash->error("Erreur inscription.");
            return $this->redirect("/?modal=inscrire");
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
        if ($this->request->is("post")) {
            $email = trim($this->request->getData("email") ?? "");
            $Users = $this->getTableLocator()->get("Users");
            $user = $Users->find()->where(["email" => $email])->first();
            if ($user) {
                $code = str_pad((string)random_int(0, 999999), 6, "0", STR_PAD_LEFT);
                $expires = date("Y-m-d H:i:s", strtotime("+15 minutes"));
                $user->reset_token = $code;
                $user->reset_expires = $expires;
                $Users->save($user);
                try {
                    $gmailUser = env("GMAIL_USER", "parfaithery771@gmail.com");
                    $gmailPass = env("GMAIL_PASS", "bbyyicypfixpdnpa");
                    $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
                    $mail->isSMTP();
                    $mail->Host       = "smtp.gmail.com";
                    $mail->SMTPAuth   = true;
                    $mail->Username   = $gmailUser;
                    $mail->Password   = $gmailPass;
                    $mail->SMTPSecure = \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port       = 587;
                    $mail->CharSet    = "UTF-8";
                    $mail->setFrom($gmailUser, "SIGIT");
                    $mail->addAddress($email, $user->nom);
                    $mail->isHTML(true);
                    $mail->Subject = "Code de reinitialisation SIGIT";
                    $mail->Body    = "<div style=\"font-family:Arial,sans-serif;max-width:500px;margin:0 auto;background:#1a1200;color:#FAF8F2;padding:2rem;border-radius:12px;border:1px solid rgba(200,150,62,0.3)\"><h2 style=\"color:#C8963E;text-align:center\">SIGIT - Reset Password</h2><p>Bonjour <b>{$user->nom}</b>,</p><p>Voici votre code de reinitialisation :</p><div style=\"text-align:center;font-size:2.5rem;font-weight:bold;color:#C8963E;background:rgba(200,150,62,0.1);padding:1rem;border-radius:8px;letter-spacing:0.5rem;margin:1rem 0\">{$code}</div><p style=\"color:rgba(250,248,242,0.6);font-size:0.85rem\">Ce code expire dans <b>15 minutes</b>.</p><p style=\"color:rgba(250,248,242,0.6);font-size:0.85rem\">Si vous n avez pas demande cette reinitialisation, ignorez cet email.</p><hr style=\"border-color:rgba(200,150,62,0.2)\"><p style=\"text-align:center;color:rgba(250,248,242,0.4);font-size:0.75rem\">Ministere du Commerce et de la Consommation - Madagascar</p></div>";
                    $mail->AltBody = "Votre code SIGIT : {$code} (expire dans 15 minutes)";
                    $mail->send();
                    $this->request->getSession()->write("reset_email", $email);
                    $this->Flash->success("Code envoye a " . $email . " ! Verifiez votre boite mail.");
                    return $this->redirect("/users/reset-code");
                } catch (\Exception $e) {
                    $this->Flash->error("Erreur envoi email: " . $e->getMessage());
                    return $this->redirect("/?modal=forgot");
                }
            } else {
                $this->Flash->success("Si cet email existe, un code a ete envoye.");
                return $this->redirect("/users/reset-code");
            }
        }
        $this->render("/Pages/home");
    }

    public function resetCode()
    {
        if ($this->request->is("post")) {
            $code = trim($this->request->getData("code") ?? "");
            $email = $this->request->getSession()->read("reset_email");
            if (!$email) {
                $this->Flash->error("Session expiree. Recommencez.");
                return $this->redirect("/users/forgot");
            }
            $Users = $this->getTableLocator()->get("Users");
            $user = $Users->find()->where(["email" => $email, "reset_token" => $code])->first();
            if (!$user) {
                $this->Flash->error("Code incorrect.");
                return;
            }
            if (strtotime($user->reset_expires) < time()) {
                $this->Flash->error("Code expire. Recommencez.");
                return $this->redirect("/users/forgot");
            }
            $this->request->getSession()->write("reset_verified", true);
            return $this->redirect("/users/new-password");
        }
    }

    public function newPassword()
    {
        if (!$this->request->getSession()->read("reset_verified")) {
            return $this->redirect("/users/forgot");
        }
        if ($this->request->is("post")) {
            $pwd     = $this->request->getData("password") ?? "";
            $confirm = $this->request->getData("confirm") ?? "";
            if (strlen($pwd) < 8 || !preg_match("/[A-Z]/", $pwd) || !preg_match("/[0-9]/", $pwd) || !preg_match("/[^a-zA-Z0-9]/", $pwd)) {
                $this->Flash->error("Mot de passe trop faible (8 car. min, majuscule, chiffre, special).");
                return;
            }
            if ($pwd !== $confirm) {
                $this->Flash->error("Mots de passe differents.");
                return;
            }
            $email = $this->request->getSession()->read("reset_email");
            $Users = $this->getTableLocator()->get("Users");
            $user  = $Users->find()->where(["email" => $email])->first();
            if ($user) {
                $user->password      = password_hash($pwd, PASSWORD_DEFAULT);
                $user->reset_token   = null;
                $user->reset_expires = null;
                $Users->save($user);
                $this->request->getSession()->delete("reset_email");
                $this->request->getSession()->delete("reset_verified");
                $this->Flash->success("Mot de passe modifie avec succes ! Connectez-vous.");
                return $this->redirect("/?modal=login");
            }
        }
    }

    public function profile()
    {
        $redirect = $this->requireLogin();
        if ($redirect) return $redirect;
        $session = $this->request->getSession();
        $userId  = $session->read("Auth.id");
        if (!$userId) return $this->redirect("/");
        $Users = $this->getTableLocator()->get("Users");
        $user  = $Users->find()->where(["id" => $userId])->first();
        if (!$user) return $this->redirect("/users/logout");
        $session->write("Auth.avatar", $user->avatar ?? "");
        $this->set("user", $user);
    }

    public function changePassword()
    {
        $redirect = $this->requireLogin();
        if ($redirect) return $redirect;
        if ($this->request->is("post")) {
            $data       = $this->request->getData();
            $newPwd     = $data["new_password"] ?? "";
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
            $Users   = $this->getTableLocator()->get("Users");
            $userId  = $session->read("Auth.id");
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
                    $ext     = strtolower(pathinfo($file->getClientFilename(), PATHINFO_EXTENSION));
                    $allowed = ["jpg", "jpeg", "png", "gif", "webp"];
                    if (!in_array($ext, $allowed)) {
                        $this->Flash->error("Format non supporte. Utilisez JPG ou PNG.");
                        return $this->redirect("/users/profile");
                    }
                    if ($file->getSize() > 2 * 1024 * 1024) {
                        $this->Flash->error("Image trop grande. Maximum 2MB.");
                        return $this->redirect("/users/profile");
                    }
                    $session   = $this->request->getSession();
                    $userId    = $session->read("Auth.id");
                    $filename  = "avatar_" . $userId . "_" . time() . "." . $ext;
                    $uploadDir = WWW_ROOT . "uploads" . DS . "avatars";
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }
                    $uploadPath = $uploadDir . DS . $filename;
                    $file->moveTo($uploadPath);
                    $Users = $this->getTableLocator()->get("Users");
                    $user  = $Users->find()->where(["id" => $userId])->first();
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
        $user  = $Users->find()->where(["id" => $id])->first();
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
        $user  = $Users->find()->where(["id" => $id])->first();
        if ($user) {
            $user->status = "refused";
            $Users->save($user);
            $this->Flash->error("Utilisateur refuse.");
        }
        return $this->redirect("/admin/users");
    }

    public function delete($id = null)
    {
        $redirect = $this->requireAdmin();
        if ($redirect) return $redirect;
        $Users = $this->getTableLocator()->get("Users");
        $user  = $Users->find()->where(["id" => $id])->first();
        if ($user) {
            if ($user->role === "admin") {
                $this->Flash->error("Impossible de supprimer un administrateur.");
                return $this->redirect("/admin/users");
            }
            $Users->delete($user);
            $this->Flash->success("Utilisateur supprime.");
        }
        return $this->redirect("/admin/users");
    }

    public function pendingCount()
    {
        $this->autoRender = false;
        if (!$this->isLoggedIn() || !$this->isAdmin()) {
            echo json_encode(["count" => 0]);
            return;
        }
        try {
            $Users = $this->getTableLocator()->get("Users");
            $count = $Users->find()->where(["status" => "pending"])->count();
        } catch (\Exception $e) {
            $count = 0;
        }
        $this->response = $this->response->withType("application/json");
        echo json_encode(["count" => $count]);
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