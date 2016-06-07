<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use frontend\models\Policytypes;
use frontend\models\Installments;

$this->title = 'Policy';
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
        <h2 class="quickFade delayThree">Insurance Policy Details </h2>
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
          <li>Policy: <?=$QuoteNo ?></li>
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
            <h1 style="text-transform: uppercase; font-weight: bold; font-size: 1.1em"><?=$RegNumber ?></h1>
            <div class="risk" >
              <dl>
                <dt>Sum Insured: </dt>
                <dd>KSh. <?=number_format($InsuredAmount, 2) ?></dd>
                <dt>Policy Status:</dt>
                <dd><?=$Policy['Status'] ?></dd>
              </dl>
            </div>
          </div>

          <div class="sectionContent">
            <div class="riskInfo">
              <dl>
                <dt>Policy Number</dt>
                <dd><?=$Policy['Policy No'] ?></dd>
                <dt>Policy Type</dt>
                <dd><?=$Policy['Policy Type'] ?></dd>
                <dt>Line Number</dt>
                <dd><?=$Policy['Line No_'] ?></dd>
                <dt>Line Number</dt>
                <dd><?=$Policy['Line No_'] ?></dd>
                <dt>Status</dt>
                <dd><?=$Policy['Status'] ?></dd>
                <dt>Net Premium</dt>
                <dd>KSh. <?=number_format($Policy['Net Premium'], 2) ?></dd>
                <dt>Seating Capacity</dt>
                <dd><?=$Policy['Seating Capacity'] ?></dd>
                <dt>Year of Manufacture</dt>
                <dd><?=$Policy['Year of Manufacture'] ?></dd>
                <dt>Policy Start Date</dt>
                <dd><?=$Policy['Start Date'] ?></dd>
                <dt>Policy End Date</dt>
                <dd><?=$Policy['End Date'] ?></dd>
                <dt>Number Of Instalments</dt>
                <dd><?=$Policy['No_ Of Instalments'] ?></dd>
              </dl>
            </div>
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
