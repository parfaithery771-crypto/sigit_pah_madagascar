<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>SIGIT - Tableau de Bord</title>
<?= $this->Html->css('sigit') ?>
<style>
.dashboard-body{background:#0c0a00 !important}
.panel{background:linear-gradient(135deg,#1a1400,#2a2000) !important}
.stat-card{background:linear-gradient(135deg,#1a1400,#2a2000) !important}
.sidebar{background:linear-gradient(180deg,#050400,#0a0800) !important}
.btn-submit{background:linear-gradient(135deg,#7a6020,#B5A030,#C9B040) !important;color:#0a0800 !important;font-weight:700 !important;border:1px solid rgba(181,160,48,0.5) !important}
body{background:#0c0a00 !important}
</style>
</head>
<body class="dashboard-body">
<?= $this->fetch('content') ?>
</body>
</html>