<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use frontend\models\Installments;

$this->title = 'Claim';
$baseUrl = Yii::$app->request->baseUrl;


$ClaimNo = $Claim['Claim No'];
$ClaimAmount = $Claim['Claim Amount'];
$RegNumber = $Claim['Registration No_'];

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
        <h2 class="quickFade delayThree">Claim Details </h2>
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
          <li>Claim No: <?=$ClaimNo ?></li>
          <li>Reported On: <?=substr($Claim['Date Reported'], 0, 10) ?></li>
          <li>Closes On: <?=substr($Claim['Claim Closure Date'], 0, 10) ?></li>
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
                <dt>Claim Amount: </dt>
                <dd>KSh. <?=number_format($ClaimAmount, 2) ?></dd>
                <dt>Claim Status</dt>
                <dd><?=$Claim['Claim Status'] ?></dd>
              </dl>
            </div>
          </div>

          <div class="sectionContent">
            <div class="riskInfo">
              <dl>
                <dt>Policy Number</dt>
                <dd><?=$Claim['Policy No'] ?></dd>
                <dt>Policy Type</dt>
                <dd><?=$Claim['Policy Type'] ?></dd>
                <dt>Claim Number</dt>
                <dd><?=$Claim['Claim No'] ?></dd>
                <dt>Claim Type</dt>
                <dd><?=$Claim['Claim Type'] ?></dd>
                <dt>Claim Status</dt>
                <dd><?=$Claim['Claim Status'] ?></dd>
                <dt>Date of Accident</dt>
                <dd><?=substr($Claim['Date of Occurence'], 0, 10) ?></dd>
                <dt>Reported to Police</dt>
                <dd><?=$Claim['Reported to Police'] ?></dd>
                <dt>Nature and Cause of Accident</dt>
                <dd><?=$Claim['Nature and Cause of Accident'] ?></dd>
                <dt>Loss Type</dt>
                <dd><?=$Claim['Loss Type'] ?></dd>
                <dt>Loss Type Description</dt>
                <dd><?=$Claim['Loss Type Description'] ?></dd>
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
