<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */

$this->title = 'Lodge Claim';
$url = (Yii::$app->request->baseUrl).'/site/lodgeclaim';

?>

<div class="wrapper" >

  <div id="claims" class="page">
    <header>
      <h1> Lodge Claim </h1>
    </header>
    <section>
      <article >
        <form class="pure-steps form" id="claim" action="<?= $url; ?>" method="POST" enctype="multipart/form-data">
          <input type="radio" name="steps" class="pure-steps_radio" id="step-0" checked="">
          <input type="radio" name="steps" class="pure-steps_radio" id="step-1">
          <input type="radio" name="steps" class="pure-steps_radio" id="step-2">
          <input type="radio" name="steps" class="pure-steps_radio" id="step-3">
          <input type="radio" name="steps" class="pure-steps_radio" id="step-4">
          <div class="pure-steps_group">
            <ol>
              <li class="pure-steps_group-step">
                <fieldset>
                  <legend class="pure-steps_group-step_legend">Risk Details</legend>
                  <div class='field'>
                    <label for='RegistrationNumber'>Registration Number</label>
                    <input id='RegistrationNumber' name='RegistrationNumber' type='text'  >
                  </div>
                  <div class='field'>
                    <label for='PolicyNumber'>Policy Number</label>
                    <input id='PolicyNumber' name='PolicyNumber' type='text'  >
                  </div>
                  <div class='field block_field'>
                    <label for='UseDuringAccident'>Use at time of Accident</label>
                    <input id='UseDuringAccident' name='UseDuringAccident' type='textarea' wrap='hard' >
                  </div>
                  <div class='field'>
                    <label for='DriversName'>Drivers Name</label>
                    <input id='DriversName' name='DriversName' type='text'  >
                  </div>
                  <div class='field'>
                    <label for='DriversAddress'>Drivers Address</label>
                    <input id='DriversAddress' name='DriversAddress' type='text' >
                  </div>
                </fieldset>
              </li>
              <li class="pure-steps_group-step">
                <fieldset>
                  <legend class="pure-steps_group-step_legend">Accident Details</legend>
                  <div class='field'>
                    <label for='DateOfAccident'>Date Of Accident </label>
                    <input class="dateinput" id='DateOfAccident' name='DateOfAccident' type='text' >
                  </div>
                  <div class='field'>
                    <label for='PlaceOfAccident'>Place Of Accident </label>
                    <input id='PlaceOfAccident' name='PlaceOfAccident' type='text' >
                  </div>
                  <div class='field block_field'>
                    <label for='DetailsOfDamage'>Details Of Damage</label>
                    <input id='DetailsOfDamage' name='DetailsOfDamage' type='textarea' wrap='hard' >
                  </div>
                  <div class='field'>
                    <label for='DateReportedToInsurance'> Date Reported To Insurance </label>
                    <input class="dateinput" id='DateReportedToInsurance' name='DateReportedToInsurance' type='text' >
                  </div>
                </fieldset>
              </li>
              <li class="pure-steps_group-step">
                <fieldset>
                  <legend class="pure-steps_group-step_legend">Claimant Details</legend>
                  <div class='field'>
                    <label for='FullNames'> Full Names </label>
                    <input id='FullNames' name='FullNames' type='text' >
                  </div>
                  <div class='field'>
                    <label for='PhoneNumber'> Phone Number </label>
                    <input id='PhoneNumber' name='PhoneNumber' type='text' >
                  </div>
                  <div class='field'>
                    <label for='Passenger'> Passenger? </label>
                    <div class="select">
                      <select name="Passenger" id="Passenger">
                        <option>Choose an option</option>
                        <option value="no">No</option>
                        <option value="yes">Yes</option>
                      </select>
                    </div>
                  </div>
                  <div class='field'>
                    <label for='InvolvementType'> Involvement Type </label>
                    <div class="select">
                      <select name="InvolvementType" id="InvolvementType">
                        <option value='0'>Choose an option</option>
                        <option value="1">Claimant</option>
                        <option value="2">Witness</option>
                        <option value="3">Adverse Party</option>
                        <option value="4">Lawyer</option>
                        <option value="5">Third Party Lawyer</option>
                        <option value="6">Garage</option>
                      </select>
                    </div>
                  </div>
                  <div class='field'>
                    <label for='LossType'> Loss Type </label>
                    <div class="select">
                      <select name="LossType" id="LossType">
                        <option value='0'>Choose an option</option>
                        <option value="1">Asset/Material Damage</option>
                        <option value="2">Injury</option>
                        <option value="3">Theft</option>
                        <option value="4">Fire</option>
                        <option value="5">Fatal</option>
                      </select>
                    </div>
                  </div>
                  <div class='field'>
                    <label for='LocationAtTimeOfAccident'> Location At Time Of Accident </label>
                    <input id='LocationAtTimeOfAccident' name='LocationAtTimeOfAccident' type='text' >
                  </div>
                  <div class='field block_field'>
                    <label for='DetailsOfDamageToClaimant'>Details Of Damage To Claimant</label>
                    <input id='DetailsOfDamageToClaimant' name='DetailsOfDamageToClaimant' type='textarea' wrap='hard' >
                  </div>
                </fieldset>
              </li>
              <li class="pure-steps_group-step flexy-item">
                <div class="pure-steps_preload">
                  <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 32 32" style="enable-background:new 0 0 32 32;" xml:space="preserve">
                    <divath d="M31.8,3.6c-0.2-0.5-0.4-0.9-0.9-1.2C30.4,2,29.7,1.8,29,1.9c-0.6,0.1-1.2,0.4-1.6,1l-8.5,11.2l0,0l-7.2,9.5l-7.1-9.4 c-0.5-0.7-1.3-1-2.1-1c-0.5,0-1,0.2-1.4,0.5c-0.5,0.4-0.9,1-1,1.7s0.1,1.2,0.5,1.8l9.1,12.1l0,0c0.1,0.2,0.3,0.3,0.4,0.4 c0.4,0.3,0.9,0.5,1.4,0.5c0.8,0,1.6-0.3,2.1-1L22.1,18l0,0l9.1-12.1C32,5.2,32.1,4.4,31.8,3.6z"></divath>
                  </svg>
                </div>
              </li>
            </ol>
            <ol class="pure-steps_group-triggers">
              <li class="pure-steps_group-triggers_item">
                <button type="button"> <label for="step-0">Start Over</label> </button>
              </li>
              <li class="pure-steps_group-triggers_item">
                <button type="button"> <label for="step-1">Accident Details <i class="ion-ios-arrow-right"> </i> </label> </button>
              </li>
              <li class="pure-steps_group-triggers_item">
                <button type="button"> <label for="step-2">Claimant Details</label> </button>
              </li>
              <li class="pure-steps_group-triggers_item">
                <button type="submit"> <label for="step-3">Submit</label> </button>
              </li>
            </ol>
          </div>
          <br>
          <div class="dark center bottom">
            <label for="step-0" style="color: #8b91a5">Start Over</label>
          </div>
        </form>
      </article>
    </section>
  </div>

</div>
