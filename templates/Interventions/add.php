<?php $this->disableAutoLayout(); $this->assign('title', 'Nouvelle Intervention'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Nouvelle Intervention - SIGIT</title>
<style>
body{background:#0c0a00;color:#FAF8F2;font-family:Georgia,serif;display:flex;align-items:center;justify-content:center;min-height:100vh;margin:0}
.box{background:rgba(150,75,0,0.15);border:1px solid rgba(200,150,62,0.3);border-radius:16px;padding:2rem;width:min(500px,90vw)}
h2{color:#C8963E;text-align:center;margin-bottom:1.5rem}
label{display:block;color:rgba(250,248,242,0.6);font-size:0.8rem;margin-bottom:0.3rem;margin-top:0.8rem}
input,select,textarea{width:100%;background:rgba(255,255,255,0.05);border:1px solid rgba(200,150,62,0.3);border-radius:8px;padding:0.7rem;color:#FAF8F2;font-size:0.9rem;box-sizing:border-box}
.btn{width:100%;background:linear-gradient(135deg,#C8963E,#964B00);border:none;border-radius:8px;padding:0.85rem;color:#FAF8F2;font-size:0.95rem;cursor:pointer;margin-top:1.5rem}
.back{display:block;text-align:center;margin-top:1rem;color:rgba(200,150,62,0.7);font-size:0.8rem;text-decoration:none}
</style>
</head>
<body>
<div class="box">
  <h2>&#128736; Nouvelle Intervention</h2>
  <?= $this->Flash->render() ?>
  <form method="post" action="/interventions/add">
    <label>Date</label>
    <input type="date" name="date_intervention" required>
    <label>Beneficiaire</label>
    <input type="text" name="beneficiaire" required>
    <label>Type d'intervention</label>
    <select name="type_intervention">
      <option value="resolution_probleme">Resolution de probleme</option>
      <option value="installation_configuration">Installation / Configuration</option>
      <option value="restoration_mise_a_niveau">Restoration / Mise a niveau</option>
      <option value="supervision_fonctionnement">Supervision fonctionnement</option>
      <option value="supervision_analyse_pannes">Supervision / Analyse pannes</option>
      <option value="maintenance_premier_degre">Maintenance premier degre</option>
      <option value="maintenance_preventive_curative">Maintenance preventive / curative</option>
    </select>
    <label>Statut</label>
    <select name="statut">
      <option value="cours">En cours</option>
      <option value="repare">Repare</option>
      <option value="reparable">Reparable</option>
    </select>
    <label>Observation</label>
    <textarea name="observation" rows="3"></textarea>
    <label>Description des travaux</label>
    <textarea name="description_travaux" rows="3"></textarea>
    <button type="submit" class="btn">Enregistrer</button>
  </form>
  <a href="/dashboard" class="back">&#8592; Retour au Dashboard</a>
</div>
</body>
</html>