<?php $s=$this->request->getSession();$u=$s->read("Auth.nom")??"";$r=$s->read("Auth.role")??""; ?>
<div class="app">
<div class="sidebar">
<div class="sidebar-header"><svg width="32" height="32" viewBox="0 0 120 120"><circle cx="60" cy="60" r="58" fill="none" stroke="#2D8C4E" stroke-width="2"/><rect x="32" y="38" width="56" height="36" rx="4" fill="none" stroke="#2D8C4E" stroke-width="2"/></svg><div><div class="sidebar-logo-text">SIGIT</div><div class="sidebar-sub">MNC Madagascar</div></div></div>
<nav class="nav">
<div class="nav-section">Principal</div>
<a href="/dashboard" class="nav-item">&#128202; Tableau de Bord</a>
<div class="nav-section">Gestion</div>
<a href="/interventions" class="nav-item active">&#128736; Interventions</a>
<a href="/livrables" class="nav-item">&#128197; Livrables</a>
<div class="nav-section">Compte</div>
<a href="/users/profile" class="nav-item">&#128100; Mon Profil</a>
</nav>
<div class="sidebar-user"><div class="user-avatar"><?= strtoupper(substr($u,0,1)) ?></div><div class="user-info"><div class="user-name"><?= h($u) ?></div><div class="user-role"><?= h($r) ?></div></div><a href="/users/logout" class="btn-deconnect">&#10005;</a></div>
</div>
<div class="main">
<div class="topbar"><div class="topbar-title">Modifier Intervention #<?= $intervention->id ?></div><a href="/interventions" class="btn-action">&#8592; Retour</a></div>
<div class="content">
<?= $this->Flash->render() ?>
<div class="panel" style="max-width:600px">
<div class="panel-header"><div class="panel-title">Modifier</div></div>
<div class="panel-body">
<form action="/interventions/edit/<?= $intervention->id ?>" method="post">
<div class="field" style="margin-bottom:1rem"><label>Beneficiaire *</label><input type="text" name="beneficiaire" value="<?= h($intervention->beneficiaire) ?>" required></div>
<div class="field" style="margin-bottom:1rem"><label>Date *</label><input type="date" name="date_intervention" value="<?= h($intervention->date_intervention) ?>" required></div>
<div class="field" style="margin-bottom:1rem"><label>Type *</label>
<select name="type_intervention">
<option value="resolution_probleme" <?= $intervention->type_intervention==="resolution_probleme"?"selected":"" ?>>Resolution de probleme</option>
<option value="installation_configuration" <?= $intervention->type_intervention==="installation_configuration"?"selected":"" ?>>Installation / Configuration</option>
<option value="restoration_mise_a_niveau" <?= $intervention->type_intervention==="restoration_mise_a_niveau"?"selected":"" ?>>Restauration / Mise a niveau</option>
<option value="supervision_fonctionnement" <?= $intervention->type_intervention==="supervision_fonctionnement"?"selected":"" ?>>Supervision fonctionnement</option>
<option value="supervision_analyse_pannes" <?= $intervention->type_intervention==="supervision_analyse_pannes"?"selected":"" ?>>Supervision / Analyse pannes</option>
</select></div>
<div class="field" style="margin-bottom:1rem"><label>Statut</label>
<select name="statut">
<option value="cours" <?= $intervention->statut==="cours"?"selected":"" ?>>En cours</option>
<option value="repare" <?= $intervention->statut==="repare"?"selected":"" ?>>Repare</option>
<option value="reparable" <?= $intervention->statut==="reparable"?"selected":"" ?>>Reparable</option>
</select></div>
<div class="field" style="margin-bottom:1rem"><label>Observation</label><textarea name="observation" rows="3"><?= h($intervention->observation) ?></textarea></div>
<input type="submit" value="Enregistrer" class="btn-submit">
</form>
</div></div>
</div></div></div>