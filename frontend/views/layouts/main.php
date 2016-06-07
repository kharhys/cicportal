<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
$baseUrl = Yii::$app->request->baseUrl;
$addr = explode("?", Yii::$app->request->url);
$address = explode("/", $addr[0]);

end($address);
$key = key($address);
$url = $address[$key];

$identity = Yii::$app->user->identity
//print_r($url); exit;
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
  <head>
    <?php $this->head() ?>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="icon" type="image/png" href="<?= $baseUrl;?>/images/logo.png" />
    <link rel="stylesheet" href="//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body class="quickFade delayTwo">
    <div class="main-container">
      <?php $this->beginBody() ?>

      <?php if ($url != '' && $url != 'index.php'): ?>
        <header id="header">
          <h1>CIC Group Service Portal</h1>
        </header>
      <?php endif; ?>


      <nav id="navigation" class="shadow">
        <?php if ($identity): ?>
          <ul>
            <li class="<?php if ($url == 'index' || $url == '') echo "active";  ?>" >
              <?= Html::a('Home', ['index'], ['class' => '']) ?>
            </li>
            <li class="<?php if ($url == 'quotes' || $url == 'viewquote') echo "active";  ?>" >
              <?= Html::a('Quotes', ['quotes'], ['class' => '']) ?>
            </li>
            <li class="<?php if ($url == 'policies' || $url == 'viewpolicy') echo "active";  ?>" >
              <?= Html::a('Policies', ['policies'], ['class' => '']) ?>
            </li>
            <li class="<?php if ($url == 'claims' || $url == 'lodgeclaim') echo "active";  ?>" >
              <?= Html::a('Claims', ['claims'], ['class' => '']) ?>
            </li>
            <li class="<?php if ($url == 'statements' || $url == 'statement') echo "active";  ?>" >
              <?= Html::a('Statements', ['statements'], ['class' => '']) ?>
            </li>
            <li> <?= Html::a('Logout', ['logout'], ['class' => '']) ?>  </li>
          </ul>
        <?php else : ?>
          <ul>
            <li class="<?php if ($url == 'login') echo "active";  ?>" >
              <?= Html::a('Login', ['login'], ['class' => '']) ?>
            </li>
            <li class="<?php if ($url == 'register') echo "active";  ?>" >
              <?= Html::a('Register', ['register'], ['class' => '']) ?>
            </li>
            <li class="<?php if ($url == 'about') echo "active";  ?>" >
              <?= Html::a('About', ['about'], ['class' => '']) ?>
            </li>
            <li class="<?php if ($url == 'contact') echo "active";  ?>" >
              <?= Html::a('Contact', ['contact'], ['class' => '']) ?>
            </li>
          </ul>
        <?php endif; ?>
      </nav>

      <?php if (Yii::$app->session->getFlash('error')): ?>
        <div class="flash flash__error">  <?= Yii::$app->session->getFlash('error'); ?>  </div>
      <?php endif; ?>
      <?php if (Yii::$app->session->getFlash('info')): ?>
        <div class="flash flash__info">  <?= Yii::$app->session->getFlash('info'); ?>  </div>
      <?php endif; ?>

      <?= $content ?>
      <div class="footer">
        <div class="social">&#62220;</div>
        <div class="social">&#62217;</div>
        <div class="social">&#62223;</div>
        <div class="social">&#62232;</div>
      </div>
      <div style="padding: 1em 0 1px 0; text-align: center; font-weight: bolder">
        <p> Powered by Attain ES Ltd. </p>
      </div>

      <?php $this->endBody() ?>
    </div>
  </body>
  <script>
    $(document).ready(function () {
      var $nav = $('#navigation');
      var posTop = $nav.position().top;
      $(window).scroll(function () {
        var y = $(this).scrollTop();
        if (y > posTop) { $nav.addClass('fixed'); }
        else { $nav.removeClass('fixed'); }
      });
    });
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js" charset="utf-8"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js" charset="utf-8"></script>
</html>
<?php $this->endPage() ?>
