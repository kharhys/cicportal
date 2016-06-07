<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */

$baseUrl = Yii::$app->request->baseUrl;

$this->title = 'Login';
$error = (isset($error)) ? $error : '';
$url = $baseUrl.'/site/login';
?>

<main class="container">
  <header>
    <h2>Login to your Account</h2>
    <p>Access insurance services tailored for individuals and/or intermediaries.</p>
    <p style="color:#F00"><?= $error; ?></p>
  </header>
  <div class="form">
    <form id="file-form" action="<?= $url; ?>" method="POST" onsubmit="return false;" enctype="multipart/form-data">
      <div class='field'>
        <label for='UserName'>Username</label>
        <input id='UserName' name='UserName' type='text' value='' >
      </div>
      <div class='field'>
        <label for='Password'>Password</label>
        <input id='Password' name='Password' type='password' value='' >
      </div>
      <div class='checkbox'>
        <input id='checkbox' name='checkbox' type='checkbox'>
        <label for='checkbox'>
          Keep me Logged In
        </label>
      </div>
      <button onclick="formhash(this.form)">Login</button>
      <footer>
        <div style="text-align: left; margin-left: -20px; ">
          <?= Html::a('Register', ['index'], ['class' => 'anchor']) ?> here, if you have no account
        </div>
      </footer>
    </form>
  </div>
</main>
