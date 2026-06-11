<?php
$session = $this->request->getSession();
$u = $session->read("Auth.nom") ?? "";
$r = $session->read("Auth.role") ?? "";
$taux = $total > 0 ? round(($resolues/$total)*100,1) : 0;
$data = [
    ["points"=>"Maintenir en premier degre les materiels TIC","realisation"=>"Resolution probleme et maintenance des materiels informatiques","perspectives"=>"Materiel informatique en etat de marche","type"=>"maintenance_premier_degre"],
    ["points"=>"Installer et configurer les nouveaux materiels et equipements informatiques","realisation"=>"Installation et configuration des materiels informatiques","perspectives"=>"Tous les materiels TIC du ministere en etat de marche","type"=>"installation_configuration"],
    ["points"=>"Installation des materiels TIC","realisation"=>"Restitution et mise a niveau des logiciels informatiques","perspectives"=>"Assurer la reinstallation des materiels TIC","type"=>"restoration_mise_a_niveau"],
    ["points"=>"Effectuer des maintenances preventive et curative pour le bon fonctionnement des parcs informatiques","realisation"=>"Assurer que les parcs informatiques sont en bon etat de fonctionnement","perspectives"=>"Materiel en bon fonctionnement","type"=>"maintenance_preventive_curative"],
    ["points"=>"Surveiller et verifier les problemes et pannes connexion internet","realisation"=>"Supervision et analyse des pannes","perspectives"=>"Reseau local et internet du Ministere fonctionnel","type"=>"supervision_analyse_pannes"],
];
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
<a href="/rapports" class="nav-item active">&#128196; Rapports</a>
<a href="/users/profile" class="nav-item">&#9881; Parametres</a>
</nav>
<div class="sidebar-user"><div class="user-avatar"><?= strtoupper(substr($u,0,1)) ?></div><div class="user-info"><div class="user-name"><?= h($u) ?></div><div class="user-role"><?= h($r) ?></div></div><a href="/users/logout" class="btn-deconnect">&#10005;</a></div>
</div>
<div class="main">
<div class="topbar">
<div class="topbar-title">&#128196; Rapport d Activite - SERVICE SRM</div>
<div class="topbar-actions">
<a href="/dashboard" class="btn-action">&#8592; Dashboard</a>
<button onclick="window.print()" class="btn-action primary">&#128424; Imprimer</button>
</div>
</div>
<div class="content">
<?= $this->Flash->render() ?>
<div class="stats-row">
<div class="stat-card" style="border-top:2px solid #C8963E"><div class="stat-label">Total</div><div class="stat-value"><?= $total ?></div><div class="stat-sub">Interventions</div><div class="stat-icon">&#9874;</div></div>
<div class="stat-card" style="border-top:2px solid #2D8C4E"><div class="stat-label">Resolues</div><div class="stat-value"><?= $resolues ?></div><div class="stat-sub">Taux: <?= $taux ?>%</div><div class="stat-icon">&#10003;</div></div>
<div class="stat-card" style="border-top:2px solid #C8963E"><div class="stat-label">En Cours</div><div class="stat-value"><?= $enCours ?></div><div class="stat-sub">En traitement</div><div class="stat-icon">&#9203;</div></div>
<div class="stat-card" style="border-top:2px solid #5EC878">
<div class="stat-label">Taux Resolution</div><div class="stat-value"><?= $taux ?>%</div><div class="stat-sub">Performance</div><div class="stat-icon">&#128200;</div></div>
</div>
<div class="panel">
<div class="panel-header">
<div class="panel-title">&#128196; RAPPORT D ACTIVITE — SERVICE SRM — MINISTERE DU NUMERIQUE</div>
</div>
<div class="panel-body">
<div style="overflow-x:auto">
<table style="width:100%;border-collapse:collapse">
<thead>
<tr style="background:rgba(200,150,62,0.15)">
<th style="padding:0.85rem;text-align:left;font-size:0.75rem;color:#C8963E;border:1px solid rgba(200,150,62,0.25);width:30%">POINTS EVOQUES</th>
<th style="padding:0.85rem;text-align:left;font-size:0.75rem;color:#C8963E;border:1px solid rgba(200,150,62,0.25);width:35%">REALISATION OU ACTIONS ENTREPRISES</th>
<th style="padding:0.85rem;text-align:left;font-size:0.75rem;color:#C8963E;border:1px solid rgba(200,150,62,0.25);width:25%">PERSPECTIVES ET NOUVELLES ACTIONS</th>
<th style="padding:0.85rem;text-align:center;font-size:0.75rem;color:#C8963E;border:1px solid rgba(200,150,62,0.25);width:10%">NB</th>
</tr>
</thead>
<tbody>
<?php foreach($data as $row):
$nb = $total > 0 ? $recentInterventions ? count(array_filter($recentInterventions,function($i) use($row){return $i->type_intervention===$row["type"];})) : 0 : 0;
?>
<tr style="border-bottom:1px solid rgba(200,150,62,0.1)">
<td style="padding:0.85rem;font-size:0.82rem;color:rgba(250,248,242,0.85);border:1px solid rgba(200,150,62,0.1);vertical-align:top">
<span style="color:#C8963E;margin-right:0.4rem">&#9679;</span><?= h($row["points"]) ?>
</td>
<td style="padding:0.85rem;font-size:0.82rem;color:rgba(250,248,242,0.75);border:1px solid rgba(200,150,62,0.1);vertical-align:top;font-style:italic">
<?= h($row["realisation"]) ?>
</td>
<td style="padding:0.85rem;font-size:0.82rem;color:#5EC878;border:1px solid rgba(200,150,62,0.1);vertical-align:top">
&#10003; <?= h($row["perspectives"]) ?>
</td>
<td style="padding:0.85rem;text-align:center;font-size:0.85rem;color:#C8963E;border:1px solid rgba(200,150,62,0.1);vertical-align:top;font-weight:bold">
<?= $nb ?>
</td>
</tr>
<?php endforeach; ?>
</tbody>
<tfoot>
<tr style="background:rgba(200,150,62,0.08)">
<td colspan="3" style="padding:0.75rem;font-size:0.8rem;color:rgba(250,248,242,0.5);border:1px solid rgba(200,150,62,0.15);text-align:right;font-style:italic">Total general des interventions</td>
<td style="padding:0.75rem;text-align:center;font-size:1rem;color:#C8963E;font-weight:bold;border:1px solid rgba(200,150,62,0.15)"><?= $total ?></td>
</tr>
</tfoot>
</table>
</div>
<div style="margin-top:1.5rem;padding:1rem;background:rgba(200,150,62,0.05);border:1px solid rgba(200,150,62,0.15);border-radius:8px">
<div style="font-size:0.75rem;color:rgba(250,248,242,0.4);margin-bottom:0.5rem">BARRE DE PERFORMANCE GLOBALE</div>
<div style="background:rgba(250,248,242,0.06);border-radius:8px;height:20px;overflow:hidden;margin-bottom:0.5rem">
<div style="width:<?= $taux ?>%;height:100%;background:linear-gradient(to right,#2D8C4E,#5EC878);border-radius:8px;display:flex;align-items:center;justify-content:flex-end;padding-right:0.5rem">
<span style="font-size:0.7rem;color:#fff;font-weight:bold"><?= $taux ?>%</span>
</div>
</div>
<div style="font-size:0.78rem;color:rgba(250,248,242,0.5)"><?= $resolues ?> interventions resolues sur <?= $total ?> au total — SERVICE SRM, Ministere du Numerique et de la Communication</div>
</div>
</div>
</div>
<div class="panel" style="margin-top:1.25rem">
<div class="panel-header"><div class="panel-title">&#9874; Interventions Enregistrees</div><a href="/interventions" class="btn-action">Voir tout</a></div>
<div class="panel-body">
<table>
<thead><tr><th>Date</th><th>Beneficiaire</th><th>Type / Mission</th><th>Realisation</th><th>Statut</th></tr></thead>
<tbody>
<?php if(empty($recentInterventions)): ?>
<tr><td colspan="5" style="text-align:center;color:rgba(250,248,242,0.4);font-style:italic;padding:2rem">Aucune intervention enregistree.</td></tr>
<?php else: foreach($recentInterventions as $i): ?>
<tr>
<td><?= h($i->date_intervention) ?></td>
<td><?= h($i->beneficiaire) ?></td>
<td style="font-size:0.75rem"><?= h(str_replace("_"," ",$i->type_intervention)) ?></td>
<td style="font-size:0.75rem;max-width:180px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap"><?= h(substr($i->observation??"-",0,40)) ?><?= strlen($i->observation??"")>40?"...":"" ?></td>
<td><span class="badge-etat <?= $i->statut==="repare"?"etat-ok":($i->statut==="cours"?"etat-pend":"etat-late") ?>"><?= h($i->statut) ?></span></td>
</tr>
<?php endforeach; endif; ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
<style>
@media print{
.sidebar,.topbar,.btn-action,.btn-deconnect{display:none!important}
.main{width:100%!important}
.content{padding:0!important}
body{background:#fff!important;color:#000!important}
.panel{border:1px solid #ccc!important;background:#fff!important}
.panel-title,.stat-label{color:#333!important}
.stat-value{color:#000!important}
table{border-collapse:collapse!important}
th,td{border:1px solid #ccc!important;color:#000!important}
}
</style>