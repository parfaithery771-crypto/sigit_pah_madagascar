<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SIGIT - Connexion</title>
<style>
*{margin:0;padding:0;box-sizing:border-box;}
body{min-height:100vh;background:#0D1B0F;display:flex;align-items:center;justify-content:center;font-family:Georgia,serif;}
.box{background:linear-gradient(135deg,rgba(26,92,46,0.15),rgba(13,27,15,0.95));border:1px solid rgba(200,150,62,0.3);border-radius:16px;padding:2.5rem;width:min(420px,90vw);}
h2{color:#C8963E;text-align:center;letter-spacing:0.1em;margin-bottom:0.25rem;}
.sub{color:rgba(250,248,242,0.45);font-size:0.75rem;text-align:center;font-style:italic;margin-bottom:1.5rem;}
.flash-error{background:rgba(224,96,96,0.15);border:1px solid rgba(224,96,96,0.4);color:#E06060;padding:0.75rem;border-radius:8px;margin-bottom:1rem;font-size:0.85rem;}
label{display:block;color:rgba(250,248,242,0.6);font-size:0.8rem;margin-bottom:0.4rem;}
input[type=email],input[type=password]{width:100%;background:rgba(255,255,255,0.05);border:1px solid rgba(200,150,62,0.3);border-radius:8px;padding:0.75rem;color:#FAF8F2;font-size:0.9rem;outline:none;margin-bottom:1rem;}
input[type=email]:focus,input[type=password]:focus{border-color:rgba(200,150,62,0.7);}
.btn{width:100%;background:linear-gradient(135deg,#2D8C4E,#1a5c2e);border:none;border-radius:8px;padding:0.85rem;color:#FAF8F2;font-size:0.95rem;cursor:pointer;letter-spacing:0.05em;}
.btn:hover{background:linear-gradient(135deg,#3aa05a,#2D8C4E);}
.link{text-align:center;margin-top:1rem;}
.link a{color:rgba(200,150,62,0.7);font-size:0.8rem;text-decoration:none;}
.logo{text-align:center;margin-bottom:1.5rem;}
.logo-title{color:#C8963E;font-size:1.8rem;letter-spacing:0.2em;font-weight:bold;}
.logo-sub{color:rgba(250,248,242,0.4);font-size:0.7rem;letter-spacing:0.1em;}
</style>
</head>
<body>
<div class="box">
  <div class="logo">
    <div class="logo-title">&#9670; SIGIT &#9670;</div>
    <div class="logo-sub">MINISTERE DU NUMERIQUE - MADAGASCAR</div>
  </div>
  <h2>Connexion</h2>
  <p class="sub">Authentification securisee</p>
  <?php if($this->Flash->render()): endif; ?>
  <?= $this->Flash->render() ?>
  <form action="/users/login" method="post">
    <label>Adresse Email</label>
    <input type="email" name="email" placeholder="votre@email.mg" required autofocus>
    <label>Mot de passe</label>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <button type="submit" class="btn">Se Connecter</button>
  </form>
  <div class="link">
    <a href="/">&#8592; Retour a l accueil</a>
  </div>
</div>
</body>
</html>