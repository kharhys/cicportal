<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use frontend\models\Policytypes;
use frontend\models\Installments;

$this->title = 'Quotes';
$baseUrl = Yii::$app->request->baseUrl;

//print_r(Yii::$app->user->identity['CustomerID']);

?>

<div id="cv" class="delayTwo">

  <div class="main-ctr">
    <div class="screen-ctr">
      <div class="nav">
        <div class="fab-ctr">
          <a class="quotes-fab ion-ios-plus-empty" href="<?=($baseUrl."/site/quote") ?>"></a>
        </div>
      </div>
      <div class="ripple"></div>
    </div>
  </div>
  <div style="background: #fff !important;">
    <?php if (count($quotes) > 0): ?>
      <div class="mainDetails">
        <header class="table-row table-header">
          <div class='table-cell small-table-cell'>index</div>
          <div class='table-cell medium-table-cell'>quote no</div>
          <div class='table-cell small-table-cell'>status</div>
          <div class='table-cell medium-table-cell'>Net Premium</div>
          <div class='table-cell'>policy type</div>
          <div class='table-cell medium-table-cell'>Registration</div>
        </header>
          <ul id="quotes-list">
            <?php foreach ($quotes as $index => $quote): ?>
              <?php $code = $quote['Policy Type']; $policy = Policytypes::find()->where("Code = '$code'")->one(); ?>
              <li class="list-item">
                <a class="table-row" href="<?=($baseUrl."/site/viewquote?No_=".$quote['Document No_']) ?>">
                  <div class='table-cell small-table-cell' style="padding-left: 10px;"><?=$index ?></div>
                  <div class='table-cell medium-table-cell'><?=$quote['Document No_'] ?></div>
                  <div class='table-cell small-table-cell' ><?=$quote['Document Type'] ?></div>
                  <div class='table-cell medium-table-cell'>KSh. <?=number_format($quote['Net Premium'], 2) ?></div>
                  <div class='table-cell'><?=$policy['Description'] ?></div>
                  <div class='table-cell medium-table-cell' style="text-transform: uppercase"><?=$quote['Registration No_'] ?></div>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
      </div>
      <div class="mainDetails" id="metaDetails">
        <div id="clientDetails" class="quickFade delayFour contactDetails">
          <ul>
            <li>Found <?=count($quotes) ?> Record(s)</li>
          </ul>
        </div>
        <div id="contactDetails" class="quickFade delayFour contactDetails">
          <ul>
            <li>Updated a moment ago</li>
          </ul>
        </div>
        <div class="clear"></div>
      </div>

    <?php else: ?>
      <div class="engraved">
        <p> You have no quotes yet. <br /> Click on the button above to get a quote for your vehicle's insurance </p>
      </div>
    <?php endif; ?>

  </div>
</div>
