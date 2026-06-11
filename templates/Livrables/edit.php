<?php $s=$this->request->getSession();$u=$s->read("Auth.nom")??"";$r=$s->read("Auth.role")??""; ?>
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
<a href="/livrables" class="nav-item active">&#128197; Livrables</a>
<div class="nav-section">Compte</div>
<a href="/users/profile" class="nav-item">&#128100; Mon Profil</a>
</nav>
<div class="sidebar-user"><div class="user-avatar"><?= strtoupper(substr($u,0,1)) ?></div><div class="user-info"><div class="user-name"><?= h($u) ?></div><div class="user-role"><?= h($r) ?></div></div><a href="/users/logout" class="btn-deconnect">&#10005;</a></div>
</div>
<div class="main">
<div class="topbar"><div class="topbar-title">Modifier Livrable #<?= $livrable->id ?></div><a href="/livrables" class="btn-action">&#8592; Retour</a></div>
<div class="content">
<?= $this->Flash->render() ?>
<div class="panel" style="max-width:500px">
<div class="panel-header"><div class="panel-title">Modifier</div></div>
<div class="panel-body">
<form action="/livrables/edit/<?= $livrable->id ?>" method="post">
<div class="field" style="margin-bottom:1rem">
<label>Date *</label>
<input type="date" name="date_livraison" value="<?= h($livrable->date_livraison) ?>" required style="background:#0F1E12;color:#FAF8F2;border:1px solid rgba(200,150,62,0.3);border-radius:6px;padding:0.6rem;width:100%">
</div>
<div class="field" style="margin-bottom:1rem">
<label>Direction</label>
<input type="text" name="direction" value="<?= h($livrable->direction??') ?>" style="background:#0F1E12;color:#FAF8F2;border:1px solid rgba(200,150,62,0.3);border-radius:6px;padding:0.6rem;width:100%">
</div>
<div class="field" style="margin-bottom:1rem">
<label>Etat *</label>
<select name="etat" style="background:#0F1E12;color:#FAF8F2;border:1px solid rgba(200,150,62,0.3);border-radius:6px;padding:0.6rem;width:100%">
<option value="en_attente" <?= ($livrable->etat==="en_attente")?"selected":"" ?> style="background:#0F1E12">En attente</option>
<option value="livre" <?= ($livrable->etat==="livre")?"selected":"" ?> style="background:#0F1E12">Livre</option>
<option value="retard" <?= ($livrable->etat==="retard")?"selected":"" ?> style="background:#0F1E12">En retard</option>
</select>
</div>
<div class="field" style="margin-bottom:1rem">
<label>Intervention ID (optionnel)</label>
<input type="number" name="intervention_id" value="<?= h($livrable->intervention_id??') ?>" style="background:#0F1E12;color:#FAF8F2;border:1px solid rgba(200,150,62,0.3);border-radius:6px;padding:0.6rem;width:100%">
</div>
<input type="submit" value="Enregistrer" class="btn-submit">
<script>
document.querySelector("input[type=date]").addEventListener("change",function(){
    var d=new Date(this.value);
    var day=d.getUTCDay();
    if(day===0||day===6){
        alert("Date livrable: Lundi au Vendredi uniquement pour la date de livraison!");
        this.value="";
    }
});
document.querySelector("form").addEventListener("submit",function(e){
    var d=new Date(document.querySelector("input[type=date]").value);
    var day=d.getUTCDay();
    if(day===0||day===6){
        e.preventDefault();
        alert("Date livrable: Lundi au Vendredi uniquement pour la date de livraison!");
    }
});
</script></form>
</div></div>
</div></div></div>