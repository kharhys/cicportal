<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use frontend\models\Policytypes;
use frontend\models\Installments;

$this->title = 'Quotes';
$url = (Yii::$app->request->baseUrl).'/site/generatequote';
?>

<div class="quickFade delayFive">
  <main class="container">
    <header>
      <h2>Raise Quote</h2>
      <p>Please fill and submit this form to get a quote for your premiums.</p>
    </header>
    <div class="form">
      <form id="quotes" action="<?= $url; ?>" method="POST" enctype="multipart/form-data">
        <div class='field'>
          <label for='PolicyType'>Policy Type</label>
          <div class="select">
            <select name="PolicyType" id="PolicyType">
              <option>Choose an option</option>
              <?php
              $policytypes = Policytypes::find()->all();
              foreach ($policytypes as $key => $row) { ?>
                <option value="<?=$row->Code; ?>"> <?= $row->Description; ?></option>;
              <?php }  ?>
            </select>
          </div>
        </div>
        <div class='field'>
          <label for='Instalments'>Installments</label>
          <div class="select">
            <select name="Instalments" id="Instalments">
              <option>Choose an option</option>
              <?php
              $instalments = Installments::find()->all();
              foreach ($instalments as $key => $row) { ?>
                <option value="<?=$row['No_ Of Instalments']; ?>"> <?= $row->Description; ?></option>;
              <?php }  ?>
            </select>
          </div>
        </div>
        <div class='field'>
          <label for='CarringCapacity'>Carring Capacity</label>
          <input id='CarringCapacity' name='CarringCapacity' type='number' value='' >
        </div>
        <div class='field'>
          <label for='InsuredAmount'>Insured Amount</label>
          <input id='InsuredAmount' name='InsuredAmount' type='number' value='' >
        </div>
        <div class='field'>
          <label for='RegNumber'>Registration Number</label>
          <input id='RegNumber' name='RegNumber' type='text' value='' >
        </div>
        <div class='checkbox'> </div>
        <button type="submit" style="padding: 5px;">Get Quote</button>
      </form>
    </div>

  </main>
</div>
