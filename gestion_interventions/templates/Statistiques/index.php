<?php
$session = $this->request->getSession();
$userName = $session->read("Auth.nom") ?? "Utilisateur";
$userRole = $session->read("Auth.role") ?? "technicien";
?>
<div class="app">
<div class="sidebar">
<div class="sidebar-header">
<svg width="36" height="36" viewBox="0 0 120 120"><circle cx="60" cy="60" r="58" fill="none" stroke="#2D8C4E" stroke-width="2"/><rect x="32" y="38" width="56" height="36" rx="4" fill="none" stroke="#2D8C4E" stroke-width="2"/><circle cx="46" cy="56" r="4" fill="#C8963E"/><circle cx="60" cy="50" r="4" fill="#C8963E"/><circle cx="74" cy="56" r="4" fill="#C8963E"/><circle cx="60" cy="62" r="4" fill="#2D8C4E"/></svg>
<div><div class="sidebar-logo-text">SIGIT</div><div class="sidebar-sub">Ministere du Numerique</div></div>
</div>
<nav class="nav">
<div class="nav-section">Principal</div>
<a href="/dashboard" class="nav-item">&#9632; Tableau de Bord</a>
<div class="nav-section">Gestion</div>
<a href="/interventions" class="nav-item">&#9874; Interventions</a>
<a href="/livrables" class="nav-item">&#128197; Liste Livraison</a>
<div class="nav-section">Administration</div>
<a href="/statistiques" class="nav-item active">&#128202; Statistiques</a>
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
<div class="topbar-title">&#128202; Statistiques</div>
<a href="/dashboard" class="btn-action">&#8592; Dashboard</a>
</div>
<div class="content">
<?= $this->Flash->render() ?>
<div class="stats-row">
<div class="stat-card" style="border-top:2px solid #C8963E">
<div class="stat-label">Total</div>
<div class="stat-value"><?= $total ?></div>
<div class="stat-sub">Toutes interventions</div>
<div class="stat-icon">&#9874;</div>
</div>
<div class="stat-card" style="border-top:2px solid #2D8C4E">
<div class="stat-label">Resolues</div>
<div class="stat-value"><?= $resolues ?></div>
<div class="stat-sub">Taux: <?= $taux ?>%</div>
<div class="stat-icon">&#10003;</div>
</div>
<div class="stat-card" style="border-top:2px solid #C8963E">
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
<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;margin-bottom:1.25rem">
<div class="panel">
<div class="panel-header"><div class="panel-title">&#128202; Repartition par Statut</div></div>
<div class="panel-body" style="display:flex;flex-direction:column;align-items:center">
<canvas id="statutChart" width="200" height="200"></canvas>
</div>
</div>
<div class="panel">
<div class="panel-header"><div class="panel-title">&#128202; Repartition par Type</div></div>
<div class="panel-body">
<?php
$colors = ["#C8963E","#4A9EE8","#2D8C4E","#9B59B6","#E74C3C"];
$labels = ["Resolution","Installation","Restauration","Supervision fonct.","Supervision pannes"];
$vals = array_values($parType);
$maxVal = max(array_merge($vals,[1]));
$i = 0;
foreach($parType as $type => $count):
$pct = $maxVal > 0 ? round(($count/$maxVal)*100) : 0;
?>
<div style="margin-bottom:0.85rem">
<div style="display:flex;justify-content:space-between;margin-bottom:0.3rem">
<span style="font-size:0.75rem;color:rgba(250,248,242,0.7)"><?= $labels[$i] ?></span>
<span style="font-size:0.75rem;color:<?= $colors[$i] ?>"><?= $count ?></span>
</div>
<div style="background:rgba(250,248,242,0.06);border-radius:4px;height:8px;overflow:hidden">
<div style="width:<?= $pct ?>%;height:100%;background:<?= $colors[$i] ?>;border-radius:4px;transition:width 1s"></div>
</div>
</div>
<?php $i++; endforeach; ?>
</div>
</div>
</div>
<div class="panel">
<div class="panel-header"><div class="panel-title">&#128200; Taux de Resolution</div></div>
<div class="panel-body">
<div style="display:flex;align-items:center;gap:2rem">
<div style="flex:1">
<div style="font-size:3rem;color:#2D8C4E;font-weight:bold"><?= $taux ?>%</div>
<div style="font-size:0.85rem;color:rgba(250,248,242,0.5);margin-top:0.5rem">des interventions ont ete resolues avec succes</div>
<div style="margin-top:1.5rem;background:rgba(250,248,242,0.06);border-radius:8px;height:16px;overflow:hidden">
<div style="width:<?= $taux ?>%;height:100%;background:linear-gradient(to right,#2D8C4E,#5EC878);border-radius:8px"></div>
</div>
</div>
<div style="text-align:center;padding:1.5rem;border:1px solid rgba(200,150,62,0.2);border-radius:10px;min-width:140px">
<div style="font-size:2rem;color:#C8963E"><?= $resolues ?>/<?= $total ?></div>
<div style="font-size:0.75rem;color:rgba(250,248,242,0.45);margin-top:0.4rem">Resolues / Total</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<script>
var canvas = document.getElementById("statutChart");
if(canvas){
var ctx = canvas.getContext("2d");
var cx=100,cy=100,r=80,inner=55;
var data=[
{val:<?= $resolues ?>,color:"#2D8C4E",label:"Resolues"},
{val:<?= $enCours ?>,color:"#C8963E",label:"En cours"},
{val:<?= $reparables ?>,color:"#E74C3C",label:"Reparables"}
];
var tot=data.reduce(function(a,b){return a+b.val;},0)||1;
var start=-Math.PI/2;
data.forEach(function(d){
var end=start+(d.val/tot)*2*Math.PI;
ctx.beginPath();
ctx.moveTo(cx,cy);
ctx.arc(cx,cy,r,start,end);
ctx.closePath();
ctx.fillStyle=d.color;
ctx.fill();
start=end;
});
ctx.beginPath();
ctx.arc(cx,cy,inner,0,2*Math.PI);
ctx.fillStyle="#142818";
ctx.fill();
ctx.fillStyle="#FAF8F2";
ctx.font="bold 24px Georgia";
ctx.textAlign="center";
ctx.textBaseline="middle";
ctx.fillText("<?= $total ?>",cx,cy-10);
ctx.font="12px Georgia";
ctx.fillStyle="rgba(250,248,242,0.5)";
ctx.fillText("total",cx,cy+12);
}
</script>