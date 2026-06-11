<?php $s=$this->request->getSession();$u=$s->read("Auth.nom")??"";$r=$s->read("Auth.role")??""; ?>
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
<a href="/materiel" class="nav-item active">&#128187; Parc Materiel</a>
<a href="/rapports" class="nav-item">&#128196; Rapports</a>
<a href="/users/profile" class="nav-item">&#9881; Parametres</a>
</nav>
<div class="sidebar-user"><div class="user-avatar"><?= strtoupper(substr($u,0,1)) ?></div><div class="user-info"><div class="user-name"><?= h($u) ?></div><div class="user-role"><?= h($r) ?></div></div><a href="/users/logout" class="btn-deconnect">&#10005;</a></div>
</div>
<div class="main">
<div class="topbar"><div class="topbar-title">&#128187; Parc Materiel</div><a href="/dashboard" class="btn-action">&#8592; Dashboard</a></div>
<div class="content">
<?= $this->Flash->render() ?>
<div class="panel">
<div class="panel-header"><div class="panel-title">Interventions par Type de Materiel</div></div>
<div class="panel-body">
<table>
<thead><tr><th>Type d intervention</th><th>Nombre</th></tr></thead>
<tbody>
<?php if(empty($parType)): ?>
<tr><td colspan="2" style="text-align:center;color:rgba(250,248,242,0.4);font-style:italic;padding:2rem">Aucune donnee.</td></tr>
<?php else: foreach($parType as $p): ?>
<tr>
<td><?= h(str_replace("_"," ",$p->type_intervention)) ?></td>
<td><span class="badge-etat etat-pend"><?= h($p->total) ?></span></td>
</tr>
<?php endforeach; endif; ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>