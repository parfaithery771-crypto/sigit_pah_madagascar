<?php $showOverlay = isset($showOverlay) ? $showOverlay : ""; ?>
<?php $flashMsg = $this->Flash->render(); ?>
<div class="bg-canvas"></div>
<div class="bg-pattern"></div>
<div class="scan-line"></div>
<div class="page">
  <div class="header">
    <div class="logo-box" style="flex-direction:column;align-items:center;border:none;background:none">
      <img src="/img/logo_madagascar.png" style="width:120px;height:auto;object-fit:contain;filter:drop-shadow(0 2px 8px rgba(0,0,0,0.5))">
    </div>
  </div>
  <div class="hero">
    <div class="badge">Systeme d Information</div>
    <h1>SIGIT</h1>
    <div class="ministere-name">Gestion et Suivi des Interventions Informatiques</div>
    <div class="ornament">
      <div class="ornament-line"></div>
      <span style="color:var(--or);font-size:0.6rem">&#9670;</span>
      <div class="ornament-line rev"></div>
    </div>
    <p class="subtitle">Plateforme de supervision des maintenances, reparations et interventions du parc informatique</p>
  </div>
  <div class="buttons-ring">
    <button class="btn-circle" onclick="showOv('login')">
      <div class="btn-circle-ring"></div><div class="btn-circle-inner"></div>
      <div class="btn-icon">&#128274;</div><div class="btn-label">Connexion</div>
    </button>
    <button class="btn-circle" onclick="showOv('apropos')">
      <div class="btn-circle-ring"></div><div class="btn-circle-inner"></div>
      <div class="btn-icon">&#128203;</div><div class="btn-label">A Propos</div>
    </button>
    <button class="btn-circle" onclick="showOv('parametre')">
      <div class="btn-circle-ring"></div><div class="btn-circle-inner"></div>
      <div class="btn-icon">&#9881;</div><div class="btn-label">Parametre</div>
    </button>
    <button class="btn-circle" onclick="showOv('aide')">
      <div class="btn-circle-ring"></div><div class="btn-circle-inner"></div>
      <div class="btn-icon">&#10067;</div><div class="btn-label">Aide</div>
    </button>
  </div>
  <div class="footer-bar">
    <span>SIGIT v1.0</span><div class="footer-dot"></div>
    <span>Repoblikan i Madagasikara</span><div class="footer-dot"></div>
    <span>2025</span>
  </div>
</div>

<div id="ov-login" onclick="if(event.target===this)closeOv()" style="position:fixed;inset:0;background:rgba(10,6,0,0.97);display:none;align-items:center;justify-content:center;z-index:100;backdrop-filter:blur(8px)">
  <div style="background:linear-gradient(135deg,rgba(201,168,76,0.08),rgba(10,6,0,0.97));border:1px solid rgba(200,150,62,0.25);border-radius:16px;padding:2.5rem;width:min(420px,90vw);position:relative;max-height:90vh;overflow-y:auto">
    <button onclick="closeOv()" style="position:absolute;top:1rem;right:1rem;background:none;border:none;color:rgba(250,248,242,0.4);font-size:1.2rem;cursor:pointer">&#10005;</button>
    <div style="text-align:center;margin-bottom:1.5rem">
      <h2 style="color:var(--or);letter-spacing:0.1em">&#9670; SIGIT &#9670;</h2>
      <p style="color:rgba(250,248,242,0.5);font-size:0.75rem;font-style:italic">Authentification securisee</p>
    </div>
    <?= $flashMsg ?>
    <form action="/users/login" method="post">
      <div class="form-group"><label>Email</label><input type="email" name="email" placeholder="votre@email.mg" required></div>
      <div class="form-group"><label>Mot de passe</label><input type="password" name="password" placeholder="........" required></div>
      <input type="submit" value="SE CONNECTER" class="btn-login" style="background:linear-gradient(135deg,#1a5c2e,#2D8C4E,#4caf50) !important;color:#ffffff !important;border:2px solid rgba(45,140,78,0.8) !important;font-weight:800 !important;box-shadow:0 4px 20px rgba(45,140,78,0.55) !important">
    </form>
    <div style="text-align:center;margin:0.75rem 0">
      <a onclick="showOv('forgot')" style="color:rgba(200,150,62,0.7);font-size:0.78rem;text-decoration:none;cursor:pointer">&#128274; Mot de passe oublie ?</a>
    </div>
    <div style="margin-top:0.5rem">
      <button class="btn-inscrire" style="background:linear-gradient(135deg,#1a5c2e,#2D8C4E,#4caf50) !important;color:#ffffff !important;border:2px solid rgba(45,140,78,0.7) !important;font-weight:800 !important;box-shadow:0 4px 20px rgba(45,140,78,0.45) !important" onclick="showOv('inscrire')">&#10010; S inscrire</button>
    </div>
  </div>
