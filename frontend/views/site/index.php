<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'CIC Group';
?>

<style media="screen">
  .box__more {
    display: none;
  }
  .box__content p {
    font-weight: normal;
  }
  .box__title {
    border-bottom: 1px solid #d5d5d5;
    padding: 8px 0;
  }
  .hero h1 {
    visibility: hidden;
  }
  #main-section .box__title, #main-section .box__content p {
    color: #8b91a5 !important;
  }
</style>

<div class="site-about">
  <section class="hero">
    <h1><span>CIC GROUP</span>SERVICE PORTAL</h1>
    <h2>Getting insurance can be as easy as pie. Get help with your insurance needs the convenient way.</h2>
  </section>
  <section class="section" id="main-section">
    <div class="wrapper">
      <h2 class="section__title">CIC Insurance</h2>
      <p class="section__intro">
        Besides giving our customers peace of mind, we continuously work towards living up to our commitment to safeguard
        the interests of individuals and businesses that insure with us by paying claims promptly. Our consistent adherence to our
        motto “We Keep Our Word” has made us the fastest growing insurance company in Kenya and the 2nd largest insurer by market share.
        You now have a convenient and affordable way to get your Travel Insurance on the go.
        Getting insurance can be as easy as pie. Get help with your insurance needs the convenient way.
        You can now conviniently request a quote for your vehicles' insurance on this portal.
        You can also now view your policies, insured risks as well as financial statements for your policies.
        You can also make a car insurance claim online through this portal.
        No more paper work! All you need is internet access!
      </p>
      <div class="box__grid">
        <article class="box">
          <a href="#" class="box__content">
            <i class="fa fa-lightbulb-o fa-3x"></i>
            <h3 class="box__title">Get A Quote</h3>
            <p>You can now conviniently request a quote for your vehicles' insurance on this portal.</p>
            <span class="box__more">Find Out  more <i class="fa fa-arrow-right"></i></span>
          </a>
        </article>
        <article class="box">
          <a href="#" class="box__content">
            <i class="fa fa-code fa-3x"></i>
            <h3 class="box__title"> Policies and Statements</h3>
            <p>You can view your policies, insured risks as well as financial statements for your policies.</p>
            <span class="box__more">Find Out  more <i class="fa fa-arrow-right"></i></span>
          </a>
        </article>
        <article class="box">
          <a href="#" class="box__content"><i class="fa fa-mobile fa-3x"></i>
            <h3 class="box__title">Lodge Claims</h3>
            <p>Make a car insurance claim online. We may ask you to provide documents that help us assess and settle your claim.</p>
            <span class="box__more">Find Out  more <i class="fa fa-arrow-right"></i></span>
          </a>
        </article>
      </div>
    </div>
  </section>
</div>
