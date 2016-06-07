<?php

use yii\helpers\Html;

$this->title = 'Register Account';
$error = (isset($error)) ? $error : '';
$url = (Yii::$app->request->baseUrl).'/site/register';
?>

<div class="page">
  <main id="container">
    <div class='container'>
      <header>
        <h2>Setup Account Profile</h2>
        <p>Access insurance services tailored for individuals and/or intermediaries.</p>
        <p style="color:#F00"><?= $error; ?></p>
      </header>
      <!-- / START Form -->
      <div class='form' >
        <form id="signup-form" action="<?= $url; ?>" method="POST" onsubmit="return false;" enctype="multipart/form-data">
          <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
          <div class='field'>
            <label for='Name'>Name</label>
            <input id='Name' name='Name' tPasswordype='text' value=''>
          </div>
          <div class='field'>
            <label for='UserName'>Email Address</label>
            <input id='UserName' name='UserName' type='email' value='' >
          </div>
          <div class='field'>
            <label for='IDNumber'>ID/Passport Number</label>
            <input id='IDNumber' name='IDNumber' type='text' value='' >
          </div>
          <div class='field'>
            <label for='PhoneNumber'>Phone Number</label>
            <input id='PhoneNumber' name='PhoneNumber' type='text' value=''>
          </div>
          <div class='field'>
            <label for='Password'>Password</label>
            <input id='Password' name='Password' type='password' value=''>
          </div>
          <div class='field'>
            <label for='ConfirmPassword'>Confirm Password</label>
            <input id='ConfirmPassword' name='ConfirmPassword' type='password' value=''>
          </div>
          <div class='checkbox'>
            <input id='checkbox' name='checkbox' type='checkbox'>
            <label for='checkbox'>
              By signing up, you agree with the <a href='#'>terms and conditions</a>
            </label>
          </div>
          <button onclick="regformhash(this.form)">Sign Up</button>
          <footer>
            <div style="text-align: left; margin-left: -20px; ">
              <?= Html::a('Login', ['login'], ['class' => 'anchor']) ?> here, if you already have an account
            </div>
          </footer>
        </form>
      </div>
      <!-- / END Form -->
      <footer>
        Powered By Attain Enterprise Solutions Ltd.
      </footer>
     </div>
  </main>
</div>
