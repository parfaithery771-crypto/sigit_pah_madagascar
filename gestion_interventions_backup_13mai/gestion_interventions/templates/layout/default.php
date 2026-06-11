<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>SIGIT - Repoblikan i Madagasikara</title>
<style>
:root{--or:#C8963E;--vert:#2D8C4E;--rouge:#C8102E;--blanc:#FAF8F2;--sombre:#0D1B0F;--bg:#0F1E12}
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:Georgia,serif;background:var(--sombre);color:var(--blanc)}
.accueil-body{height:100vh;overflow:hidden}
.bg-canvas{position:fixed;inset:0;background:radial-gradient(ellipse 80% 60% at 20% 80%,rgba(26,92,46,0.35),transparent 60%),radial-gradient(ellipse 100% 80% at 50% 50%,rgba(13,27,15,0.9),var(--sombre));z-index:0}
.bg-pattern{position:fixed;inset:0;background-image:repeating-linear-gradient(45deg,rgba(200,150,62,0.03) 0px,rgba(200,150,62,0.03) 1px,transparent 1px,transparent 60px);z-index:0}
.scan-line{position:fixed;top:0;left:0;right:0;height:2px;background:linear-gradient(to right,transparent,rgba(200,150,62,0.4),transparent);animation:scan 8s linear infinite;z-index:5}
@keyframes scan{from{top:-2px}to{top:100%}}
.particle{position:fixed;border-radius:50%;pointer-events:none;animation:float linear infinite;z-index:1}
@keyframes float{0%{transform:translateY(100vh);opacity:0}10%{opacity:1}90%{opacity:1}100%{transform:translateY(-100px);opacity:0}}
.page{position:relative;z-index:10;height:100vh;display:flex;flex-direction:column;align-items:center;justify-content:space-between;padding:2rem 1rem 2.5rem}
.header{width:100%;display:flex;align-items:center;justify-content:center;gap:2rem}
.logo-box{display:flex;flex-direction:column;align-items:center;gap:0.3rem}
.logo-svg{width:70px;height:70px;filter:drop-shadow(0 0 12px rgba(200,150,62,0.4))}
.logo-label{font-size:0.6rem;letter-spacing:0.15em;color:var(--or);text-align:center;text-transform:uppercase}
.divider-v{width:1px;height:80px;background:linear-gradient(to bottom,transparent,var(--or),transparent);opacity:0.5}
.hero{text-align:center;flex:1;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:1rem}
.badge{display:inline-flex;align-items:center;border:1px solid rgba(200,150,62,0.4);border-radius:20px;padding:0.3rem 1rem;font-size:0.75rem;letter-spacing:0.2em;color:var(--or);text-transform:uppercase;background:rgba(200,150,62,0.05)}
.hero h1{font-size:clamp(2rem,5vw,3.5rem);font-weight:700;background:linear-gradient(135deg,#E8B84B,var(--blanc),var(--or));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
.subtitle{font-size:clamp(0.85rem,2vw,1.1rem);color:rgba(250,248,242,0.65);letter-spacing:0.08em;font-style:italic;max-width:500px;line-height:1.6}
.ministere-name{font-size:clamp(0.7rem,1.5vw,0.9rem);color:var(--or);letter-spacing:0.12em;text-transform:uppercase}
.ornament{display:flex;align-items:center;gap:1rem}
.ornament-line{width:80px;height:1px;background:linear-gradient(to right,transparent,var(--or))}
.ornament-line.rev{background:linear-gradient(to left,transparent,var(--or))}
.buttons-ring{display:flex;align-items:center;justify-content:center;gap:3rem}
.btn-circle{position:relative;width:110px;height:110px;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:0.5rem;cursor:pointer;border:none;background:none}
.btn-circle-inner{position:absolute;inset:0;border-radius:50%;border:1.5px solid rgba(200,150,62,0.3);background:radial-gradient(ellipse at center,rgba(200,150,62,0.08),transparent 70%);transition:all 0.4s}
.btn-circle-ring{position:absolute;inset:-6px;border-radius:50%;border:1px solid rgba(200,150,62,0.15);transition:all 0.4s}
.btn-circle:hover .btn-circle-inner{background:radial-gradient(ellipse at center,rgba(200,150,62,0.2),rgba(200,150,62,0.05) 70%);border-color:var(--or);box-shadow:0 0 30px rgba(200,150,62,0.3);transform:scale(1.05)}
.btn-circle:hover .btn-circle-ring{border-color:rgba(200,150,62,0.4);transform:scale(1.1) rotate(45deg)}
.btn-icon{position:relative;font-size:1.8rem;transition:transform 0.3s}
.btn-label{position:relative;font-size:0.6rem;letter-spacing:0.15em;text-transform:uppercase;color:var(--or)}
.footer-bar{display:flex;align-items:center;gap:1rem;font-size:0.65rem;letter-spacing:0.1em;color:rgba(250,248,242,0.3);text-transform:uppercase}
.footer-dot{width:3px;height:3px;border-radius:50%;background:var(--or);opacity:0.5}
.overlay{position:fixed;inset:0;z-index:100;background:rgba(13,27,15,0.97);display:none;align-items:center;justify-content:center;backdrop-filter:blur(8px)}
.overlay.active{display:flex}
.panel-base{border:1px solid rgba(200,150,62,0.25);border-radius:16px;padding:2.5rem;position:relative;box-shadow:0 0 60px rgba(200,150,62,0.1);background:linear-gradient(135deg,rgba(26,92,46,0.12),rgba(13,27,15,0.9))}
.login-panel{width:min(420px,90vw);max-height:90vh;overflow-y:auto}
.apropos-panel,.aide-panel{width:min(540px,90vw);max-height:85vh;overflow-y:auto}
.param-panel{width:min(460px,90vw)}
.close-btn{position:absolute;top:1rem;right:1rem;background:none;border:none;color:rgba(250,248,242,0.4);font-size:1.2rem;cursor:pointer;width:32px;height:32px;border-radius:50%;display:flex;align-items:center;justify-content:center;transition:all 0.2s}
.close-btn:hover{color:var(--blanc);background:rgba(200,150,62,0.1)}
.panel-title-h{font-size:1.1rem;color:var(--or);margin-bottom:0.5rem}
.divider-line{display:flex;align-items:center;gap:0.75rem;margin:1rem 0}
.divider-line::before,.divider-line::after{content:"";flex:1;height:1px;background:linear-gradient(to right,transparent,rgba(200,150,62,0.3),transparent)}
.divider-line span{font-size:0.6rem;color:var(--or);letter-spacing:0.2em;text-transform:uppercase}
.login-title{text-align:center;margin-bottom:1rem}
.login-title h2{font-size:1.1rem;color:var(--or);letter-spacing:0.1em}
.login-title p{font-size:0.75rem;color:rgba(250,248,242,0.5);margin-top:0.2rem;font-style:italic}
.form-group{margin-bottom:1.2rem}
.form-group label{display:block;font-size:0.7rem;letter-spacing:0.15em;text-transform:uppercase;color:var(--or);margin-bottom:0.5rem}
.form-group input[type=email],.form-group input[type=password],.form-group input[type=text]{width:100%;background:rgba(250,248,242,0.04);border:1px solid rgba(200,150,62,0.2);border-radius:8px;padding:0.75rem 1rem;color:var(--blanc);font-size:0.9rem;font-family:inherit;outline:none;transition:all 0.3s}
.form-group input:focus{border-color:var(--or);box-shadow:0 0 0 3px rgba(200,150,62,0.1)}
.form-group input::placeholder{color:rgba(250,248,242,0.2)}
.btn-login{width:100%;padding:0.9rem;background:linear-gradient(135deg,var(--vert),#1A5C2E);border:1px solid rgba(200,150,62,0.3);border-radius:8px;color:var(--blanc);font-size:0.85rem;letter-spacing:0.15em;text-transform:uppercase;cursor:pointer;transition:all 0.3s;margin-top:0.5rem}
.btn-login:hover{filter:brightness(1.15);box-shadow:0 0 20px rgba(45,140,78,0.3);transform:translateY(-1px)}
.btn-inscrire{width:100%;padding:0.75rem;background:transparent;border:1px solid rgba(200,150,62,0.25);border-radius:8px;color:rgba(250,248,242,0.6);font-size:0.8rem;letter-spacing:0.12em;text-transform:uppercase;cursor:pointer;transition:all 0.3s}
.btn-inscrire:hover{border-color:var(--or);color:var(--or)}
.feature-grid{display:grid;grid-template-columns:1fr 1fr;gap:0.75rem;margin-top:1rem}
.fi{background:rgba(200,150,62,0.05);border:1px solid rgba(200,150,62,0.15);border-radius:8px;padding:0.75rem}
.fi-icon{font-size:1.2rem;margin-bottom:0.25rem}
.fi-label{font-size:0.65rem;letter-spacing:0.1em;color:var(--or);text-transform:uppercase}
.fi-desc{font-size:0.8rem;color:rgba(250,248,242,0.55);margin-top:0.2rem;font-style:italic}
.param-row{display:flex;align-items:center;justify-content:space-between;padding:0.75rem 0;border-bottom:1px solid rgba(200,150,62,0.1)}
.param-row:last-child{border-bottom:none}
.pr-label{font-size:0.85rem;color:rgba(250,248,242,0.7)}
.pr-val{font-size:0.75rem;color:var(--or);text-transform:uppercase;background:rgba(200,150,62,0.08);border:1px solid rgba(200,150,62,0.2);border-radius:4px;padding:0.25rem 0.6rem}
.aide-q{padding:0.9rem;background:rgba(200,150,62,0.04);border:1px solid rgba(200,150,62,0.1);border-radius:8px;margin-bottom:0.75rem}
.aq-q{font-size:0.78rem;color:var(--or);letter-spacing:0.05em}
.aq-a{font-size:0.82rem;color:rgba(250,248,242,0.6);margin-top:0.4rem;line-height:1.5;font-style:italic}
.app{display:flex;height:100vh;overflow:hidden}
.sidebar{width:240px;min-width:240px;background:rgba(13,27,15,0.98);border-right:1px solid rgba(200,150,62,0.2);display:flex;flex-direction:column}
.sidebar-header{padding:1rem 1.25rem;border-bottom:1px solid rgba(200,150,62,0.2);display:flex;align-items:center;gap:0.75rem}
.sidebar-logo-text{font-size:1.1rem;color:var(--or);letter-spacing:0.1em}
.sidebar-sub{font-size:0.6rem;color:rgba(250,248,242,0.45);letter-spacing:0.08em;text-transform:uppercase;margin-top:1px}
.nav{flex:1;padding:1rem 0;overflow-y:auto}
.nav-section{padding:0.5rem 1.25rem 0.25rem;font-size:0.6rem;letter-spacing:0.2em;text-transform:uppercase;color:rgba(200,150,62,0.5)}
.nav-item{display:flex;align-items:center;gap:0.75rem;padding:0.65rem 1.25rem;cursor:pointer;transition:all 0.2s;font-size:0.88rem;border-left:2px solid transparent;color:rgba(250,248,242,0.7);text-decoration:none}
.nav-item:hover,.nav-item.active{background:rgba(200,150,62,0.07);border-left-color:var(--or);color:var(--or)}
.sidebar-user{padding:1rem 1.25rem;border-top:1px solid rgba(200,150,62,0.2);display:flex;align-items:center;gap:0.75rem}
.user-avatar{width:36px;height:36px;border-radius:50%;border:2px solid var(--or);display:flex;align-items:center;justify-content:center;color:var(--or);font-size:0.85rem;flex-shrink:0;background:linear-gradient(135deg,var(--vert),#1A5C2E)}
.user-info{flex:1;min-width:0}
.user-name{font-size:0.82rem;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.user-role{font-size:0.65rem;color:rgba(250,248,242,0.45);text-transform:uppercase}
.btn-deconnect{background:none;border:none;color:rgba(250,248,242,0.45);cursor:pointer;font-size:1rem;padding:4px;text-decoration:none;transition:color 0.2s}
.btn-deconnect:hover{color:var(--rouge)}
.main{flex:1;display:flex;flex-direction:column;overflow:hidden}
.topbar{padding:0.85rem 1.5rem;background:rgba(13,27,15,0.95);border-bottom:1px solid rgba(200,150,62,0.2);display:flex;align-items:center;justify-content:space-between}
.topbar-title{font-size:1rem;color:var(--blanc);letter-spacing:0.08em}
.topbar-actions{display:flex;align-items:center;gap:0.75rem}
.btn-action{display:flex;align-items:center;gap:0.4rem;padding:0.45rem 0.9rem;border-radius:6px;font-size:0.78rem;cursor:pointer;transition:all 0.2s;border:1px solid rgba(200,150,62,0.2);background:transparent;color:rgba(250,248,242,0.7);text-decoration:none}
.btn-action:hover{border-color:var(--or);color:var(--or)}
.btn-action.primary{background:linear-gradient(135deg,var(--vert),#1A5C2E);border-color:rgba(200,150,62,0.3);color:var(--blanc)}
.content{flex:1;overflow-y:auto;padding:1.5rem}
.stats-row{display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:1.5rem}
.stat-card{background:rgba(20,40,24,0.95);border:1px solid rgba(200,150,62,0.2);border-radius:10px;padding:1rem 1.25rem;position:relative;overflow:hidden}
.stat-card::before{content:"";position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(to right,var(--vert),var(--or))}
.stat-label{font-size:0.65rem;letter-spacing:0.15em;text-transform:uppercase;color:rgba(250,248,242,0.45);margin-bottom:0.4rem}
.stat-value{font-size:1.8rem;color:var(--or);line-height:1}
.stat-sub{font-size:0.75rem;color:rgba(250,248,242,0.45);margin-top:0.3rem;font-style:italic}
.stat-icon{position:absolute;top:1rem;right:1rem;font-size:1.4rem;opacity:0.4}
.grid3{display:grid;grid-template-columns:2fr 1fr;gap:1.25rem;margin-bottom:1.25rem}
.panel{background:rgba(20,40,24,0.95);border:1px solid rgba(200,150,62,0.2);border-radius:10px;overflow:hidden;margin-bottom:1.25rem}
.panel-header{padding:0.85rem 1.25rem;border-bottom:1px solid rgba(200,150,62,0.2);display:flex;align-items:center;justify-content:space-between}
.panel-title{font-size:0.85rem;color:var(--or);letter-spacing:0.08em}
.panel-body{padding:1.25rem}
.form-cols{display:flex;flex-direction:column;gap:0.9rem}
.form-row-2{display:grid;grid-template-columns:1fr 1fr;gap:0.9rem}
.field{display:flex;flex-direction:column;gap:0.35rem}
.field label{font-size:0.65rem;letter-spacing:0.15em;text-transform:uppercase;color:var(--or)}
.field input,.field select,.field textarea,
.form-cols input,.form-cols select,.form-cols textarea{background:rgba(250,248,242,0.04);border:1px solid rgba(200,150,62,0.2);border-radius:6px;padding:0.6rem 0.85rem;color:rgba(250,248,242,0.85);font-size:0.88rem;font-family:inherit;outline:none;transition:all 0.2s;width:100%}
.form-cols input:focus,.form-cols select:focus,.form-cols textarea:focus{border-color:var(--or)}
.form-cols select option{background:#1a2e1e;color:#FAF8F2}
select option{background:#1a2e1e !important;color:#FAF8F2 !important}
select{background:#0F1E12 !important;color:#FAF8F2 !important}
.field select{background:rgba(15,30,18,0.98) !important;color:#FAF8F2 !important}
.btn-submit{padding:0.7rem 1.5rem;background:linear-gradient(135deg,var(--vert),#1A5C2E);border:1px solid rgba(200,150,62,0.3);border-radius:6px;color:var(--blanc);font-size:0.78rem;letter-spacing:0.12em;text-transform:uppercase;cursor:pointer;transition:all 0.2s}
.btn-submit:hover{filter:brightness(1.15)}
.livraison-list{display:flex;flex-direction:column;gap:0.5rem}
.livraison-item{display:grid;grid-template-columns:auto 1fr auto;align-items:center;gap:0.75rem;padding:0.65rem 0.85rem;border-radius:6px;background:rgba(250,248,242,0.03);border:1px solid rgba(200,150,62,0.1)}
.liv-day{font-size:0.65rem;letter-spacing:0.1em;color:var(--or);text-transform:uppercase}
.liv-name{color:rgba(250,248,242,0.85);font-size:0.85rem}
.badge-etat{font-size:0.65rem;padding:0.2rem 0.5rem;border-radius:4px;letter-spacing:0.05em;text-transform:uppercase;white-space:nowrap}
.etat-ok{background:rgba(45,140,78,0.15);border:1px solid rgba(45,140,78,0.3);color:#5EC878}
.etat-pend{background:rgba(200,150,62,0.12);border:1px solid rgba(200,150,62,0.25);color:var(--or)}
.etat-late{background:rgba(178,34,34,0.12);border:1px solid rgba(178,34,34,0.25);color:#E06060}
table{width:100%;border-collapse:collapse;font-size:0.83rem}
th{text-align:left;padding:0.5rem;font-size:0.65rem;color:var(--or);text-transform:uppercase;border-bottom:1px solid rgba(200,150,62,0.2)}
td{padding:0.65rem 0.5rem;border-bottom:1px solid rgba(200,150,62,0.06);color:rgba(250,248,242,0.85)}
.flash-error{background:rgba(178,34,34,0.15);border:1px solid rgba(178,34,34,0.3);border-radius:8px;padding:0.75rem 1rem;color:#E06060;margin-bottom:1rem;font-size:0.85rem}
.flash-success{background:rgba(45,140,78,0.15);border:1px solid rgba(45,140,78,0.3);border-radius:8px;padding:0.75rem 1rem;color:#5EC878;margin-bottom:1rem;font-size:0.85rem}
</style>
</head>
<body>
<?= $this->Flash->render() ?>
<?= $this->fetch('content') ?>
</body>
</html>