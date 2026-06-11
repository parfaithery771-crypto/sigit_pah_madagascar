<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>SIGIT - Repoblikan i Madagasikara</title>
<?= $this->Html->css('sigit') ?>
<style>
.overlay{background:rgba(8,6,0,0.97) !important}
.panel-base{background:linear-gradient(135deg,rgba(181,160,48,0.06),rgba(8,6,0,0.95)) !important;border:1px solid rgba(181,160,48,0.28) !important}
.btn-login{background:linear-gradient(135deg,#4a3408,#8a7020,#D4BC50,#E8D070,#D4BC50,#8a7020) !important;color:#0a0800 !important;font-weight:800 !important;border:2px solid rgba(212,188,80,0.80) !important}
.user-avatar{background:linear-gradient(135deg,#3a3000,#1a1500) !important;border:2px solid #B5A030 !important}
body,.accueil-body{background:radial-gradient(ellipse at 20% 0%,rgba(181,160,48,0.12),transparent 50%),#080600 !important}
</style>
</head>
<body class="accueil-body">
<?= $this->fetch('content') ?>
<script>
function showOv(n){
  document.querySelectorAll("[id^=ov-]").forEach(function(e){
    e.style.display="none";
  });
  var el=document.getElementById("ov-"+n);
  if(el){ el.style.display="flex"; }
}
function closeOv(){
  document.querySelectorAll("[id^=ov-]").forEach(function(e){
    e.style.display="none";
  });
}
document.addEventListener("keydown",function(e){
  if(e.key==="Escape") closeOv();
});
</script>
</body>
</html>
