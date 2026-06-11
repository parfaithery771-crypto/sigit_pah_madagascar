<?php
$session = $this->request->getSession();
$userName = $session->read("Auth.nom") ?? "Utilisateur";
$userRole = $session->read("Auth.role") ?? "technicien";
$total = $stats[0]["value"] ?? 0;
$resolues = $stats[1]["value"] ?? 0;
$enCours = $stats[2]["value"] ?? 0;
$reparables = $stats[3]["value"] ?? 0;
$tauxResolution = $total > 0 ? round(($resolues / $total) * 100, 1) : 0;
?>
<div class="app">
<div class="sidebar">
<div class="sidebar-header">
<svg width="36" height="36" viewBox="0 0 120 120"><circle cx="60" cy="60" r="58" fill="none" stroke="#2D8C4E" stroke-width="2"/><rect x="32" y="38" width="56" height="36" rx="4" fill="none" stroke="#2D8C4E" stroke-width="2"/><circle cx="46" cy="56" r="4" fill="#C8963E"/><circle cx="60" cy="50" r="4" fill="#C8963E"/><circle cx="74" cy="56" r="4" fill="#C8963E"/><circle cx="60" cy="62" r="4" fill="#2D8C4E"/></svg>
<div><div class="sidebar-logo-text">SIGIT</div><div class="sidebar-sub">Ministere du Numerique</div></div>
</div>
<nav class="nav">
<div class="nav-section">Principal</div>
<a href="/dashboard" class="nav-item active">&#9632; Tableau de Bord</a>
<div class="nav-section">Gestion</div>
<a href="/interventions" class="nav-item">&#9874; Interventions</a>
<a href="/livrables" class="nav-item">&#128197; Liste Livraison</a>
<a href="/statistiques" class="nav-item">&#128202; Statistiques</a>
<div class="nav-section">Administration</div>
<a href="/beneficiaires" class="nav-item">&#128101; Beneficiaires</a>
<a href="/materiel" class="nav-item">&#128187; Parc Materiel</a>
<a href="/rapports" class="nav-item">&#128196; Rapports</a>
<a href="/users/profile" class="nav-item">&#9881; Parametres</a>
</nav>
<div class="sidebar-user">
<?php $__av = $session->read("Auth.avatar") ?? ""; ?>
<?php if($__av): ?><img src="/uploads/avatars/<?= h($__av) ?>" style="width:36px;height:36px;border-radius:50%;border:2px solid #C8963E;object-fit:cover;flex-shrink:0"><?php else: ?><div class="user-avatar"><?= strtoupper(substr($userName,0,1)) ?></div><?php endif; ?>
<div class="user-info"><div class="user-name"><?= h($userName) ?></div><div class="user-role"><?= h($userRole) ?></div></div>
<a href="/users/logout" class="btn-deconnect" title="Deconnexion">&#10005;</a>
</div>
</div>
<div class="main">
<div class="topbar">
<div class="topbar-title">&#9632; Tableau de Bord</div>
<div class="topbar-actions">
<a href="/users/profile" class="btn-action">&#128100; Profil</a>
<a href="/rapports" class="btn-action">&#128196; Rapport</a>
<a href="/interventions" class="btn-action primary">+ Nouvelle Intervention</a>
</div>
</div>
<div class="content">
<?= $this->Flash->render() ?>
<div class="stats-row">
<div class="stat-card" style="border-top:2px solid #C8963E">
<div class="stat-label">Total Interventions</div>
<div class="stat-value"><?= $total ?></div>
<div class="stat-sub">Toutes interventions</div>
<div class="stat-icon">&#9874;</div>
</div>
<div class="stat-card" style="border-top:2px solid #2D8C4E">
<div class="stat-label">Resolues</div>
<div class="stat-value"><?= $resolues ?></div>
<div class="stat-sub">Taux: <?= $tauxResolution ?>%</div>
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
<div style="display:grid;grid-template-columns:1.8fr 1fr;gap:1.25rem;margin-bottom:1.25rem">
<div class="panel">
<div class="panel-header"><div class="panel-title">&#9874; Nouvelle Intervention</div></div>
<div class="panel-body">
<form action="/interventions/add" method="post">
<div style="display:grid;grid-template-columns:1fr 1fr;gap:0.9rem;margin-bottom:0.9rem">
<div class="field"><label>Date *</label><input type="date" name="date_intervention" required value="<?= date("Y-m-d") ?>"></div>
<div class="field"><label>Beneficiaire *</label><input type="text" name="beneficiaire" placeholder="Direction / Service" required></div>
</div>
<div class="field" style="margin-bottom:0.9rem"><label>Points evoques (Mission) *</label>
<select name="type_intervention" required style="background:#0F1E12;color:#FAF8F2;border:1px solid rgba(200,150,62,0.3);border-radius:6px;padding:0.6rem;width:100%">
<option value="" style="background:#0F1E12">-- Selectionner le type --</option>
<option value="maintenance_premier_degre" style="background:#0F1E12">Maintien 1er degre materiels TIC</option>
<option value="installation_configuration" style="background:#0F1E12">Installation et configuration materiels</option>
<option value="restoration_mise_a_niveau" style="background:#0F1E12">Restitution et mise a niveau logiciels</option>
<option value="maintenance_preventive_curative" style="background:#0F1E12">Maintenance preventive et curative</option>
<option value="supervision_analyse_pannes" style="background:#0F1E12">Supervision et analyse des pannes internet</option>
</select></div>
<div class="field" style="margin-bottom:0.9rem"><label>Realisation / Actions entreprises</label>
<textarea name="observation" rows="3" placeholder="Decrire les actions effectuees, l etat du materiel..." style="background:#0F1E12;color:#FAF8F2;border:1px solid rgba(200,150,62,0.3);border-radius:6px;padding:0.6rem;width:100%;font-family:inherit"></textarea></div>
<div class="field" style="margin-bottom:0.9rem"><label>Perspectives et nouvelles actions</label>
<input type="text" name="perspectives" placeholder="Ex: Materiel en etat de marche..." style="background:#0F1E12;color:#FAF8F2;border:1px solid rgba(200,150,62,0.3);border-radius:6px;padding:0.6rem;width:100%"></div>
<div class="field" style="margin-bottom:0.9rem"><label>Statut</label>
<select name="statut" style="background:#0F1E12;color:#FAF8F2;border:1px solid rgba(200,150,62,0.3);border-radius:6px;padding:0.6rem;width:100%">
<option value="cours" style="background:#0F1E12">En cours</option>
<option value="repare" style="background:#0F1E12">Resolu / Repare</option>
<option value="reparable" style="background:#0F1E12">Reparable</option>
</select></div>
<div style="display:flex;gap:0.75rem">
<button type="submit" class="btn-submit" style="flex:1">&#10003; Enregistrer</button>
<button type="reset" class="btn-submit" style="background:transparent;border:1px solid rgba(200,150,62,0.3);flex:0.5">Annuler</button>
</div>
</form>
</div>
</div>
<div class="panel">
<div class="panel-header"><div class="panel-title">&#128202; Repartition</div></div>
<div class="panel-body" style="display:flex;flex-direction:column;align-items:center">
<canvas id="donutChart" width="180" height="180"></canvas>
<div style="margin-top:1rem;width:100%">
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:0.5rem"><span style="display:flex;align-items:center;gap:0.5rem;font-size:0.75rem"><span style="width:10px;height:10px;border-radius:50%;background:#C8963E;display:inline-block"></span>Maintenance 1er degre</span><span style="color:#C8963E;font-size:0.75rem">35%</span></div>
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:0.5rem"><span style="display:flex;align-items:center;gap:0.5rem;font-size:0.75rem"><span style="width:10px;height:10px;border-radius:50%;background:#4A9EE8;display:inline-block"></span>Installation/Config</span><span style="color:#4A9EE8;font-size:0.75rem">25%</span></div>
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:0.5rem"><span style="display:flex;align-items:center;gap:0.5rem;font-size:0.75rem"><span style="width:10px;height:10px;border-radius:50%;background:#2D8C4E;display:inline-block"></span>Restitution/MAJ</span><span style="color:#2D8C4E;font-size:0.75rem">20%</span></div>
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:0.5rem"><span style="display:flex;align-items:center;gap:0.5rem;font-size:0.75rem"><span style="width:10px;height:10px;border-radius:50%;background:#9B59B6;display:inline-block"></span>Maintenance prev/cur</span><span style="color:#9B59B6;font-size:0.75rem">12%</span></div>
<div style="display:flex;justify-content:space-between;align-items:center"><span style="display:flex;align-items:center;gap:0.5rem;font-size:0.75rem"><span style="width:10px;height:10px;border-radius:50%;background:#E74C3C;display:inline-block"></span>Supervision pannes</span><span style="color:#E74C3C;font-size:0.75rem">8%</span></div>
</div>
</div>
</div>
</div>
<div class="panel">
<div class="panel-header">
<div class="panel-title">&#9874; Interventions Recentes</div>
<a href="/interventions" class="btn-action">Voir tout</a>
</div>
<div class="panel-body">
<table>
<thead><tr><th>Date</th><th>Beneficiaire</th><th>Mission / Type</th><th>Realisation</th><th>Statut</th><th>Actions</th></tr></thead>
<tbody>
<?php if(empty($recentInterventions)): ?>
<tr><td colspan="6" style="text-align:center;color:rgba(250,248,242,0.4);font-style:italic;padding:2rem">Aucune intervention enregistree.</td></tr>
<?php else: foreach($recentInterventions as $i): ?>
<tr>
<td><?= h($i->date_intervention) ?></td>
<td><?= h($i->beneficiaire) ?></td>
<td style="font-size:0.75rem"><?= h(str_replace("_"," ",$i->type_intervention)) ?></td>
<td style="font-size:0.75rem;max-width:200px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap"><?= h(substr($i->observation??"-",0,50)) ?><?= strlen($i->observation??""  )>50?"...":"" ?></td>
<td><span class="badge-etat <?= $i->statut==="repare"?"etat-ok":($i->statut==="cours"?"etat-pend":"etat-late") ?>"><?= h($i->statut) ?></span></td>
<td style="display:flex;gap:0.3rem">
<a href="/interventions/edit/<?= $i->id ?>" class="btn-action" style="font-size:0.68rem;padding:0.2rem 0.5rem">Editer</a>
<a href="/interventions/delete/<?= $i->id ?>" class="btn-action" style="font-size:0.68rem;padding:0.2rem 0.5rem;color:#E06060" onclick="return confirm(chr(39)+chr(83)+chr(117)+chr(112)+chr(112)+chr(114)+chr(105)+chr(109)+chr(101)+chr(114)+chr(32)+chr(63)+chr(39))">Suppr</a>
</td>
</tr>
<?php endforeach; endif; ?>
</tbody>
</table>
</div>
</div>
<?php if(!empty($livrablesList)): ?>
<div class="panel">
<div class="panel-header"><div class="panel-title">&#128197; Prochains Livrables</div><a href="/livrables" class="btn-action">Voir tout</a></div>
<div class="panel-body">
<div class="livraison-list">
<?php foreach($livrablesList as $l): ?>
<div class="livraison-item">
<div class="liv-day"><?= date("d/m",strtotime($l->date_livraison)) ?></div>
<div><div class="liv-name"><?= h($l->direction??"Livrable") ?></div></div>
<span class="badge-etat <?= $l->etat==="livre"?"etat-ok":($l->etat==="en_attente"?"etat-pend":"etat-late") ?>"><?= h($l->etat) ?></span>
</div>
<?php endforeach; ?>
</div>
</div>
</div>
<?php endif; ?>
</div>
</div>
</div>
<script>
var canvas=document.getElementById("donutChart");
if(canvas){
var ctx=canvas.getContext("2d");
var cx=90,cy=90,r=70,inner=45;
var data=[{pct:0.35,color:"#C8963E"},{pct:0.25,color:"#4A9EE8"},{pct:0.20,color:"#2D8C4E"},{pct:0.12,color:"#9B59B6"},{pct:0.08,color:"#E74C3C"}];
var start=-Math.PI/2;
data.forEach(function(d){var end=start+d.pct*2*Math.PI;ctx.beginPath();ctx.moveTo(cx,cy);ctx.arc(cx,cy,r,start,end);ctx.closePath();ctx.fillStyle=d.color;ctx.fill();start=end;});
ctx.beginPath();ctx.arc(cx,cy,inner,0,2*Math.PI);ctx.fillStyle="#142818";ctx.fill();
ctx.fillStyle="#FAF8F2";ctx.font="bold 22px Georgia";ctx.textAlign="center";ctx.textBaseline="middle";ctx.fillText("<?= $total ?>",cx,cy-8);
ctx.font="11px Georgia";ctx.fillStyle="rgba(250,248,242,0.5)";ctx.fillText("total",cx,cy+12);
}
</script>