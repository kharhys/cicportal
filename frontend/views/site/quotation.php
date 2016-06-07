<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use frontend\models\Policytypes;
use frontend\models\Installments;

$this->title = 'Quotes';
$baseUrl = Yii::$app->request->baseUrl;

?>

<div id="cv" class="instaFade">
  <div class="main-ctr">
    <div class="screen-ctr">
      <div class="nav">
        <div class="fab-ctr">
          <div class="fab ion-document"></div>
        </div>
      </div>
      <div class="ripple"></div>
      <ul class="links">
        <li id="preview" class="ion-ios-printer-outline has-tooltip" > <span class="tooltip"><span>Preview</span></span> </li>
        <li id="download" class="ion-ios-cloud-download-outline has-tooltip"> <span class="tooltip"><span>Download</span></span> </li>
        <li id="email" class="ion-ios-email-outline has-tooltip"> <span class="tooltip"><span>Email</span></span> </li>
        <li class="close ion-android-close"></li>
      </ul>
    </div>
  </div>
  <div id="quotation" style="background: #fff !important;">
    <div class="mainDetails">
      <div id="headshot" class="quickFade">
        <img src="<?= $baseUrl;?>/images/logo.png"/>
      </div>

      <div id="name">
        <h1 class="quickFade delayTwo">CIC GROUP</h1>
        <h2 class="quickFade delayThree">Service Quotation</h2>
      </div>

      <div id="contactDetails" class="quickFade delayFour contactDetails" style="padding-top: 20px;">
        <ul>
          <li> </li>
          <li>Contact Centre: +254 703099120</li>
          <li>P. O. Box 59485, Nairobi, Kenya</li>
          <li>Website Address: <a href="http://cic.co.ke/"> cic.co.ke </a></li>
        </ul>
      </div>
      <div class="clear"></div>
    </div>

    <div class="mainDetails" id="addressDetails">
      <div id="clientDetails" class="quickFade delayFour contactDetails">
        <ul>
          <li>Quote: <?=$QuoteNo ?></li>
          <li>Issued: <?=date('M d, Y') ?></li>
          <li>Expires: <?=date('M d, Y', strtotime("+7 day")) ?></li>
        </ul>
      </div>

      <div id="contactDetails" class="quickFade delayFour contactDetails">
        <ul>
          <li>Client Name: <?=$Identity['Name'] ?></li>
          <li>Email: <?=$Identity['UserName'] ?> </li>
          <li>Phone Number: <?=$Identity['PhoneNumber'] ?></li>
        </ul>
      </div>
      <div class="clear"></div>
    </div>

    <div id="mainArea" class="quickFade delayFive">
      <section>
        <article>
          <div class="sectionTitle">
            <h1><?=$PolicyType ?></h1>
            <div class="risk" >
              <dl>
                <dt>Registration:</dt>
                <dd class="caps"><?=$RegNumber ?></dd>
                <dt>Sum Insured: </dt>
                <dd>KSh. <?=number_format($InsuredAmount, 2) ?></dd>
              </dl>
            </div>
          </div>

          <div class="sectionContent">
            <table id="table">
              <thead>
                <tr>
                  <th>Fee</th>
                  <th class="amount">Rates (%)</th>
                  <th class="amount">Premium (KSh.)</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $stamprate = 0;
                $stampfee = 40;
                $phcfrate = 0.25;
                $traininglevyrate = 0.2;
                $phcf = $premium * $phcfrate / 100;
                $traininglevy = $premium * $traininglevyrate / 100;
                $sum = $premium + $phcf + $traininglevy + $stampfee;
                ?>
                <tr>
                  <td data-heading="Company">Premium</td>
                  <td data-heading="Contact" class="amount"></td>
                  <td data-heading="Country" class="amount"><?= number_format($premium, 2) ?></td>
                </tr>
                <tr>
                  <td data-heading="Company">PHCF</td>
                  <td data-heading="Contact" class="amount"><?=$phcfrate ?></td>
                  <td data-heading="Country" class="amount"><?=number_format($phcf, 2) ?></td>
                </tr>
                <tr>
                  <td data-heading="Company">Stamp Duty</td>
                  <td data-heading="Contact" class="amount"><?= $stamprate ?></td>
                  <td data-heading="Country" class="amount"><?= number_format($stampfee, 2) ?></td>
                </tr>
                <tr>
                  <td data-heading="Company">Training Levy</td>
                  <td data-heading="Contact" class="amount"><?=$traininglevyrate ?></td>
                  <td data-heading="Country" class="amount"><?= number_format($traininglevy, 2) ?></td>
                </tr>
                <?php if ($comprehensive) {
                  $comprehensiverate = number_format(10, 2);
                  $comprehensivelevy = number_format(($InsuredAmount * $comprehensiverate / 100), 2);
                  $sum += ($InsuredAmount * $comprehensiverate / 100);
                  echo "
                    <tr>
                      <td data-heading='Comprehensive Levy'>Comprehensive Levy</td>
                      <td data-heading='Comprehensive Rate' class='amount'> $comprehensiverate </td>
                      <td data-heading='Comprehensive Levy Amount' class='amount'> $comprehensivelevy </td>
                    </tr>
                  ";
                } ?>
              </tbody>
              <tfoot>
                <tr>
                  <th colspan='2'>Total Premium</th>
                  <th class="amount"><?= number_format($sum, 2) ?></th>
                </tr>
              </tfoot>
            </table>
          </div>
        </article>
        <div class="clear"></div>
      </section>

    </div>

    <div class="mainDetails" id="metaDetails">
      <div id="clientDetails" class="quickFade delayFour contactDetails">
        <ul>
          <li>Prepared By: <?=$Identity->Name?></li>
        </ul>
      </div>

      <div id="contactDetails" class="quickFade delayFour contactDetails">
        <ul>
          <li></li>
        </ul>
      </div>
      <div class="clear"></div>
    </div>
  </div>
</div>
