<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use frontend\models\Policytypes;
use frontend\models\Installments;

$this->title = 'Claims';
$baseUrl = Yii::$app->request->baseUrl;

?>

<div id="cv" class="delayTwo">

  <div class="main-ctr">
    <div class="screen-ctr">
      <div class="nav">
        <div class="fab-ctr">
          <a class="quotes-fab ion-ios-plus-empty" href="<?=($baseUrl."/site/claim") ?>"></a>
        </div>
      </div>
      <div class="ripple"></div>
    </div>
  </div>
  <div style="background: #fff !important;">
    <?php if (count($claims) > 0): ?>
      <div class="mainDetails">
        <header class="table-row table-header">
          <div class='table-cell small-table-cell'>index</div>
          <div class='table-cell medium-table-cell'>claim no</div>
          <div class='table-cell small-table-cell'>status</div>
          <div class='table-cell medium-table-cell'>Claim Amount</div>
          <div class='table-cell'>Date Reported</div>
        </header>
          <ul id="quotes-list">
            <?php foreach ($claims as $index => $claim): ?>
              <li class="list-item">
                <a class="table-row" href="<?=($baseUrl."/site/viewclaim?No_=".$claim['Claim No']) ?>">
                  <div class='table-cell small-table-cell' style="padding-left: 10px;"><?=$index ?></div>
                  <div class='table-cell medium-table-cell'><?=$claim['Claim No'] ?></div>
                  <div class='table-cell small-table-cell' ><?=$claim['Status'] ?></div>
                  <div class='table-cell medium-table-cell'>KSh. <?=number_format($claim['Claim Amount'], 2) ?></div>
                  <div class='table-cell'><?=$claim['Date Reported'] ?></div>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
      </div>
      <div class="mainDetails" id="metaDetails">
        <div id="clientDetails" class="quickFade delayFour contactDetails">
          <ul>
            <li>Found <?=count($claims) ?> Record(s)</li>
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
        <p> You have no claims yet. <br /> Click on the button above to lodge a claim on your insurance policy </p>
      </div>
    <?php endif; ?>

  </div>
</div>
