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
<div class="topbar"><div class="topbar-title">&#128736; Interventions</div><div class="topbar-actions"><a href="/dashboard" class="btn-action">&#8592; Dashboard</a><a href="/interventions/add" class="btn-action" style="background:rgba(45,140,78,0.3)">&#43; Nouvelle</a></div></div>
<div class="content">
<?= $this->Flash->render() ?>
<div class="panel">
<div class="panel-header"><div class="panel-title">Liste des Interventions (<?= count($interventions) ?>)</div></div>
<div class="panel-body">
<table><thead><tr><th>Date</th><th>Beneficiaire</th><th>Type</th><th>Statut</th><th>Actions</th></tr></thead>
<tbody>
<?php if(empty($interventions)): ?><tr><td colspan="5" style="text-align:center;color:rgba(250,248,242,0.4);font-style:italic">Aucune intervention.</td></tr>
<?php else: foreach($interventions as $i): ?>
<tr>
<td><?= h($i->date_intervention) ?></td>
<td><?= h($i->beneficiaire) ?></td>
<td style="font-size:0.78rem"><?= h(str_replace("_"," ",$i->type_intervention)) ?></td>
<td><span class="badge-etat <?= $i->statut==="repare"?"etat-ok":($i->statut==="cours"?"etat-pend":"etat-late") ?>"><?= h($i->statut) ?></span></td>
<td style="display:flex;gap:0.4rem">
<a href="/interventions/edit/<?= $i->id ?>" class="btn-action" style="font-size:0.7rem;padding:0.25rem 0.6rem">Editer</a>
<a href="/interventions/delete/<?= $i->id ?>" class="btn-action" style="font-size:0.7rem;padding:0.25rem 0.6rem;color:#E06060" onclick="return confirm(chr(39)+"Supprimer ?"+chr(39))">Suppr</a>
</td>
</tr>
<?php endforeach; endif; ?>
</tbody></table>
</div></div>
</div></div></div>