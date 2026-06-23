<?php $this->disableAutoLayout(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>SIGIT - Code de verification</title>
<style>
*{margin:0;padding:0;box-sizing:border-box}
body{background:radial-gradient(ellipse at top,#1a1200,#000);min-height:100vh;display:flex;align-items:center;justify-content:center;font-family:Georgia,serif;color:#FAF8F2}
.box{background:linear-gradient(135deg,#1c1500,#261d00);border:1px solid rgba(200,150,62,0.3);border-radius:16px;padding:2.5rem;width:min(420px,90vw);text-align:center}
.logo{font-size:1.5rem;font-weight:bold;color:#C8963E;margin-bottom:0.3rem;letter-spacing:0.1em}
.sub{font-size:0.75rem;color:rgba(250,248,242,0.4);margin-bottom:2rem}
h2{color:#FAF8F2;font-size:1.1rem;margin-bottom:0.5rem}
p{color:rgba(250,248,242,0.6);font-size:0.85rem;margin-bottom:1.5rem}
.code-inputs{display:flex;gap:0.5rem;justify-content:center;margin-bottom:1.5rem}
.code-inputs input{width:45px;height:55px;text-align:center;font-size:1.5rem;font-weight:bold;background:rgba(255,255,255,0.05);border:2px solid rgba(200,150,62,0.3);border-radius:8px;color:#FAF8F2;transition:border-color 0.2s}
.code-inputs input:focus{outline:none;border-color:#C8963E;background:rgba(200,150,62,0.08)}
.btn{width:100%;background:linear-gradient(135deg,#C8963E,#964B00);border:none;border-radius:8px;padding:0.85rem;color:#FAF8F2;font-size:0.95rem;cursor:pointer;font-family:inherit;margin-bottom:1rem}
.btn:hover{opacity:0.9}
.back{color:rgba(200,150,62,0.6);font-size:0.8rem;text-decoration:none}
.message{padding:0.75rem;border-radius:8px;margin-bottom:1rem;font-size:0.85rem}
.message.success{background:rgba(45,140,78,0.2);border:1px solid rgba(45,140,78,0.4);color:#5EC878}
.message.error{background:rgba(200,16,46,0.2);border:1px solid rgba(200,16,46,0.4);color:#E06060}
</style>
</head>
<body>
<div class="box">
  <div class="logo">? SIGIT ?</div>
  <div class="sub">Ministere du Commerce et de la Consommation</div>
  <?= $this->Flash->render() ?>
  <h2>&#128274; Verification du code</h2>
  <p>Entrez le code a 6 chiffres envoye a votre email</p>
  <form method="post" action="/users/reset-code">
    <div class="code-inputs">
      <input type="text" maxlength="1" class="code-digit" autofocus>
      <input type="text" maxlength="1" class="code-digit">
      <input type="text" maxlength="1" class="code-digit">
      <input type="text" maxlength="1" class="code-digit">
      <input type="text" maxlength="1" class="code-digit">
      <input type="text" maxlength="1" class="code-digit">
    </div>
    <input type="hidden" name="code" id="full-code">
    <button type="submit" class="btn" onclick="assembleCode()">&#10003; Verifier le code</button>
  </form>
  <a href="/" class="back">&#8592; Retour a la connexion</a>
</div>
<script>
var digits = document.querySelectorAll('.code-digit');
digits.forEach(function(d, i){
    d.addEventListener('input', function(){
        if(this.value && i < digits.length-1) digits[i+1].focus();
    });
    d.addEventListener('keydown', function(e){
        if(e.key==='Backspace' && !this.value && i > 0) digits[i-1].focus();
    });
});
function assembleCode(){
    var code = '';
    digits.forEach(function(d){ code += d.value; });
    document.getElementById('full-code').value = code;
}
</script>
</body>
</html>