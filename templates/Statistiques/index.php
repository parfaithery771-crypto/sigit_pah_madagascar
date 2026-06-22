<?php
$session = $this->request->getSession();
$userName = $session->read("Auth.nom") ?? "Utilisateur";
$userRole = $session->read("Auth.role") ?? "technicien";
?>
<div class="app">
<div class="sidebar">
<div class="sidebar-header">
<img src="/img/logo_mincc.png" style="width:44px;height:44px;object-fit:contain;filter:drop-shadow(0 0 8px rgba(184,150,46,0.4))">
<div><div class="sidebar-logo-text">SIGIT</div><div class="sidebar-sub">Ministere du Commerce et de la Consommation</div></div>
</div>
<nav class="nav">
<div class="nav-section">Principal</div>
<a href="/dashboard" class="nav-item">&#9632; Tableau de Bord</a>
<div class="nav-section">Gestion</div>
<a href="/interventions" class="nav-item">&#9874; Interventions</a>
<a href="/livrables" class="nav-item">&#128197; Liste Livraison</a>
<div class="nav-section">Administration</div>
<a href="/statistiques" class="nav-item active">Statistiques</a>
<a href="/users/profile" class="nav-item">&#9881; Parametres</a>
</nav>
<div class="sidebar-user">
<div class="user-avatar"><?= strtoupper(substr($userName,0,1)) ?></div>
<div class="user-info"><div class="user-name"><?= h($userName) ?></div><div class="user-role"><?= h($userRole) ?></div></div>
<a href="/users/logout" class="btn-deconnect">&#10005;</a>
</div>
</div>
<div class="main">
<div class="topbar">
<div class="topbar-title">Statistiques</div>
<a href="/dashboard" class="btn-action">&#8592; Dashboard</a>
</div>
<div class="content">
<?= $this->Flash->render() ?>

<!-- Cartes r�sum� -->
<div class="stats-row">
<div class="stat-card" style="border-top:2px solid #b5a642">
<div class="stat-label">Total</div>
<div class="stat-value"><?= $total ?></div>
<div class="stat-sub">Toutes interventions</div>
<div class="stat-icon">&#9874;</div>
</div>
<div class="stat-card" style="border-top:2px solid #b5a642">
<div class="stat-label">Resolues</div>
<div class="stat-value"><?= $resolues ?></div>
<div class="stat-sub">Taux: <?= $taux ?>%</div>
<div class="stat-icon">&#10003;</div>
</div>
<div class="stat-card" style="border-top:2px solid #b5a642">
<div class="stat-label">En Cours</div>
<div class="stat-value"><?= $enCours ?></div>
<div class="stat-sub">En traitement</div>
<div class="stat-icon">&#9203;</div>
</div>
<div class="stat-card" style="border-top:2px solid #5EC878">
<div class="stat-label">Reparables</div>
<div class="stat-value"><?= $reparables ?></div>
<div class="stat-sub">En attente</div>
<div class="stat-icon">&#128295;</div>
</div>
</div>

<!-- Graphique type + barres -->
<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;margin-bottom:1.25rem">

<!-- Graphique SVG par type -->
<div class="panel">
<div class="panel-header"><div class="panel-title">Repartition par Type d'intervention</div></div>
<div class="panel-body" style="display:flex;flex-direction:column;align-items:center">
<?php
$colors  = ["#C8102E","#27ae60","#1565C0","#f39c12","#8e44ad"];
$labels  = ["Resolution probleme","Installation/Config","Restauration/MAJ","Supervision fonct.","Supervision pannes"];
$vals    = array_values($parType);
$total2  = array_sum($vals) ?: 1;
$circ    = 2 * M_PI * 60;
$offset  = 0;
$segments = [];
$ci = 0;
foreach($parType as $type => $count) {
    $pct  = $count / $total2;
    $dash = $pct * $circ;
    $segments[] = [
        'dash'   => $dash,
        'offset' => $circ - $offset,
        'color'  => $colors[$ci],
        'label'  => $labels[$ci],
        'count'  => $count,
        'pct'    => $total2 > 0 ? round($pct * 100, 1) : 0,
    ];
    $offset += $dash;
    $ci++;
}
?>
<svg viewBox="0 0 160 160" width="180" height="180">
<?php foreach($segments as $seg): ?>
<circle cx="80" cy="80" r="60"
  fill="none"
  stroke="<?= $seg['color'] ?>"
  stroke-width="28"
  stroke-dasharray="<?= round($seg['dash'],2) ?> <?= round($circ - $seg['dash'],2) ?>"
  stroke-dashoffset="<?= round($seg['offset'],2) ?>"
  transform="rotate(-90 80 80)" />
<?php endforeach; ?>
<circle cx="80" cy="80" r="46" fill="#142818" />
<text x="80" y="75" text-anchor="middle" font-size="18" font-weight="bold" fill="#FAF8F2"><?= $total ?></text>
<text x="80" y="92" text-anchor="middle" font-size="9" fill="rgba(250,248,242,0.5)">interventions</text>
</svg>

