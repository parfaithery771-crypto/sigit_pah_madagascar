<?php
$session = $this->request->getSession();
$u = $session->read("Auth.nom") ?? "";
$r = $session->read("Auth.role") ?? "";
$av = $session->read("Auth.avatar") ?? "";
$avUrl = $av ? "/uploads/avatars/".$av : "";
?>
<div class="app">
<div class="sidebar">
<div class="sidebar-header"><img src="/img/logo_mincc.png" style="width:44px;height:44px;object-fit:contain;filter:drop-shadow(0 0 8px rgba(184,150,46,0.4))">
<div><div class="sidebar-logo-text">SIGIT</div><div class="sidebar-sub">Ministere du Commerce et de la Consommation</div></div>
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
<a href="/admin/users" class="nav-item active">&#128100; Utilisateurs</a>
<a href="/users/profile" class="nav-item">&#9881; Parametres</a>
</nav>
<div class="sidebar-user">
<?php if($avUrl): ?><img src="<?= $avUrl ?>" style="width:36px;height:36px;border-radius:50%;border:2px solid #C8963E;object-fit:cover;flex-shrink:0"><?php else: ?><div class="user-avatar"><?= strtoupper(substr($u,0,1)) ?></div><?php endif; ?>
<div class="user-info"><div class="user-name"><?= h($u) ?></div><div class="user-role"><?= h($r) ?></div></div>
<a href="/users/logout" class="btn-deconnect">&#10005;</a>
</div>
</div>
<div class="main">
<div class="topbar"><div class="topbar-title">&#128100; Gestion des Utilisateurs</div><a href="/dashboard" class="btn-action">&#8592; Dashboard</a></div>
<div class="content">
<?= $this->Flash->render() ?>
<div class="panel">
<div class="panel-header"><div class="panel-title">Liste des Utilisateurs (<?= count($users) ?>)</div></div>
<div class="panel-body" style="padding:0">
<table>
<thead><tr><th>ID</th><th>Nom</th><th>Email</th><th>Role</th></tr></thead>
<tbody>
<?php foreach($users as $user): ?>
<tr>
<td><?= h($user->id) ?></td>
<td><?= h($user->nom) ?> <?= h($user->prenom ?? '') ?></td>
<td><?= h($user->email) ?></td>
<td><span class="badge-etat <?= $user->role === 'admin' ? 'etat-ok' : 'etat-pend' ?>"><?= h($user->role) ?></span></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>