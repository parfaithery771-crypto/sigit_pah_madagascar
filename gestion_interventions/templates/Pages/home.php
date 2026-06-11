<?php $showOverlay = isset($showOverlay) ? $showOverlay : ""; ?>
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

<div id="ov-login" onclick="if(event.target===this)closeOv()" style="position:fixed;inset:0;background:rgba(13,27,15,0.97);display:none;align-items:center;justify-content:center;z-index:100;backdrop-filter:blur(8px)">
  <div style="background:linear-gradient(135deg,rgba(26,92,46,0.12),rgba(13,27,15,0.9));border:1px solid rgba(200,150,62,0.25);border-radius:16px;padding:2.5rem;width:min(420px,90vw);position:relative;max-height:90vh;overflow-y:auto">
    <button onclick="closeOv()" style="position:absolute;top:1rem;right:1rem;background:none;border:none;color:rgba(250,248,242,0.4);font-size:1.2rem;cursor:pointer">&#10005;</button>
    <div style="text-align:center;margin-bottom:1.5rem">
      <h2 style="color:var(--or);letter-spacing:0.1em">&#9670; SIGIT &#9670;</h2>
      <p style="color:rgba(250,248,242,0.5);font-size:0.75rem;font-style:italic">Authentification securisee</p>
    </div>
    <?= $this->Flash->render() ?>
    <form action="/users/login" method="post">
      <div class="form-group"><label>Email</label><input type="email" name="email" placeholder="votre@email.mg" required></div>
      <div class="form-group"><label>Mot de passe</label><input type="password" name="password" placeholder="........" required></div>
      <input type="submit" value="Se Connecter" class="btn-login">
    </form>
    <div style="margin-top:1rem">
      <button class="btn-inscrire" onclick="showOv('inscrire')">&#10010; S inscrire</button>
    </div>
  </div>
</div>

<div id="ov-inscrire" onclick="if(event.target===this)closeOv()" style="position:fixed;inset:0;background:rgba(13,27,15,0.97);display:none;align-items:center;justify-content:center;z-index:100;backdrop-filter:blur(8px)">
  <div style="background:linear-gradient(135deg,rgba(26,92,46,0.12),rgba(13,27,15,0.9));border:1px solid rgba(200,150,62,0.25);border-radius:16px;padding:2.5rem;width:min(420px,90vw);position:relative;max-height:90vh;overflow-y:auto">
    <button onclick="closeOv()" style="position:absolute;top:1rem;right:1rem;background:none;border:none;color:rgba(250,248,242,0.4);font-size:1.2rem;cursor:pointer">&#10005;</button>
    <div style="text-align:center;margin-bottom:1.5rem">
      <h2 style="color:var(--or)">&#9670; SIGIT &#9670;</h2>
      <p style="color:rgba(250,248,242,0.5);font-size:0.75rem;font-style:italic">Creer un nouveau compte</p>
    </div>
    <?= $this->Flash->render() ?>
    <form action="/users/register" method="post">
      <div class="form-group"><label>Nom *</label><input type="text" name="nom" placeholder="Votre nom" required></div>
      <div class="form-group"><label>Prenom</label><input type="text" name="prenom" placeholder="Votre prenom"></div>
      <div class="form-group"><label>Email *</label><input type="email" name="email" placeholder="votre@email.mg" required></div>
      <div class="form-group"><label>Mot de passe *</label><input type="password" name="password" placeholder="........" required></div>
      <input type="submit" value="S inscrire" class="btn-login">
    </form>
    <div style="margin-top:1rem;text-align:center">
      <a onclick="showOv('login')" style="cursor:pointer;font-size:0.75rem;color:rgba(250,248,242,0.45)">Deja un compte ? Se connecter</a>
    </div>
  </div>
</div>

