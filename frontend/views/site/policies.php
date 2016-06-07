<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use frontend\models\Policytypes;
use frontend\models\Installments;

$this->title = 'Policies';
$baseUrl = Yii::$app->request->baseUrl;

?>

<div id="cv" class="delayTwo">
  <div style="background: #fff !important;">
    <?php if (count($policies) > 0): ?>
      <div class="mainDetails">
        <header class="table-row table-header">
          <div class='table-cell small-table-cell'>Policy No</div>
          <div class='table-cell medium-table-cell'>Customer Name</div>
          <div class='table-cell small-table-cell'>Policy Status</div>
          <div class='table-cell medium-table-cell'>Policy Class</div>
          <div class='table-cell'>policy type</div>
        </header>
          <ul id="quotes-list">
            <?php foreach ($policies as $index => $policy): ?>
              <?php $code = $policy['Policy Type']; $policydesc = Policytypes::find()->where("Code = '$code'")->one(); ?>
              <li class="list-item">
                <a class="table-row" href="<?=($baseUrl."/site/viewpolicy?No_=".$policy['Policy No']) ?>">
                  <div class='table-cell small-table-cell'><?=$policy['Policy No'] ?></div>
                  <div class='table-cell medium-table-cell'><?=$policy['Family Name'] ?></div>
                  <div class='table-cell small-table-cell' ><?=$policy['Policy Status'] ?></div>
                  <div class='table-cell medium-table-cell'><?=$policy['Policy Class'] ?></div>
                  <div class='table-cell'><?=$policydesc['Description'] ?></div>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
      </div>
      <div class="mainDetails" id="metaDetails">
        <div id="clientDetails" class="quickFade delayFour contactDetails">
          <ul>
            <li>Found <?=count($policies) ?> Record(s)</li>
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
        <p> You have no policies yet. <br /> If you already have a quote for your vehicle's insurance check back soon for your policy. </p>
      </div>
    <?php endif; ?>

  </div>
</div>
