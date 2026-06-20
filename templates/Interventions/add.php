<?php $this->assign('title', 'Nouvelle Intervention'); ?>
<p><?= $this->Flash->render() ?></p>
<form method="post" action="/interventions/add">
  <div class="field"><label>Date</label>
    <input type="date" name="date_intervention" required></div>
  <div class="field"><label>Beneficiaire</label>
    <input type="text" name="beneficiaire" required></div>
  <div class="field"><label>Type</label>
    <select name="type_intervention">
      <option value="maintenance">Maintenance</option>
      <option value="installation">Installation</option>
      <option value="resolution">Resolution probleme</option>
      <option value="supervision">Supervision</option>
    </select></div>
  <div class="field"><label>Observation</label>
    <textarea name="observation" rows="3"></textarea></div>
  <div class="field"><label>Statut</label>
    <select name="statut">
      <option value="cours">En cours</option>
      <option value="termine">Termine</option>
    </select></div>
  <button type="submit" class="btn-submit">Enregistrer</button>
</form>