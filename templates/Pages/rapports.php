<?php
$session = $this->request->getSession();
$u = $session->read("Auth.nom") ?? "";
$r = $session->read("Auth.role") ?? "";
$taux = $total > 0 ? round(($resolues/$total)*100,1) : 0;

$data = [
    ["points"=>"Maintenir en premier degre les materiels TIC","realisation"=>"Resolution probleme et maintenance des materiels informatiques","perspectives"=>"Materiel informatique en etat de marche","type"=>"resolution_probleme"],
    ["points"=>"Installer et configurer les nouveaux materiels et equipements informatiques","realisation"=>"Installation et configuration des materiels informatiques","perspectives"=>"Tous les materiels TIC du ministere en etat de marche","type"=>"installation_configuration"],
    ["points"=>"Installation des materiels TIC","realisation"=>"Restitution et mise a niveau des logiciels informatiques","perspectives"=>"Assurer la reinstallation des materiels TIC","type"=>"restoration_mise_a_niveau"],
    ["points"=>"Effectuer des maintenances preventive et curative","realisation"=>"Assurer que les parcs informatiques sont en bon etat de fonctionnement","perspectives"=>"Materiel en bon fonctionnement","type"=>"supervision_fonctionnement"],
    ["points"=>"Surveiller et verifier les problemes et pannes connexion internet","realisation"=>"Supervision et analyse des pannes","perspectives"=>"Reseau local et internet du Ministere fonctionnel","type"=>"supervision_analyse_pannes"],
];
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

<!-- Cartes r-sum- -->
<div class="stats-row">
<div class="stat-card" style="border-top:2px solid #C8963E"><div class="stat-label">Total</div><div class="stat-value"><?= $total ?></div><div class="stat-sub">Interventions</div><div class="stat-icon">&#9874;</div></div>
<div class="stat-card" style="border-top:2px solid #2D8C4E"><div class="stat-label">Resolues</div><div class="stat-value"><?= $resolues ?></div><div class="stat-sub">Taux: <?= $taux ?>%</div><div class="stat-icon">&#10003;</div></div>
<div class="stat-card" style="border-top:2px solid #C8963E"><div class="stat-label">En Cours</div><div class="stat-value"><?= $enCours ?></div><div class="stat-sub">En traitement</div><div class="stat-icon">&#9203;</div></div>
<div class="stat-card" style="border-top:2px solid #5EC878"><div class="stat-label">Taux Resolution</div><div class="stat-value"><?= $taux ?>%</div><div class="stat-sub">Performance</div><div class="stat-icon">&#128200;</div></div>
</div>

<!-- Tableau rapport principal -->
<div class="panel">
<div class="panel-header">
<div class="panel-title">&#128196; RAPPORT D ACTIVITE | SERVICE SRM | Ministere du Commerce et de la Consommation</div>
</div>
<div class="panel-body">
<div style="overflow-x:auto">
<table style="width:100%;border-collapse:collapse">
<thead>
<tr style="background:rgba(200,150,62,0.15)">
<th style="padding:0.85rem;text-align:left;font-size:0.75rem;color:#C8963E;border:1px solid rgba(200,150,62,0.25);width:22%">POINTS EVOQUES</th>
<th style="padding:0.85rem;text-align:left;font-size:0.75rem;color:#C8963E;border:1px solid rgba(200,150,62,0.25);width:25%">REALISATION OU ACTIONS ENTREPRISES</th>
<th style="padding:0.85rem;text-align:left;font-size:0.75rem;color:#C8963E;border:1px solid rgba(200,150,62,0.25);width:25%">PERSPECTIVES ET NOUVELLES ACTIONS</th>
<th style="padding:0.85rem;text-align:left;font-size:0.75rem;color:#C8963E;border:1px solid rgba(200,150,62,0.25);width:20%">TRAVAUX EFFECTUES</th>
<th style="padding:0.85rem;text-align:center;font-size:0.75rem;color:#C8963E;border:1px solid rgba(200,150,62,0.25);width:8%">NB</th>
</tr>
</thead>
<tbody>
<?php foreach($data as $row):
$interventionsType = $grouped[$row["type"]] ?? [];
$nb = count($interventionsType);
?>
<tr style="border-bottom:1px solid rgba(200,150,62,0.1)">

<!-- Points evoqu-s -->
<td style="padding:0.85rem;font-size:0.82rem;color:rgba(250,248,242,0.85);border:1px solid rgba(200,150,62,0.1);vertical-align:top">
<span style="color:#C8963E;margin-right:0.4rem">&#9679;</span><?= h($row["points"]) ?>
</td>

<!-- R-alisation -->
<td style="padding:0.85rem;font-size:0.82rem;color:rgba(250,248,242,0.75);border:1px solid rgba(200,150,62,0.1);vertical-align:top;font-style:italic">
<?= h($row["realisation"]) ?>
</td>

<!-- Perspectives -->
<td style="padding:0.85rem;font-size:0.82rem;color:#5EC878;border:1px solid rgba(200,150,62,0.1);vertical-align:top">
&#10003; <?= h($row["perspectives"]) ?>
</td>

<!-- Travaux reels effectues -->
<td style="padding:0.85rem;font-size:0.78rem;border:1px solid rgba(200,150,62,0.1);vertical-align:top">
<?php if(!empty($interventionsType)): ?>
  <?php foreach($interventionsType as $interv): ?>
  <div style="margin-bottom:0.5rem;padding-bottom:0.5rem;border-bottom:1px solid rgba(200,150,62,0.08)">
    <div style="color:rgba(250,248,242,0.5);font-size:0.7rem"><?= h(is_object($interv->date_intervention) ? $interv->date_intervention->format('d/m/Y') : $interv->date_intervention) ?> - <?= mb_convert_encoding(h($interv->beneficiaire ?? ''), 'UTF-8', 'UTF-8') ?></div>
    <?php if(!empty($interv->description_travaux)): ?>
    <div style="color:#5EC878;margin-top:0.2rem">&#9658; <?= h($interv->description_travaux) ?></div>
    <?php else: ?>
    <div style="color:rgba(250,248,242,0.3);font-style:italic">Non renseigne</div>
    <?php endif; ?>
  </div>
  <?php endforeach; ?>
<?php else: ?>
  <em style="color:rgba(250,248,242,0.3)">Aucune</em>
<?php endif; ?>
</td>

<!-- NB -->
<td style="padding:0.85rem;text-align:center;font-size:1rem;color:#C8963E;border:1px solid rgba(200,150,62,0.1);vertical-align:top;font-weight:bold">
<?= $nb ?>
</td>
</tr>
<?php endforeach; ?>
</tbody>
<tfoot>
<tr style="background:rgba(200,150,62,0.08)">
<td colspan="4" style="padding:0.75rem;font-size:0.8rem;color:rgba(250,248,242,0.5);border:1px solid rgba(200,150,62,0.15);text-align:right;font-style:italic">Total general des interventions</td>
<td style="padding:0.75rem;text-align:center;font-size:1rem;color:#C8963E;font-weight:bold;border:1px solid rgba(200,150,62,0.15)"><?= $total ?></td>
</tr>
</tfoot>
</table>
</div>
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