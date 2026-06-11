<div class="bg-canvas"></div><div class="bg-pattern"></div><div class="scan-line"></div>
<div class="page" style="justify-content:center;padding-top:3rem">
<div class="panel-base login-panel">
<div class="login-title">
<div class="login-logos-row">
<?= $this->Html->image("logo_repoblika.png",["class"=>"login-logo-img","alt"=>"Logo"]) ?>
</div>
<h2>&#9670; SIGIT &#9670;</h2>
<p>Creer un compte</p>
</div>
<div class="divider-line"><span>Inscription</span></div>
<?= $this->Flash->render() ?>
<?= $this->Form->create($user,["url"=>"/users/add","type"=>"post"]) ?>
<div class="form-group">
<label>Nom</label>
<?= $this->Form->control("nom",["label"=>false,"placeholder"=>"Votre nom"]) ?>
</div>
<div class="form-group">
<label>Prenom</label>
<?= $this->Form->control("prenom",["label"=>false,"placeholder"=>"Votre prenom"]) ?>
</div>
<div class="form-group">
<label>Email</label>
<?= $this->Form->control("email",["label"=>false,"type"=>"email","placeholder"=>"votre@email.mg"]) ?>
</div>
<div class="form-group">
<label>Mot de passe</label>
<?= $this->Form->control("password",["label"=>false,"placeholder"=>"........"]) ?>
</div>
<?= $this->Form->submit("S inscrire et se connecter",["class"=>"btn-login"]) ?>
<?= $this->Form->end() ?>
<div class="login-links" style="justify-content:center;margin-top:1rem">
<?= $this->Html->link("Deja un compte? Se connecter",["/users/login"]) ?>
</div>
</div>
</div>
