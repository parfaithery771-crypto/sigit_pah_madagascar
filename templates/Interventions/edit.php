<?php $s=$this->request->getSession();$u=$s->read("Auth.nom")??"";$r=$s->read("Auth.role")??""; ?>
<div class="app">
<div class="sidebar">
<div class="sidebar-header"><img src="/img/logo_mincc.png" style="width:44px;height:44px;object-fit:contain;filter:drop-shadow(0 0 8px rgba(184,150,46,0.4))"><div><div class="sidebar-logo-text">SIGIT</div><div class="sidebar-sub">Ministere du Commerce et de la Consommation</div></div></div>
<nav class="nav">
<div class="nav-section">Principal</div>
<a href="/dashboard" class="nav-item">&#128202; Tableau de Bord</a>
<div class="nav-section">Gestion</div>
<a href="/interventions" class="nav-item active">&#128736; Interventions</a>
<a href="/livrables" class="nav-item">&#128197; Livrables</a>
<div class="nav-section">Compte</div>
<a href="/users/profile" class="nav-item">&#128100; Mon Profil</a>
</nav>
<?php $av=$this->request->getSession()->read("Auth.avatar")??"";$avUrl=$av?"/uploads/avatars/".$av:""; ?><div class="sidebar-user"><?php if($avUrl): ?><img src="<?= $avUrl ?>" style="width:36px;height:36px;border-radius:50%;border:2px solid #C8963E;object-fit:cover;flex-shrink:0"><?php else: ?><div class="user-avatar"><?= strtoupper(substr($u,0,1)) ?></div><?php endif; ?><div class="user-info"><div class="user-name"><?= h($u) ?></div><div class="user-role"><?= h($r) ?></div></div><a href="/users/logout" class="btn-deconnect">&#10005;</a></div>
</div>
<div class="main">
<div class="topbar"><div class="topbar-title">Modifier Intervention #<?= $intervention->id ?></div><a href="/interventions" class="btn-action">&#8592; Retour</a></div>
<div class="content">
<?= $this->Flash->render() ?>
<div class="panel" style="max-width:650px">
<div class="panel-header"><div class="panel-title">Modifier</div></div>
<div class="panel-body">
<form action="/interventions/edit/<?= $intervention->id ?>" method="post">

<div class="field" style="margin-bottom:1rem"><label>Beneficiaire *</label>
<input type="text" name="beneficiaire" value="<?= h($intervention->beneficiaire) ?>" required></div>

<div class="field" style="margin-bottom:1rem"><label>Date *</label>
<input type="date" name="date_intervention" value="<?= h($intervention->date_intervention) ?>" required></div>

<div class="field" style="margin-bottom:1rem"><label>Type *</label>
<select name="type_intervention">
<option value="resolution_probleme" <?= $intervention->type_intervention==="resolution_probleme"?"selected":"" ?>>Maintenance 1er degre des materiels TIC</option>
<option value="installation_configuration" <?= $intervention->type_intervention==="installation_configuration"?"selected":"" ?>>Installation et configuration des materiels</option>
<option value="restoration_mise_a_niveau" <?= $intervention->type_intervention==="restoration_mise_a_niveau"?"selected":"" ?>>Restitution et mise a niveau des logiciels</option>
<option value="supervision_fonctionnement" <?= $intervention->type_intervention==="supervision_fonctionnement"?"selected":"" ?>>Maintenance preventive et curative</option>
<option value="supervision_analyse_pannes" <?= $intervention->type_intervention==="supervision_analyse_pannes"?"selected":"" ?>>Supervision et analyse des pannes</option>
</select></div>

<div class="field" style="margin-bottom:1rem">
<label>&#128295; Travaux effectues (detail reel) *</label>
<textarea name="description_travaux" rows="4"
  placeholder="Ex: Changement RAM 4Go, Remplacement disque dur, Reinstallation Windows..."
  style="background:#0F1E12;color:#FAF8F2;border:1px solid rgba(200,150,62,0.3);border-radius:6px;padding:0.6rem;width:100%;font-family:inherit;resize:vertical"><?= h($intervention->description_travaux ?? '') ?></textarea>
</div>

<div class="field" style="margin-bottom:1rem"><label>Statut</label>
<select name="statut">
<option value="cours" <?= $intervention->statut==="cours"?"selected":"" ?>>En cours</option>
<option value="repare" <?= $intervention->statut==="repare"?"selected":"" ?>>Repare</option>
<option value="reparable" <?= $intervention->statut==="reparable"?"selected":"" ?>>Reparable</option>
</select></div>

<div class="field" style="margin-bottom:1rem"><label>Observation</label>
<textarea name="observation" rows="3"><?= h($intervention->observation) ?></textarea></div>

<input type="submit" value="Enregistrer" class="btn-submit">
</form>
</div></div>
</div></div></div>