</div>

<div id="ov-inscrire" onclick="if(event.target===this)closeOv()" style="position:fixed;inset:0;background:rgba(10,6,0,0.97);display:none;align-items:center;justify-content:center;z-index:100;backdrop-filter:blur(8px)">
  <div style="background:linear-gradient(135deg,rgba(201,168,76,0.08),rgba(10,6,0,0.97));border:1px solid rgba(200,150,62,0.25);border-radius:16px;padding:2.5rem;width:min(420px,90vw);position:relative;max-height:90vh;overflow-y:auto">
    <button onclick="closeOv()" style="position:absolute;top:1rem;right:1rem;background:none;border:none;color:rgba(250,248,242,0.4);font-size:1.2rem;cursor:pointer">&#10005;</button>
    <div style="text-align:center;margin-bottom:1.5rem">
      <h2 style="color:var(--or)">&#9670; SIGIT &#9670;</h2>
      <p style="color:rgba(250,248,242,0.5);font-size:0.75rem;font-style:italic">Creer un nouveau compte</p>
    </div>
    <?= $flashMsg ?>
    <form action="/users/register" method="post">
      <div class="form-group"><label>Nom *</label><input type="text" name="nom" placeholder="Votre nom" required></div>
      <div class="form-group"><label>Prenom</label><input type="text" name="prenom" placeholder="Votre prenom"></div>
      <div class="form-group"><label>Email *</label><input type="email" name="email" placeholder="votre@email.mg" required></div>
      <div class="form-group"><label>Mot de passe *</label><input type="password" name="password" placeholder="........" required></div>
      <input type="submit" value="S inscrire" class="btn-login" style="background:linear-gradient(135deg,#1a5c2e,#2D8C4E,#4caf50) !important;color:#ffffff !important;border:2px solid rgba(45,140,78,0.8) !important;font-weight:800 !important;box-shadow:0 4px 20px rgba(45,140,78,0.55) !important">
    </form>
    <div style="margin-top:1rem;text-align:center">
      <a onclick="showOv('login')" style="cursor:pointer;font-size:0.75rem;color:rgba(250,248,242,0.45)">Deja un compte ? Se connecter</a>
    </div>
  </div>
</div>

