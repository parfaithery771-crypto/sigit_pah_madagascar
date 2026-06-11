<?php $s=$this->request->getSession();$u=$s->read("Auth.nom")??"";$r=$s->read("Auth.role")??""; ?>
<div class="app">
<div class="sidebar">
<div class="sidebar-header"><svg width="32" height="32" viewBox="0 0 120 120"><circle cx="60" cy="60" r="58" fill="none" stroke="#2D8C4E" stroke-width="2"/><rect x="32" y="38" width="56" height="36" rx="4" fill="none" stroke="#2D8C4E" stroke-width="2"/></svg><div><div class="sidebar-logo-text">SIGIT</div><div class="sidebar-sub">MNC Madagascar</div></div></div>
<nav class="nav">
<div class="nav-section">Principal</div>
<a href="/dashboard" class="nav-item">&#128202; Tableau de Bord</a>
<div class="nav-section">Gestion</div>
<a href="/interventions" class="nav-item">&#128736; Interventions</a>
<a href="/livrables" class="nav-item active">&#128197; Livrables</a>
<div class="nav-section">Compte</div>
<a href="/users/profile" class="nav-item">&#128100; Mon Profil</a>
</nav>
<div class="sidebar-user"><div class="user-avatar"><?= strtoupper(substr($u,0,1)) ?></div><div class="user-info"><div class="user-name"><?= h($u) ?></div><div class="user-role"><?= h($r) ?></div></div><a href="/users/logout" class="btn-deconnect">&#10005;</a></div>
</div>
<div class="main">
<div class="topbar"><div class="topbar-title">&#128197; Livrables</div><a href="/dashboard" class="btn-action">&#8592; Dashboard</a></div>
<div class="content">
<?= $this->Flash->render() ?>
<div class="panel">
<div class="panel-header"><div class="panel-title">Liste des Livrables (<?= count($livrables) ?>)</div></div>
<div class="panel-body">
<table><thead><tr><th>Date</th><th>Direction</th><th>Etat</th><th>Intervention</th><th>Actions</th></tr></thead>
<tbody>
<?php if(empty($livrables)): ?><tr><td colspan="5" style="text-align:center;color:rgba(250,248,242,0.4);font-style:italic">Aucun livrable.</td></tr>
<?php else: foreach($livrables as $l): ?>
<tr>
<td><?= h($l->date_livraison) ?></td>
<td><?= h($l->direction??"-") ?></td>
<td><span class="badge-etat <?= $l->etat==="livre"?"etat-ok":($l->etat==="en_attente"?"etat-pend":"etat-late") ?>"><?= h($l->etat) ?></span></td>
<td><?= h($l->intervention_id??"-") ?></td>
<td style="display:flex;gap:0.4rem">
<a href="/livrables/edit/<?= $l->id ?>" class="btn-action" style="font-size:0.7rem;padding:0.25rem 0.6rem">Editer</a>
<a href="/livrables/delete/<?= $l->id ?>" class="btn-action" style="font-size:0.7rem;padding:0.25rem 0.6rem;color:#E06060" onclick="return confirm(chr(39)+"Supprimer ?"+chr(39))">Suppr</a>
</td>
</tr>
<?php endforeach; endif; ?>
</tbody></table>
</div></div>
<div class="panel" style="max-width:500px;margin-top:1.5rem">
<div class="panel-header"><div class="panel-title">&#43; Nouveau Livrable</div></div>
<div class="panel-body">
<form action="/livrables/add" method="post">
<div class="field" style="margin-bottom:1rem"><label>Date *</label><input type="date" name="date_livraison" required></div>
<div class="field" style="margin-bottom:1rem"><label>Direction</label><input type="text" name="direction" placeholder="Direction concernee"></div>
<div class="field" style="margin-bottom:1rem"><label>Etat</label>
<select name="etat"><option value="en_attente">En attente</option><option value="livre">Livre</option><option value="retard">En retard</option></select></div>
<div class="field" style="margin-bottom:1rem"><label>Intervention ID</label><input type="number" name="intervention_id" placeholder="optionnel"></div>
<input type="submit" value="Ajouter" class="btn-submit">
</form>
</div></div>
</div></div></div>