<!-- Legende -->
<div style="width:100%;margin-top:0.75rem">
<?php foreach($segments as $seg): ?>
<div style="display:flex;align-items:center;gap:0.5rem;margin-bottom:0.4rem">
  <div style="width:12px;height:12px;border-radius:2px;background:<?= $seg['color'] ?>;flex-shrink:0"></div>
  <div style="font-size:0.75rem;color:rgba(250,248,242,0.7);flex:1"><?= $seg['label'] ?></div>
  <div style="font-size:0.75rem;color:<?= $seg['color'] ?>;font-weight:bold"><?= $seg['count'] ?> (<?= $seg['pct'] ?>%)</div>
</div>
<?php endforeach; ?>
</div>
</div>
</div>

<!-- Barres progression -->
<div class="panel">
<div class="panel-header"><div class="panel-title">Detail par type</div></div>
<div class="panel-body">
<?php
$ci = 0;
foreach($parType as $type => $count):
$pct = $total > 0 ? round(($count/$total)*100,1) : 0;
?>
<div style="margin-bottom:1rem">
  <div style="display:flex;justify-content:space-between;margin-bottom:0.3rem">
    <span style="font-size:0.75rem;color:rgba(250,248,242,0.7)"><?= $labels[$ci] ?></span>
    <span style="font-size:0.75rem;color:<?= $colors[$ci] ?>;font-weight:bold"><?= $count ?> | <?= $pct ?>%</span>
  </div>
  <div style="background:rgba(250,248,242,0.06);border-radius:4px;height:10px;overflow:hidden">
    <div style="width:<?= $pct ?>%;height:100%;background:<?= $colors[$ci] ?>;border-radius:4px;transition:width 1s"></div>
  </div>
</div>
<?php $ci++; endforeach; ?>
</div>
</div>
</div>

<!-- Tableau travaux reels -->
<div class="panel" style="margin-bottom:1.25rem">
<div class="panel-header"><div class="panel-title">&#128295; Travaux effectues (detail reel)</div></div>
<div class="panel-body" style="padding:0">
<table>
<thead>
<tr>
  <th>Date</th>
  <th>Beneficiaire</th>
  <th>Type</th>
  <th>Travaux effectues</th>
  <th>Statut</th>
</tr>
</thead>
<tbody>
<?php if(empty($dernieres)): ?>
<tr><td colspan="5" style="text-align:center;color:rgba(250,248,242,0.4);font-style:italic;padding:2rem">Aucune intervention enregistree.</td></tr>
<?php else: foreach($dernieres as $d): ?>
<tr>
  <td><?= h($d->date_intervention) ?></td>
  <td><?= h($d->beneficiaire) ?></td>
  <td style="font-size:0.75rem"><?= h(str_replace("_"," ",$d->type_intervention)) ?></td>
  <td style="font-size:0.8rem;color:#5EC878">
    <?php if(!empty($d->description_travaux)): ?>
      <?= h($d->description_travaux) ?>
    <?php else: ?>
      <em style="color:rgba(250,248,242,0.3)">Non renseigne</em>
    <?php endif; ?>
  </td>
  <td>
    <span class="badge-etat <?= $d->statut==="repare"?"etat-ok":($d->statut==="cours"?"etat-pend":"etat-late") ?>">
      <?= h($d->statut) ?>
    </span>
  </td>
</tr>
<?php endforeach; endif; ?>
</tbody>
</table>
</div>
</div>

<!-- Taux resolution -->
<div class="panel">
<div class="panel-header"><div class="panel-title">&#128200; Taux de Resolution</div></div>
<div class="panel-body">
<div style="display:flex;align-items:center;gap:2rem">
<div style="flex:1">
  <div style="font-size:3rem;color:#b5a642;font-weight:bold"><?= $taux ?>%</div>
  <div style="font-size:0.85rem;color:rgba(250,248,242,0.5);margin-top:0.5rem">des interventions ont ete resolues avec succes</div>
  <div style="margin-top:1.5rem;background:rgba(250,248,242,0.06);border-radius:8px;height:16px;overflow:hidden">
    <div style="width:<?= $taux ?>%;height:100%;background:linear-gradient(to right,#b5a642,#5EC878);border-radius:8px"></div>
  </div>
</div>
<div style="text-align:center;padding:1.5rem;border:1px solid rgba(200,150,62,0.2);border-radius:10px;min-width:140px">
  <div style="font-size:2rem;color:#b5a642"><?= $resolues ?>/<?= $total ?></div>
  <div style="font-size:0.75rem;color:rgba(250,248,242,0.45);margin-top:0.4rem">Resolues / Total</div>
</div>
</div>
</div>
</div>

</div>
</div>
</div>