<div id="ov-apropos" onclick="if(event.target===this)closeOv()" style="position:fixed;inset:0;background:rgba(13,27,15,0.97);display:none;align-items:center;justify-content:center;z-index:100;backdrop-filter:blur(8px)">
  <div style="background:linear-gradient(135deg,rgba(26,92,46,0.12),rgba(13,27,15,0.9));border:1px solid rgba(200,150,62,0.25);border-radius:16px;padding:2.5rem;width:min(540px,90vw);position:relative">
    <button onclick="closeOv()" style="position:absolute;top:1rem;right:1rem;background:none;border:none;color:rgba(250,248,242,0.4);font-size:1.2rem;cursor:pointer">&#10005;</button>
    <p class="panel-title-h">&#9670; A Propos du Projet</p>
    <div class="divider-line"><span>SIGIT</span></div>
    <p style="font-size:0.95rem;line-height:1.7;color:rgba(250,248,242,0.75);margin-bottom:1rem">Le SIGIT est une plateforme numerique developpee pour le Ministere du Numerique et de la Communication de la Republique de Madagascar.</p>
    <div class="feature-grid">
      <div class="fi"><div class="fi-icon">&#128736;</div><div class="fi-label">Interventions</div><div class="fi-desc">Suivi des maintenances</div></div>
      <div class="fi"><div class="fi-icon">&#128202;</div><div class="fi-label">Statistiques</div><div class="fi-desc">Tableaux de bord</div></div>
      <div class="fi"><div class="fi-icon">&#128197;</div><div class="fi-label">Planification</div><div class="fi-desc">Calendrier livraisons</div></div>
      <div class="fi"><div class="fi-icon">&#128101;</div><div class="fi-label">Utilisateurs</div><div class="fi-desc">Gestion beneficiaires</div></div>
    </div>
  </div>
</div>

<div id="ov-parametre" onclick="if(event.target===this)closeOv()" style="position:fixed;inset:0;background:rgba(13,27,15,0.97);display:none;align-items:center;justify-content:center;z-index:100;backdrop-filter:blur(8px)">
  <div style="background:linear-gradient(135deg,rgba(26,92,46,0.12),rgba(13,27,15,0.9));border:1px solid rgba(200,150,62,0.25);border-radius:16px;padding:2.5rem;width:min(460px,90vw);position:relative">
    <button onclick="closeOv()" style="position:absolute;top:1rem;right:1rem;background:none;border:none;color:rgba(250,248,242,0.4);font-size:1.2rem;cursor:pointer">&#10005;</button>
    <p class="panel-title-h">&#9881; Parametres Systeme</p>
    <div class="divider-line"><span>Configuration</span></div>
    <div class="param-row"><span class="pr-label">Version</span><span class="pr-val">1.0.0</span></div>
    <div class="param-row"><span class="pr-label">Framework</span><span class="pr-val">CakePHP 5</span></div>
    <div class="param-row"><span class="pr-label">Base de donnees</span><span class="pr-val">MySQL</span></div>
    <div class="param-row"><span class="pr-label">Langue</span><span class="pr-val">Francais</span></div>
    <div class="param-row"><span class="pr-label">Fuseau horaire</span><span class="pr-val">Indian/Antananarivo</span></div>
  </div>
</div>

<div id="ov-aide" onclick="if(event.target===this)closeOv()" style="position:fixed;inset:0;background:rgba(13,27,15,0.97);display:none;align-items:center;justify-content:center;z-index:100;backdrop-filter:blur(8px)">
  <div style="background:linear-gradient(135deg,rgba(26,92,46,0.12),rgba(13,27,15,0.9));border:1px solid rgba(200,150,62,0.25);border-radius:16px;padding:2.5rem;width:min(480px,90vw);position:relative">
    <button onclick="closeOv()" style="position:absolute;top:1rem;right:1rem;background:none;border:none;color:rgba(250,248,242,0.4);font-size:1.2rem;cursor:pointer">&#10005;</button>
    <p class="panel-title-h">&#10067; Centre d Aide</p>
    <div class="divider-line"><span>FAQ</span></div>
    <div class="aide-q"><div class="aq-q">Comment creer une intervention ?</div><div class="aq-a">Connectez-vous puis utilisez le formulaire sur le tableau de bord.</div></div>
    <div class="aide-q"><div class="aq-q">Comment voir les statistiques ?</div><div class="aq-a">Le dashboard affiche les graphiques depuis la base de donnees.</div></div>
    <div class="aide-q"><div class="aq-q">Mot de passe oublie ?</div><div class="aq-a">Contactez: dsi@mnc.gov.mg</div></div>
  </div>
</div>

<script>
function showOv(n){document.querySelectorAll("[id^=ov-]").forEach(function(e){e.style.display="none";});var el=document.getElementById("ov-"+n);if(el)el.style.display="flex";}
function closeOv(){document.querySelectorAll("[id^=ov-]").forEach(function(e){e.style.display="none";});}
document.addEventListener("keydown",function(e){if(e.key==="Escape")closeOv();});
window.addEventListener("load",function(){var show="<?= $showOverlay ?>";if(show)showOv(show);});
</script>
