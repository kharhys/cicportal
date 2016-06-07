<?php

/* @var $this yii\web\View */

$baseUrl = Yii::$app->request->baseUrl;

$this->title = 'Registration';
$error = (isset($error)) ? $error : '';
$url = $baseUrl.'/site/register';
?>
<div class="pure-g">
	<div class="pure-u-1 pure-u-md-1-3">
		<h4>Registration</h4> 
		<p style="color:#F00"><?= $error; ?></p>
	<form id="file-form" action="<?= $url; ?>" method="POST" onsubmit="return false;" enctype="multipart/form-data">	
		<label>First Name <span style="color:#F00">*</span></label>
		<div class="input-control text full-size">
			<input name="FirstName" type="text" id="FirstName" value=""/>
		</div>
		<label>Last Name <span style="color:#F00">*</span></label>
		<div class="input-control text full-size">
			<input name="LastName" type="text" id="LastName" value=""/>
		</div>
		<label>Email <span style="color:#F00">*</span></label>
		<div class="input-control text full-size">
			<input name="Email" type="text" id="Email" value=""/>
		</div>
		<label>Your Username <span style="color:#F00">*</span></label>
		<div class="input-control text full-size">
			<input name="UserName" type="text" id="UserName" value=""/>
		</div>		
		<label>Password <span style="color:#F00">*</span></label>
		<div class="input-control text full-size">
			<input name="Password" type="password" id="Password"  value=""/>
		</div>	
		<label>Confirm Password <span style="color:#F00">*</span></label>
		<div class="input-control text full-size">
			<input name="ConfirmPassword" type="password" id="ConfirmPassword"  value=""/>
		</div>			
		<button class="button large-button danger bg-hover-darkRed" onclick="regformhash(this.form)">
								<h5 class="align-left">
								<span class="mif-pencil place-left"></span>&nbsp;
								<span class="text-shadow">Register </span></h5>
		</button>	
	</form>
	</div>