<div id="ov-apropos" onclick="if(event.target===this)closeOv()" style="position:fixed;inset:0;background:rgba(10,6,0,0.97);display:none;align-items:center;justify-content:center;z-index:100;backdrop-filter:blur(8px)">
  <div style="background:linear-gradient(135deg,rgba(201,168,76,0.08),rgba(10,6,0,0.97));border:1px solid rgba(200,150,62,0.25);border-radius:16px;padding:2.5rem;width:min(540px,90vw);position:relative">
    <button onclick="closeOv()" style="position:absolute;top:1rem;right:1rem;background:none;border:none;color:rgba(250,248,242,0.4);font-size:1.2rem;cursor:pointer">&#10005;</button>
    <p class="panel-title-h">&#9670; A Propos du Projet</p>
    <div class="divider-line"><span>SIGIT v1.0 - 2025/2026</span></div>
    <p style="font-size:0.88rem;line-height:1.7;color:rgba(250,248,242,0.75);margin-bottom:1rem">Le <b style="color:#C8963E">SIGIT</b> est une plateforme numerique developpee pour la <b>Direction des Systemes d Information (DSI)</b> du Ministere du Commerce et de la Consommation de Madagascar.</p>
    <div class="feature-grid">
      <div class="fi"><div class="fi-icon">&#128736;</div><div class="fi-label">Interventions</div><div class="fi-desc">Enregistrement et suivi des maintenances</div></div>
      <div class="fi"><div class="fi-icon">&#128202;</div><div class="fi-label">Statistiques</div><div class="fi-desc">Tableaux de bord en temps reel</div></div>
      <div class="fi"><div class="fi-icon">&#128197;</div><div class="fi-label">Livrables</div><div class="fi-desc">Calendrier et suivi des livraisons</div></div>
      <div class="fi"><div class="fi-icon">&#128101;</div><div class="fi-label">Utilisateurs</div><div class="fi-desc">Gestion des techniciens et admins</div></div>
    </div>
    <div style="margin-top:1rem;padding:0.75rem;background:rgba(200,150,62,0.08);border-radius:8px;border:1px solid rgba(200,150,62,0.2)">
      <p style="font-size:0.75rem;color:rgba(250,248,242,0.5);text-align:center;margin:0">&#128231; Contact DSI : <a href="mailto:dsi@mnc.gov.mg" style="color:#C8963E">dsi@mnc.gov.mg</a> &nbsp;|&nbsp; Version 1.0 &nbsp;|&nbsp; MCC Madagascar</p>
    </div>
  </div>
</div>

<div id="ov-parametre" onclick="if(event.target===this)closeOv()" style="position:fixed;inset:0;background:rgba(10,6,0,0.97);display:none;align-items:center;justify-content:center;z-index:100;backdrop-filter:blur(8px)">
  <div style="background:linear-gradient(135deg,rgba(201,168,76,0.08),rgba(10,6,0,0.97));border:1px solid rgba(200,150,62,0.25);border-radius:16px;padding:2.5rem;width:min(460px,90vw);position:relative">
    <button onclick="closeOv()" style="position:absolute;top:1rem;right:1rem;background:none;border:none;color:rgba(250,248,242,0.4);font-size:1.2rem;cursor:pointer">&#10005;</button>
    <p class="panel-title-h">&#9881; Parametres Systeme</p>
    <div class="divider-line"><span>Configuration</span></div>
    <div class="param-row"><span class="pr-label">Application</span><span class="pr-val">SIGIT v1.0</span></div>
    <div class="param-row"><span class="pr-label">Ministere</span><span class="pr-val">MCC Madagascar</span></div>
    <div class="param-row"><span class="pr-label">Direction</span><span class="pr-val">DSI - Systemes d Information</span></div>
    <div class="param-row"><span class="pr-label">Framework</span><span class="pr-val">CakePHP 5</span></div>
    <div class="param-row"><span class="pr-label">Base de donnees</span><span class="pr-val">MySQL 8</span></div>
    <div class="param-row"><span class="pr-label">Langue</span><span class="pr-val">Francais</span></div>
    <div class="param-row"><span class="pr-label">Fuseau horaire</span><span class="pr-val">Indian/Antananarivo (UTC+3)</span></div>
    <div class="param-row"><span class="pr-label">Deploiement</span><span class="pr-val">Render.com (Cloud)</span></div>
    <div class="param-row"><span class="pr-label">Contact Admin</span><span class="pr-val">dsi@mnc.gov.mg</span></div>
  </div>
</div>

