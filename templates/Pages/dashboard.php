<?php
$session=$this->request->getSession();
$userName=$session->read("Auth.nom")??"Utilisateur";
$userRole=$session->read("Auth.role")??"technicien";
$total=$stats[0]["value"]??0;$resolues=$stats[1]["value"]??0;
$enCours=$stats[2]["value"]??0;$reparables=$stats[3]["value"]??0;
$taux=$total>0?round(($resolues/$total)*100,1):0;
$TL=["resolution_probleme"=>"Maintenance 1er degre","installation_configuration"=>"Installation/Config","restoration_mise_a_niveau"=>"Restitution/MAJ","supervision_fonctionnement"=>"Maintenance prev/cur","supervision_analyse_pannes"=>"Supervision pannes"];
$TC=["resolution_probleme"=>"#C8102E","installation_configuration"=>"#27ae60","restoration_mise_a_niveau"=>"#1565C0","supervision_fonctionnement"=>"#f39c12","supervision_analyse_pannes"=>"#8e44ad"];
$countByType=$countByType??[];
$circ=2*M_PI*70;$off=0;$seg=[];$totalType=array_sum($countByType);
foreach($countByType as $tp=>$ct){
$p=$totalType>0?$ct/$totalType:0;$d=$p*$circ;
$seg[]=['dash'=>$d,'offset'=>$circ-$off,'color'=>$TC[$tp]??"#999",'label'=>$TL[$tp]??$tp,'count'=>$ct,'pct'=>$total>0?round($p*100,1):0];
$off+=$d;}
$sug=["Changement RAM","Remplacement disque dur","Reinstallation Windows 10","Nettoyage ventilateur","Remplacement pate thermique","Remplacement ecran","Remplacement clavier","Remplacement batterie","Remplacement alimentation","Configuration reseau","Mise a jour Windows","Installation antivirus","Reinstallation Office","Remplacement souris","Remplacement cable","Diagnostic materiel","Formatage disque","Remplacement carte mere","Ajout SSD","Remplacement imprimante","Configuration imprimante","Depannage connexion internet","Reset mot de passe","Nettoyage virus/malware","Sauvegarde donnees"];
?>
<div class="app">
<style>
body,.dashboard-body{background:radial-gradient(ellipse at top,#1a1200,#000000,#050400) !important}
.app{background:transparent !important}
.sidebar{background:linear-gradient(180deg,#0d0900,#080600,#0d0900) !important;border-right:1px solid rgba(181,160,48,0.30) !important;box-shadow:4px 0 30px rgba(181,160,48,0.08) !important}
.panel,.stat-card{background:linear-gradient(135deg,#1c1500,#261d00,#1c1500) !important;border:1px solid rgba(181,160,48,0.25) !important;box-shadow:0 4px 20px rgba(0,0,0,0.5),inset 0 1px 0 rgba(181,160,48,0.08) !important}
.panel:hover,.stat-card:hover{border-color:rgba(181,160,48,0.50) !important;box-shadow:0 8px 35px rgba(0,0,0,0.6),0 0 20px rgba(181,160,48,0.10),inset 0 1px 0 rgba(181,160,48,0.12) !important}
.panel-header{background:linear-gradient(135deg,rgba(181,160,48,0.10),rgba(0,0,0,0.20)) !important;border-bottom:1px solid rgba(181,160,48,0.22) !important}
.topbar{background:linear-gradient(135deg,#080600,#0f0b00) !important;border-bottom:2px solid rgba(181,160,48,0.40) !important;box-shadow:0 4px 25px rgba(181,160,48,0.10) !important}
.btn-submit{background:linear-gradient(135deg,#4a3408,#8a7020,#D4BC50,#E8D070,#D4BC50,#8a7020,#4a3408) !important;color:#000000 !important;font-weight:900 !important;border:2px solid rgba(212,188,80,0.80) !important;box-shadow:0 4px 25px rgba(181,160,48,0.50),0 0 40px rgba(181,160,48,0.15),inset 0 1px 0 rgba(255,255,255,0.20) !important;text-shadow:0 1px 3px rgba(0,0,0,0.30) !important;letter-spacing:0.18em !important}
.btn-submit:hover{box-shadow:0 8px 40px rgba(181,160,48,0.70),0 0 60px rgba(181,160,48,0.25) !important;transform:translateY(-2px) !important}
.content{background:transparent !important}
.main{background:transparent !important}
</style>
<div class="sidebar">
<div class="sidebar-header">
<img src="/img/logo_mincc.png" style="width:44px;height:44px;object-fit:contain;filter:drop-shadow(0 0 8px rgba(184,150,46,0.4))">
<div><div class="sidebar-logo-text">SIGIT</div><div class="sidebar-sub">Ministere du Commerce et de la Consommation</div></div>
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
<?php $av=$session->read("Auth.avatar")??""; ?>
<?php if($av): ?><img src="/uploads/avatars/<?= h($av) ?>" style="width:36px;height:36px;border-radius:50%;border:2px solid #b5a642;object-fit:cover;flex-shrink:0"><?php else: ?><div class="user-avatar"><?= strtoupper(substr($userName,0,1)) ?></div><?php endif; ?>
<div class="user-info"><div class="user-name"><?= h($userName) ?></div><div class="user-role"><?= h($userRole) ?></div></div>
<a href="/users/logout" class="btn-deconnect">&#10005;</a>
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
<div class="stat-card" style="border-top:2px solid #b5a642"><div class="stat-label">Total</div><div class="stat-value"><?= $total ?></div><div class="stat-sub">Interventions</div><div class="stat-icon">&#9874;</div></div>
<div class="stat-card" style="border-top:2px solid #b5a642"><div class="stat-label">Resolues</div><div class="stat-value"><?= $resolues ?></div><div class="stat-sub">Taux: <?= $taux ?>%</div><div class="stat-icon">&#10003;</div></div>
<div class="stat-card" style="border-top:2px solid #b5a642"><div class="stat-label">En Cours</div><div class="stat-value"><?= $enCours ?></div><div class="stat-sub">En traitement</div><div class="stat-icon">&#9203;</div></div>
<div class="stat-card" style="border-top:2px solid #D4BC50"><div class="stat-label">Reparables</div><div class="stat-value"><?= $reparables ?></div><div class="stat-sub">En attente</div><div class="stat-icon">&#128295;</div></div>
</div>
<div style="display:grid;grid-template-columns:58% 38%;gap:1.25rem;margin-bottom:1.25rem;align-items:start">
<div class="panel">
<div class="panel-header"><div class="panel-title">&#9874; Nouvelle Intervention</div></div>
<div class="panel-body">
<form action="/interventions/add" method="post">
<div style="display:grid;grid-template-columns:1fr 1fr;gap:0.9rem;margin-bottom:0.9rem">
<div class="field"><label>Date *</label><input type="date" name="date_intervention" required value="<?= date('Y-m-d') ?>"></div>
<div class="field"><label>Beneficiaire *</label><input type="text" name="beneficiaire" placeholder="Ex: DRH, DSI..." required></div>
</div>
<div class="field" style="margin-bottom:0.9rem"><label>Type d intervention *</label>
<select name="type_intervention" required style="background:#000000;color:#FAF8F2;border:1px solid rgba(200,150,62,0.3);border-radius:6px;padding:0.6rem;width:100%">
<option value="">-- Selectionner --</option>
<option value="resolution_probleme">Maintenance 1er degre des materiels TIC</option>
<option value="installation_configuration">Installation et configuration des materiels</option>
<option value="restoration_mise_a_niveau">Restitution et mise a niveau des logiciels</option>
<option value="supervision_fonctionnement">Maintenance preventive et curative</option>
<option value="supervision_analyse_pannes">Supervision et analyse des pannes</option>
</select></div>
<div class="field" style="margin-bottom:0.5rem"><label>&#128295; Travaux effectues *</label>
<textarea name="description_travaux" rows="3" required id="ti"
placeholder="Ex: Changement RAM 4Go, Remplacement disque dur..."
style="background:#000000;color:#FAF8F2;border:1px solid rgba(200,150,62,0.3);border-radius:6px;padding:0.6rem;width:100%;font-family:inherit;resize:vertical"></textarea>
</div>
<div class="field" style="margin-bottom:0.9rem">
<label style="font-size:0.75rem;color:rgba(250,248,242,0.5)">Ajout rapide :</label>
<select onchange="aT(this.value);this.selectedIndex=0" style="background:#000000;color:#b5a642;border:1px solid rgba(200,150,62,0.3);border-radius:6px;padding:0.5rem;width:100%;font-family:inherit">
<option value="">-- Selectionner un travail a ajouter --</option>
<?php foreach($sug as $s): ?>
<option value="<?= h($s) ?>"><?= h($s) ?></option>
<?php endforeach; ?>
</select>
</div>
<div class="field" style="margin-bottom:0.9rem"><label>Observations</label>
<textarea name="observation" rows="2" placeholder="Remarques..."
style="background:#000000;color:#FAF8F2;border:1px solid rgba(200,150,62,0.3);border-radius:6px;padding:0.6rem;width:100%;font-family:inherit"></textarea></div>
<div class="field" style="margin-bottom:0.9rem"><label>Statut</label>
<select name="statut" style="background:#000000;color:#FAF8F2;border:1px solid rgba(200,150,62,0.3);border-radius:6px;padding:0.6rem;width:100%">
<option value="cours">En cours</option>
<option value="repare">Resolu / Repare</option>
<option value="reparable">Reparable</option>
</select></div>
<div style="display:flex;gap:0.75rem">
<button type="submit" class="btn-submit" style="background:linear-gradient(135deg,#145a32,#1e8449,#27ae60) !important;color:#ffffff !important;border:2px solid rgba(39,174,96,0.8) !important;box-shadow:0 0 20px rgba(39,174,96,0.5),0 4px 15px rgba(39,174,96,0.4) !important;font-weight:900 !important;letter-spacing:0.2em !important">&#10003; Enregistrer</button>
<button type="reset" class="btn-submit" style="background:linear-gradient(135deg,#145a32,#1e8449,#27ae60) !important;color:#ffffff !important;border:2px solid rgba(39,174,96,0.8) !important;box-shadow:0 0 20px rgba(39,174,96,0.5),0 4px 15px rgba(39,174,96,0.4) !important;font-weight:900 !important;letter-spacing:0.2em !important">Annuler</button>
</div>
</form>
</div>
</div>
<div class="panel">
<div class="panel-header"><div class="panel-title">Repartition par type</div></div>
<div class="panel-body" style="display:flex;flex-direction:column;align-items:center;padding:1rem">
<?php if($total>0): ?>
<svg viewBox="0 0 190 190" width="190" height="190" style="display:block;margin:0 auto 0.75rem">
<?php foreach($seg as $s): ?>
<circle cx="95" cy="95" r="70" fill="none" stroke="<?= $s['color'] ?>" stroke-width="22"
stroke-dasharray="<?= round($s['dash'],2) ?> <?= round($circ-$s['dash'],2) ?>"
stroke-dashoffset="<?= round($s['offset'],2) ?>" transform="rotate(-90 95 95)"/>
<?php endforeach; ?>
<circle cx="95" cy="95" r="56" fill="#000000"/>
<text x="95" y="90" text-anchor="middle" font-size="16" font-weight="bold" fill="#FAF8F2"><?= $total ?></text>
<text x="95" y="107" text-anchor="middle" font-size="9" fill="rgba(250,248,242,0.5)">interventions</text>
</svg>
<?php else: ?>
<div style="width:160px;height:160px;border-radius:50%;border:14px solid rgba(200,150,62,0.15);display:flex;align-items:center;justify-content:center;margin-bottom:0.75rem">
<span style="color:rgba(250,248,242,0.3);font-size:0.8rem">Aucune</span>
</div>
<?php endif; ?>
<div style="width:100%">
<?php foreach($seg as $s): ?>
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:0.45rem;padding:0.3rem 0.5rem;border-radius:4px;background:rgba(250,248,242,0.03)">
<span style="display:flex;align-items:center;gap:0.45rem;font-size:0.72rem;color:rgba(250,248,242,0.75)">
<span style="width:9px;height:9px;border-radius:50%;background:<?= $s['color'] ?>;display:inline-block;flex-shrink:0"></span>
<?= h($s['label']) ?>
</span>
<span style="color:<?= $s['color'] ?>;font-size:0.72rem;font-weight:bold"><?= $s['count'] ?> (<?= $s['pct'] ?>%)</span>
</div>
<?php endforeach; ?>
<?php if(empty($seg)): ?><p style="text-align:center;color:rgba(250,248,242,0.3);font-size:0.8rem;font-style:italic">Aucune intervention</p><?php endif; ?>
</div>
<div style="width:100%;margin-top:0.75rem;padding-top:0.75rem;border-top:1px solid rgba(200,150,62,0.15)">
<div style="display:flex;justify-content:space-between;font-size:0.7rem;margin-bottom:0.3rem">
<span style="color:rgba(250,248,242,0.5)">Taux de resolution</span>
<span style="color:#b5a642;font-weight:bold"><?= $taux ?>%</span>
</div>
<div style="background:rgba(250,248,242,0.06);border-radius:4px;height:8px;overflow:hidden">
<div style="width:<?= $taux ?>%;height:100%;background:linear-gradient(to right,#b5a642,#D4BC50);border-radius:4px"></div>
</div>
</div>
</div>
</div>
</div>
<div class="panel" style="margin-bottom:1.25rem">
<div class="panel-header"><div class="panel-title">&#9874; Interventions Recentes</div><a href="/interventions" class="btn-action">Voir tout</a></div>
<div class="panel-body" style="padding:0">
<table>
<thead><tr><th>Date</th><th>Beneficiaire</th><th>Mission / Type</th><th>Travaux effectues</th><th>Statut</th><th>Actions</th></tr></thead>
<tbody>
<?php if(empty($recentInterventions)): ?>
<tr><td colspan="6" style="text-align:center;color:rgba(250,248,242,0.4);font-style:italic;padding:2rem">Aucune intervention enregistree.</td></tr>
<?php else: ?>
<?php foreach($recentInterventions as $iv): ?>
<tr>
<td><?= h($iv->date_intervention) ?></td>
<td><?= h($iv->beneficiaire) ?></td>
<td style="font-size:0.75rem"><?= h($TL[$iv->type_intervention]??str_replace('_',' ',$iv->type_intervention)) ?></td>
<td style="font-size:0.75rem;color:#b5a642;max-width:200px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">
<?php $dt=$iv->description_travaux??""; echo !empty($dt)?h(substr($dt,0,60)).(strlen($dt)>60?"...":""):"<em style='color:rgba(250,248,242,0.3)'>Non renseigne</em>"; ?>
</td>
<td><span class="badge-etat <?= $iv->statut==="repare"?"etat-ok":($iv->statut==="cours"?"etat-pend":"etat-late") ?>"><?= h($iv->statut) ?></span></td>
<td style="display:flex;gap:0.3rem">
<a href="/interventions/edit/<?= $iv->id ?>" class="btn-action" style="font-size:0.68rem;padding:0.2rem 0.5rem">Editer</a>
<a href="/interventions/delete/<?= $iv->id ?>" class="btn-action" style="font-size:0.68rem;padding:0.2rem 0.5rem;color:#E06060" onclick="return confirm('Supprimer')">Suppr</a>
</td>
</tr>
<?php endforeach; ?>
<?php endif; ?>
</tbody>
</table>
</div>
</div>
<?php if(!empty($livrablesList)): ?>
<div class="panel">
<div class="panel-header"><div class="panel-title">&#128197; Prochains Livrables</div><a href="/livrables" class="btn-action">Voir tout</a></div>
<div class="panel-body">
<div class="livraison-list">
<?php foreach($livrablesList as $lv): ?>
<div class="livraison-item">
<div class="liv-day"><?= date('d/m',strtotime($lv->date_livraison)) ?></div>
<div><div class="liv-name"><?= h($lv->direction??"Livrable") ?></div></div>
<span class="badge-etat <?= $lv->etat==="livre"?"etat-ok":($lv->etat==="en_attente"?"etat-pend":"etat-late") ?>"><?= h($lv->etat) ?></span>
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
function aT(v){var t=document.getElementById('ti');if(!t)return;var c=t.value.trim();t.value=c===''?v:c+', '+v;t.focus();}
</script>

<script>var di=document.querySelector('input[name="date_intervention"]');if(di){di.addEventListener("change",function(){var d=new Date(this.value).getUTCDay();if(d===0||d===6){alert("Lundi au Vendredi uniquement pour la date de livraison!");this.value="";}})};</script>