<?php $this->disableAutoLayout(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>SIGIT - Nouveau mot de passe</title>
<style>
*{margin:0;padding:0;box-sizing:border-box}
body{background:radial-gradient(ellipse at top,#1a1200,#000);min-height:100vh;display:flex;align-items:center;justify-content:center;font-family:Georgia,serif;color:#FAF8F2}
.box{background:linear-gradient(135deg,#1c1500,#261d00);border:1px solid rgba(200,150,62,0.3);border-radius:16px;padding:2.5rem;width:min(420px,90vw)}
.logo{font-size:1.5rem;font-weight:bold;color:#C8963E;margin-bottom:0.3rem;letter-spacing:0.1em;text-align:center}
.sub{font-size:0.75rem;color:rgba(250,248,242,0.4);margin-bottom:2rem;text-align:center}
h2{color:#FAF8F2;font-size:1.1rem;margin-bottom:1.5rem;text-align:center}
label{display:block;color:rgba(250,248,242,0.6);font-size:0.75rem;margin-bottom:0.4rem;text-transform:uppercase;letter-spacing:0.05em}
input{width:100%;background:rgba(255,255,255,0.05);border:1px solid rgba(200,150,62,0.3);border-radius:8px;padding:0.75rem;color:#FAF8F2;font-size:0.9rem;margin-bottom:1rem;font-family:inherit}
input:focus{outline:none;border-color:#C8963E}
.btn{width:100%;background:linear-gradient(135deg,#C8963E,#964B00);border:none;border-radius:8px;padding:0.85rem;color:#FAF8F2;font-size:0.95rem;cursor:pointer;font-family:inherit}
.hint{font-size:0.72rem;color:rgba(250,248,242,0.4);margin-top:-0.75rem;margin-bottom:1rem}
.strength{height:4px;border-radius:2px;margin-top:-0.75rem;margin-bottom:0.75rem;transition:all 0.3s}
</style>
</head>
<body>
<div class="box">
  <div class="logo">? SIGIT ?</div>
  <div class="sub">Ministere du Commerce et de la Consommation</div>
  <?= $this->Flash->render() ?>
  <h2>&#128274; Nouveau mot de passe</h2>
  <form method="post" action="/users/new-password">
    <label>Nouveau mot de passe</label>
    <input type="password" name="password" id="pwd" placeholder="Min. 8 car." required oninput="checkStrength(this.value)">
    <div class="strength" id="strength-bar"></div>
    <div class="hint">8 caracteres min • 1 majuscule • 1 chiffre • 1 special (!@#$%...)</div>
    <label>Confirmer le mot de passe</label>
    <input type="password" name="confirm" placeholder="Confirmer" required>
    <button type="submit" class="btn">&#10003; Changer le mot de passe</button>
  </form>
</div>
<script>
function checkStrength(pwd){
    var bar = document.getElementById('strength-bar');
    var score = 0;
    if(pwd.length >= 8) score++;
    if(/[A-Z]/.test(pwd)) score++;
    if(/[0-9]/.test(pwd)) score++;
    if(/[^a-zA-Z0-9]/.test(pwd)) score++;
    var colors = ['#E06060','#f39c12','#C8963E','#27ae60'];
    var widths = ['25%','50%','75%','100%'];
    bar.style.background = score > 0 ? colors[score-1] : 'transparent';
    bar.style.width = score > 0 ? widths[score-1] : '0';
}
</script>
</body>
</html>