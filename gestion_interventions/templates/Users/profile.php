<?php
$session = $this->request->getSession();
$u = $session->read("Auth.nom") ?? "";
$r = $session->read("Auth.role") ?? "";
$avatar = $user->avatar ?? "";
$avatarUrl = $avatar ? "/uploads/avatars/" . $avatar : "";
?>
<div class="app">
<div class="sidebar">
<div class="sidebar-header"><svg width="36" height="36" viewBox="0 0 120 120"><circle cx="60" cy="60" r="58" fill="none" stroke="#2D8C4E" stroke-width="2"/><rect x="32" y="38" width="56" height="36" rx="4" fill="none" stroke="#2D8C4E" stroke-width="2"/><circle cx="46" cy="56" r="4" fill="#C8963E"/><circle cx="60" cy="50" r="4" fill="#C8963E"/><circle cx="74" cy="56" r="4" fill="#C8963E"/><circle cx="60" cy="62" r="4" fill="#2D8C4E"/></svg>
<div><div class="sidebar-logo-text">SIGIT</div><div class="sidebar-sub">Ministere du Numerique</div></div>
</div>
<nav class="nav">
<div class="nav-section">Principal</div>
<a href="/dashboard" class="nav-item">&#9632; Tableau de Bord</a>
<div class="nav-section">Gestion</div>
<a href="/interventions" class="nav-item">&#9874; Interventions</a>
<a href="/livrables" class="nav-item">&#128197; Liste Livraison</a>
<a href="/statistiques" class="nav-item">&#128202; Statistiques</a>
<div class="nav-section">Administration</div>
<a href="/beneficiaires" class="nav-item">&#128101; Beneficiaires</a>
<a href="/materiel" class="nav-item">&#128187; Parc Materiel</a>
<a href="/rapports" class="nav-item">&#128196; Rapports</a>
<a href="/users/profile" class="nav-item active">&#9881; Parametres</a>
</nav>
<div class="sidebar-user">
<?php if($avatarUrl): ?>
<img src="<?= $avatarUrl ?>" style="width:36px;height:36px;border-radius:50%;border:2px solid #C8963E;object-fit:cover;flex-shrink:0">
<?php else: ?>
<div class="user-avatar"><?= strtoupper(substr($u,0,1)) ?></div>
<?php endif; ?>
<div class="user-info"><div class="user-name"><?= h($u) ?></div><div class="user-role"><?= h($r) ?></div></div>
<div class="user-info"><div class="user-name"><?= h($u) ?></div><div class="user-role"><?= h($r) ?></div></div>
<a href="/users/logout" class="btn-deconnect">&#10005;</a>
</div>
</div>
<div class="main">
<div class="topbar"><div class="topbar-title">&#128100; Mon Profil</div><a href="/dashboard" class="btn-action">&#8592; Dashboard</a></div>
<div class="content">
<?= $this->Flash->render() ?>
<div style="display:grid;grid-template-columns:1fr 1.5fr;gap:1.25rem">
<div class="panel">
<div class="panel-header"><div class="panel-title">&#128247; Photo de Profil</div></div>
<div class="panel-body" style="display:flex;flex-direction:column;align-items:center;gap:1rem">
<?php if($avatarUrl): ?>
<img src="<?= $avatarUrl ?>" id="avatarPreview" style="width:120px;height:120px;border-radius:50%;border:3px solid #C8963E;object-fit:cover">
<?php else: ?>
<div id="avatarPreview" style="width:120px;height:120px;border-radius:50%;border:3px solid #C8963E;background:linear-gradient(135deg,#2D8C4E,#1a5c2e);display:flex;align-items:center;justify-content:center;font-size:3rem;color:#C8963E">
<?= strtoupper(substr($u,0,1)) ?>
</div>
<?php endif; ?>
<div style="font-size:0.85rem;color:rgba(250,248,242,0.6);text-align:center"><?= h($u) ?><br><span style="font-size:0.7rem;color:#C8963E"><?= h($r) ?></span></div>
<form action="/users/upload-avatar" method="post" enctype="multipart/form-data" style="width:100%">
<div style="margin-bottom:0.75rem">
<label style="display:block;font-size:0.7rem;color:#C8963E;margin-bottom:0.4rem;text-transform:uppercase;letter-spacing:0.1em">Choisir une photo</label>
<input type="file" name="avatar" accept="image/*" onchange="previewImage(this)" style="width:100%;background:rgba(250,248,242,0.04);border:1px solid rgba(200,150,62,0.3);border-radius:6px;padding:0.5rem;color:#FAF8F2;font-size:0.8rem">
</div>
<button type="submit" class="btn-submit" style="width:100%">&#128247; Mettre a jour</button>
</form>
<div style="font-size:0.7rem;color:rgba(250,248,242,0.3);text-align:center">JPG, PNG, GIF — Max 2MB</div>
</div>
</div>
<div style="display:flex;flex-direction:column;gap:1.25rem">
<div class="panel">
<div class="panel-header"><div class="panel-title">&#128100; Informations du compte</div></div>
<div class="panel-body">
<div class="param-row"><span class="pr-label">Nom</span><span class="pr-val"><?= h($user->nom) ?></span></div>
<div class="param-row"><span class="pr-label">Prenom</span><span class="pr-val"><?= h($user->prenom ?? "-") ?></span></div>
<div class="param-row"><span class="pr-label">Email</span><span class="pr-val"><?= h($user->email) ?></span></div>
<div class="param-row"><span class="pr-label">Role</span><span class="pr-val"><?= h($user->role) ?></span></div>
</div>
</div>
<div class="panel">
<div class="panel-header"><div class="panel-title">&#128274; Changer le mot de passe</div></div>
<div class="panel-body">
<form action="/users/change-password" method="post">
<div class="field" style="margin-bottom:0.9rem"><label>Nouveau mot de passe</label><input type="password" name="new_password" placeholder="Min. 6 caracteres" required></div>
<div class="field" style="margin-bottom:0.9rem"><label>Confirmer</label><input type="password" name="confirm_password" placeholder="Confirmer" required></div>
<button type="submit" class="btn-submit" style="width:100%">Changer le mot de passe</button>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var preview = document.getElementById("avatarPreview");
            if (preview.tagName === "IMG") {
                preview.src = e.target.result;
            } else {
                var img = document.createElement("img");
                img.src = e.target.result;
                img.id = "avatarPreview";
                img.style = "width:120px;height:120px;border-radius:50%;border:3px solid #C8963E;object-fit:cover";
                preview.parentNode.replaceChild(img, preview);
            }
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>