<div id="ov-aide" onclick="if(event.target===this)closeOv()" style="position:fixed;inset:0;background:rgba(10,6,0,0.97);display:none;align-items:center;justify-content:center;z-index:100;backdrop-filter:blur(8px)">
  <div style="background:linear-gradient(135deg,rgba(201,168,76,0.08),rgba(10,6,0,0.97));border:1px solid rgba(200,150,62,0.25);border-radius:16px;padding:2.5rem;width:min(480px,90vw);position:relative">
    <button onclick="closeOv()" style="position:absolute;top:1rem;right:1rem;background:none;border:none;color:rgba(250,248,242,0.4);font-size:1.2rem;cursor:pointer">&#10005;</button>
    <p class="panel-title-h">&#10067; Centre d Aide</p>
    <div class="divider-line"><span>Guide d utilisation</span></div>
    <div class="aide-q"><div class="aq-q">&#128100; Role Administrateur</div><div class="aq-a">Acces complet : gestion des utilisateurs, validation des comptes, rapports globaux.</div></div>
    <div class="aide-q"><div class="aq-q">&#128736; Role Technicien</div><div class="aq-a">Enregistrer ses propres interventions, consulter ses livrables, voir ses statistiques.</div></div>
    <div class="aide-q"><div class="aq-q">Comment creer une intervention ?</div><div class="aq-a">Connectez-vous puis remplissez le formulaire dans le tableau de bord.</div></div>
    <div class="aide-q"><div class="aq-q">Mot de passe oublie ?</div><div class="aq-a">Cliquez "Mot de passe oublie" et entrez votre email pour recevoir un code.</div></div>
    <div class="aide-q"><div class="aq-q">Probleme technique ?</div><div class="aq-a">Contactez la DSI : <a href="mailto:dsi@mnc.gov.mg" style="color:#C8963E">dsi@mnc.gov.mg</a></div></div>
  </div>
</div>

<div id="ov-forgot" onclick="if(event.target===this)closeOv()" style="position:fixed;inset:0;background:rgba(10,6,0,0.97);display:none;align-items:center;justify-content:center;z-index:100;backdrop-filter:blur(8px)">
  <div style="background:linear-gradient(135deg,rgba(201,168,76,0.08),rgba(10,6,0,0.97));border:1px solid rgba(200,150,62,0.25);border-radius:16px;padding:2.5rem;width:min(420px,90vw);position:relative">
    <button onclick="closeOv()" style="position:absolute;top:1rem;right:1rem;background:none;border:none;color:rgba(250,248,242,0.4);font-size:1.2rem;cursor:pointer">&#10005;</button>
    <div style="text-align:center;margin-bottom:1.5rem">
      <h2 style="color:var(--or)">&#128274; Mot de passe oublie</h2>
      <p style="color:rgba(250,248,242,0.5);font-size:0.75rem">Entrez votre email pour recevoir un code</p>
    </div>
    <?= $flashMsg ?>
    <form action="/users/forgot" method="post">
      <div class="form-group"><label>Email</label><input type="email" name="email" placeholder="votre@email.mg" required></div>
      <input type="submit" value="Envoyer le code" class="btn-login" style="background:linear-gradient(135deg,#1a5c2e,#2D8C4E,#4caf50) !important;color:#ffffff !important;border:2px solid rgba(45,140,78,0.8) !important;font-weight:800 !important;box-shadow:0 4px 20px rgba(45,140,78,0.55) !important">
    </form>
    <div style="text-align:center;margin-top:1rem">
      <a onclick="showOv('login')" style="cursor:pointer;font-size:0.75rem;color:rgba(250,248,242,0.45)">&#8592; Retour a la connexion</a>
    </div>
  </div>
</div>

<script>
function showOv(n){document.querySelectorAll("[id^=ov-]").forEach(function(e){e.style.display="none";});var el=document.getElementById("ov-"+n);if(el)el.style.display="flex";}
function closeOv(){document.querySelectorAll("[id^=ov-]").forEach(function(e){e.style.display="none";});}
document.addEventListener("keydown",function(e){if(e.key==="Escape")closeOv();});
window.addEventListener("load",function(){
  var show="<?= $showOverlay ?>";
  if(show)showOv(show);
  var p=new URLSearchParams(window.location.search);
  if(p.get("modal"))showOv(p.get("modal"));
});
</script>