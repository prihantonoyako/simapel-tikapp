<?= $this->extend('Layouts/auth') ?>
<?= $this->section('content') ?>
<div id="login-page" class="row">
    <div class="col s12 z-depth-4 card-panel">
      <form class="login-form" method="POST" action="<?= current_url() ?>">
        <div class="row">
          <div class="input-field col s12 center">
            <img src="<?= $avatar ?>" alt="" class="circle responsive-img valign profile-image-login">
            <h4 class="header"><?= $username ?></h4>            
          </div>
        </div>
        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
        <input type='hidden' name="username" value="<?= $username ?>" />
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-action-lock-outline prefix"></i>
            <input id="password" name="password" type="password">
            <label for="password">Password</label>
          </div>
        </div>        
        <div class="row">
          <div class="input-field col s12">
          <button type="submit" class="btn waves-effect waves-light col s12">Login</button>
          </div>
        </div>
        <div class="row">          
          <div class="input-field col s6 m6 l6">
            <p class="margin medium-small"><a href="<?= base_url('web/register')?>">Register Now!</a></p>
          </div>
          <div class="input-field col s6 m6 l6">
              <p class="margin right-align medium-small"><a href="<?= base_url('web/forgot-password') ?>">Forgot password ?</a></p>
          </div>
        </div>

      </form>
    </div>
  </div>
<?= $this->endSection() ?>