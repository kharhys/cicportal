<?php
namespace frontend\controllers;


use common\models\Profiles;
use common\models\LoginForm;

use frontend\models\Risk;
use frontend\models\Setup;
use frontend\models\Quote;
use frontend\models\Claim;
use frontend\models\Client;
use frontend\models\Ledger;
use frontend\models\Premiums;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\Policytypes;
use frontend\models\Numberseries;
use frontend\models\ResetPasswordForm;
use frontend\models\PasswordResetRequestForm;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                   // 'logout' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin1()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

	public function actionLogin()
	{
        $params = Yii::$app->request->post();
		if (!empty($params))
		{
			$UserName = $params['UserName'];
			$password = $params['p'];
			$identity = Profiles::findOne(['UserName' => $UserName]);
			//$IPAddress = get_client_ip();
			if (!empty($identity))
			{
                /*
				$Salt = $identity->Salt;
				$db_password = $identity->Password;
				$Password = hash('sha512', $password . $Salt);
				if ($db_password == $Password)
				{
					// Logged in User
					Yii::$app->user->login($identity);
					$baseUrl = Yii::$app->request->baseUrl;

					if ($identity->AccountTypeID==1)
					{
						Yii::$app->getResponse()->redirect($baseUrl.'/studentapplication');
					} else if ($identity->AccountTypeID==2) {
						Yii::$app->getResponse()->redirect($baseUrl.'/courseregistration');
					}

				} else
				{
					return $this->render('index', ['error' => 'Invalid Username or Password']);
				}
                */
                Yii::$app->user->login($identity);
                $baseUrl = Yii::$app->request->baseUrl;
                Yii::$app->getResponse()->redirect($baseUrl.'/site/quotes');
			} else
			{
				// Log Failed Login
        Yii::$app->getSession()->setFlash('error', 'Invalid Username or Password');
				return $this->render('login');
			}
		} else
		{
			return $this->render('login');
		}
	}

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
	public function actionLogout()
	{
		Yii::$app->user->logout();
		$baseUrl = Yii::$app->request->baseUrl;
		Yii::$app->getResponse()->redirect($baseUrl);
	}

  /**
   * Sends Email to Client.
   *
   * @return mixed
   */
	public function actionEmailquote()	{
		$params = Yii::$app->request->post();
    $identity = Yii::$app->user->identity;
    $doc =  \yii\web\UploadedFile::getInstanceByName('quote'); //$_FILES['quote'];
    //$doc->save();
    return json_encode($doc);
	}

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
      $message = Yii::$app->mailer->compose();
      $message
        ->setFrom('kelgitonga@gmail.com')
        ->setTo('nrhyska@gmail.com')
        ->setSubject('Message subject')
        ->setTextBody('Plain text content')
        ->setHtmlBody('HTML content')
        ->send();
        print_r('$message sent'); exit;
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()   {
        return $this->render('about');
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionStatements()   {
      $cid = Yii::$app->user->identity->CustomerID;
      $statements = Ledger::find()->limit(4)
        //->where("[Customer No_] = '$cid'")
        ->all();

      //print_r($statements); exit;
      return $this->render('statements', [ 'statements' => $statements ]);
    }

    /**
     * Displays lodge claim form
     *
     * @return mixed
     */
    public function actionClaim()   {
        return $this->render('newclaim');
    }

    /**
     * Displays lodge claim form
     *
     * @return mixed
     */
    public function actionViewclaim()   {

      $params = Yii::$app->request->get();
      $cno = $params['No_'];

      $claim = Claim::find()
          ->where("[Claim No] = '$cno'")
          ->one();

      //print_r($claim); exit;
      return $this->render('claim', [
        'Claim' => $claim,
        'Identity' => Yii::$app->user->identity,
      ]);
    }

    /**
     * Displays claims
     *
     * @return mixed
     */
    public function actionClaims()   {
        $doctype = intval(1);
        $ino = Yii::$app->user->identity->CustomerID;

        $claims = Claim::find()
          ->where("[Insured] = '$ino'")
          ->all();

        return $this->render('claims', [ 'claims' => $claims ]);
    }

    /**
     * Displays lodge claim form
     *
     * @return mixed
     */
    public function actionLodgeclaim()  {
      $params = Yii::$app->request->post();
      $identity = Yii::$app->user->identity;

      $ClaimsSeries = Numberseries::find()->where("[Series Code] = 'CL. NO'")->one();
      $LastUsed = $ClaimsSeries['Last No_ Used'];
      $cn = explode("-", $LastUsed);
      end($cn);
      $key = key($cn);
      $cno = $cn[$key];
      $NextNo = str_pad(($cno + $ClaimsSeries['Increment-by No_']), 4, "0", STR_PAD_LEFT);
      $ClaimNo = 'CLM-'.$NextNo;

      $ClaimsSeries['Last No_ Used'] = $ClaimNo;
      $ClaimsSeries['Last Date Used'] = date("Y-m-d 00:00:00.000");
      $ClaimsSeries->save();

      $claim = new Claim();
      $claim['Status'] = intval(1);
      $claim['Claim No'] = $ClaimNo;
      $claim['Claim Status'] = intval(1);
      $claim['Name'] = $params['FullNames'];
      $claim['Loss Type'] = $params['LossType'];
      $claim['Insured'] = $identity->CustomerID;
      $claim['Name of Insured'] = $identity->Name;
      $claim['Place'] = $params['PlaceOfAccident'];
      $claim['Policy No'] = $params['PolicyNumber'];
      $claim['Driver Name'] = $params['DriversName'];
      $claim['Driver_s Name'] = $params['DriversName'];
      $claim['Claim Type'] = $params['InvolvementType'];
      $claim['Date Reported'] = date("Y-m-d 00:00:00.000");
      $claim['Drivers Address'] = $params['DateOfAccident'];
      $claim['Date of Occurence'] = $params['DateOfAccident'];
      $claim['Insured Telephone No_'] = $identity->PhoneNumber;
      //$claim['Details of damage'] = $params['DetailsOfDamage'];
      $claim['Registration No_'] = $params['RegistrationNumber'];
      $claim['Vehicle Registration No_'] = $params['RegistrationNumber'];
      //$claim['Purpose at time of Accident'] = $params['UseDuringAccident'];
      $claim->save();

      //print_r($claim); exit;
      Yii::$app->getSession()->setFlash('info', 'Your claim has been received. You will hear from us soon.');
      return $this->redirect(['claims']);

    }

    /**
     * Displays quotes page.
     *
     * @return mixed
     */
    public function actionQuotes() {
      $doctype = intval(1);
      $ino = Yii::$app->user->identity->CustomerID;

      $quotes = Risk::find()
        ->where("[Document Type] = '$doctype' AND [Insured No_] = '$ino'")
        ->all();

      //print_r($quotes); exit;
      return $this->render('quotes', [ 'quotes' =>  $quotes ]);
    }

    /**
     * Displays quotes page.
     *
     * @return mixed
     */
    public function actionPolicies() {
      $status = intval(1);
      $doctype = intval(5);
      $ino = Yii::$app->user->identity->CustomerID;

      $policies = Quote::find()
        //->where("[Document Type] = '$doctype' AND [Insured No_] = '$ino'")
        ->where("[Insured No_] = '$ino'  AND [Policy Status] = '$status'")
        ->all();

      //print_r($policies); exit;
      return $this->render('policies', [ 'policies' =>  $policies ]);
    }

    /**
     * Displays new quote form.
     *
     * @return mixed
     */
    public function actionQuote() {
      return $this->render('quote');
    }

    /**
     * Displays an existing quote.
     *
     * @return mixed
     */
    public function actionViewquote() {

      $params = Yii::$app->request->get();
      $doctype = intval(1);
      $qno = $params['No_'];

      $identity = Yii::$app->user->identity;

      $quote = Quote::find()
        ->where("[Document Type] = '$doctype' AND [No_] = '$qno'")
        ->one();

      $docnum = $quote['No_'];

      $risk = Risk::find()->where("[Document No_] = '$docnum'")->one();
      if(empty($risk)) { print_r("Error: Could not retrieve risk from [Insure Lines]"); exit; }

      $premium = $risk['Premium Amount'];
      $PolicyType = $risk['Policy Type'];
      $InsuredAmount = $risk['Sum Insured'];
      $RegNumber = $risk['Registration No_'];
      $Instalments = $risk['No_ Of Instalments'];
      $CarringCapacity = $risk['Carrying Capacity'];

      $policytype = Policytypes::find()->where("Code = '$PolicyType'")->one();
      $type = $policytype['Description'];

      $policy = explode("-", $PolicyType);
      end($policy);
      $key = key($policy);
      if ($policy[$key] % 2 == 0) { $comprehensive = true; }
      else { $comprehensive = false; }

      //print_r($comprehensive); exit;
      return $this->render('quotation', [
        'QuoteNo' => $qno,
        'premium' => $premium,
        'PolicyType' => $type,
        'Identity' => $identity,
        'RegNumber' => $RegNumber,
        'InsuredAmount' => $InsuredAmount,
        'comprehensive'  => $comprehensive
      ]);
    }

    /**
     * Displays an existing policy.
     *
     * @return mixed
     */
    public function actionViewpolicy() {

      $params = Yii::$app->request->get();
      $doctype = intval(1);
      $qno = $params['No_'];

      $identity = Yii::$app->user->identity;

      $quote = Quote::find()
        ->where("[Document Type] = '$doctype' AND [No_] = '$qno'")
        ->one();

      $docnum = $quote['No_'];

      $risk = Risk::find()->where("[Document No_] = '$docnum'")->one();
      if(empty($risk)) { print_r("Error: Could not retrieve risk from [Insure Lines]"); exit; }

      $premium = $risk['Premium Amount'];
      $PolicyType = $risk['Policy Type'];
      $InsuredAmount = $risk['Sum Insured'];
      $RegNumber = $risk['Registration No_'];
      $Instalments = $risk['No_ Of Instalments'];
      $CarringCapacity = $risk['Carrying Capacity'];

      $policytype = Policytypes::find()->where("Code = '$PolicyType'")->one();
      $type = $policytype['Description'];

      $policy = explode("-", $PolicyType);
      end($policy);
      $key = key($policy);
      if ($policy[$key] % 2 == 0) { $comprehensive = true; }
      else { $comprehensive = false; }

      //print_r($comprehensive); exit;
      return $this->render('policy', [
        'Policy' => $risk,
        'QuoteNo' => $qno,
        'premium' => $premium,
        'PolicyType' => $type,
        'Identity' => $identity,
        'RegNumber' => $RegNumber,
        'InsuredAmount' => $InsuredAmount,
        'comprehensive'  => $comprehensive
      ]);
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }
    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionGeneratequote()  {

        $params = Yii::$app->request->post();
        $RegNumber = $params['RegNumber'];
        $PolicyType = $params['PolicyType'];
        $Instalments = $params['Instalments'];
        $InsuredAmount = $params['InsuredAmount'];
        $CarringCapacity = $params['CarringCapacity'];

        $policy = explode("-", $PolicyType);
        end($policy);
        $key = key($policy);
        if ($policy[$key] % 2 == 0) { $comprehensive = true; }
        else { $comprehensive = false; }

        $model = Premiums::find()
        ->where("Instalments = '$Instalments' AND [Policy Type] = '$PolicyType' AND [Seating Capacity] = '$CarringCapacity'")
        ->one();

        //TODO: Ensure model is never null
        if(empty($model)) { $premium = 0; }
        else { $premium = $model['Premium Amount']; }

        $policytype = Policytypes::find()->where("Code = '$PolicyType'")->one();
        $type = $policytype['Description'];

        $identity = Yii::$app->user->identity;

        $header = Quote::find()->where("[Insured No_] = '$identity->CustomerID' AND [Policy Type] = '$PolicyType'")->one();
        if (empty($header)) {

          $QuoteSeries = Numberseries::find()->where("[Series Code] = 'NEW Q'")->one();
          $LastUsed = $QuoteSeries['Last No_ Used'];
          $qn = explode("-", $LastUsed);
          end($qn);
          $key = key($qn);
          $qno = $qn[$key];
          $NextNo = str_pad(($qno + $QuoteSeries['Increment-by No_']), 6, "0", STR_PAD_LEFT);
          $QuoteNo = 'NQ-'.$NextNo;

          $QuoteSeries['Last No_ Used'] = $QuoteNo;
          $QuoteSeries['Last Date Used'] = date("Y-m-d 00:00:00.000");
          $QuoteSeries->save();

          $Quote = new Quote();
          $Quote['No_'] = $QuoteNo;
          $Quote['Quote Type'] = intval(1);
          $Quote['Quotation No_'] = $QuoteNo; //TODO: verify this line
          $Quote['Document Type'] = intval(1);
          $Quote['Policy Type'] = $PolicyType;
          $Quote['E-mail'] = $identity->UserName;
          $Quote['Created By'] = $identity->Name;
          $Quote['Family Name'] = $identity->Name;
          $Quote['No_ Of Instalments'] = $Instalments;
          $Quote['Phone No_'] = $identity->PhoneNumber;
          $Quote['Insured No_'] = $identity->CustomerID;
          $Quote['ID_Passport No_'] = $identity->IDNumber;
          $Quote['Posting Date'] = date("Y-m-d 00:00:00.000");
          $Quote->save();
        } else {
          $Quote = $header;
          $QuoteNo = $Quote['No_'];
        }

        // Find Risk Line  Number
        $one = intval(1);
        $risks = Risk::find()->where("[Document Type] = '$one' AND [Document No_] = '$QuoteNo'")->all();
        $linenum = sprintf('%03d', (count($risks) + $one));

        // Calculate Net Premium
        $stamprate = 0;
        $stampfee = 40;
        $phcfrate = 0.25;
        $traininglevyrate = 0.2;
        $phcf = $premium * $phcfrate / 100;
        $traininglevy = $premium * $traininglevyrate / 100;
        $netpremium = $premium + $phcf + $traininglevy + $stampfee;
        if ($comprehensive) {
          $comprehensiverate = number_format(10, 2);
          $comprehensivelevy = number_format(($InsuredAmount * $comprehensiverate / 100), 2);
          $netpremium += ($InsuredAmount * $comprehensiverate / 100);
        }

        // Insert risk if not done already
        $risk = Risk::find()->where("[Insured No_] = '$identity->CustomerID' AND [Policy Type] = '$PolicyType' AND [Risk ID] = '$RegNumber'")->one();
        if (empty($risk)) {
          $Risk = new Risk();
          $Risk['Status'] = intval(0);
          $Risk['Line No_'] = $linenum;
          $Risk['Risk ID'] = $RegNumber;
          $Risk['Document No_'] = $QuoteNo;
          $Risk['Document Type'] = intval(1);
          $Risk['Premium Amount'] = $premium; // NOTE: Premium Amount vs Net Premium
          $Risk['Net Premium'] = $netpremium;
          $Risk['Policy Type'] = $PolicyType;
          $Risk['Sum Insured'] = $InsuredAmount;
          $Risk['Family Name'] = $identity->Name;
          $Risk['Insured Name'] = $identity->Name;
          $Risk['Registration No_'] = $RegNumber;
          $Risk['No_ Of Instalments'] = $Instalments;
          $Risk['Insured No_'] = $identity->CustomerID;
          $Risk['Seating Capacity'] = $CarringCapacity;
          $Risk['Carrying Capacity'] = $CarringCapacity;
          //$Risk['TPO Premium'] = intval(0);
          //$Risk['Gross Premium'] = intval(0);
          $Risk->save();
        } else {
          $Risk = $risk;
        }

        return $this->render('quotation', [
          'premium' => $premium,
          'QuoteNo' => $QuoteNo,
          'PolicyType' => $type,
          'Identity' => $identity,
          'RegNumber' => $RegNumber,
          'InsuredAmount' => $InsuredAmount,
          'comprehensive'  => $comprehensive
        ]);

    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

	public function actionDashboard()
	{

		return $this->render('dashboard', [ ]);
	}

	public function actionRegister()	{
    //TODO: Enforce unique Email field
		$params = Yii::$app->request->post();
		if (!empty($params))  {
			$model = new Profiles();
			$types = $model->getTableSchema()->columns;
			foreach($model AS $key => $value)	{
				if (array_key_exists($key,$params))	{
					$model[$key] = $params[$key];
				} else if ($key == 'ProfileID')	{
          //DO Nothing
				} else	{
					if ($types["$key"]->type == 'string') {
						$model[$key] = '.';
					} else if (($types["$key"]->type == 'integer')  OR ($types["$key"]->type == 'smallint') OR ($types["$key"]->type == 'decimal'))	{
						$model[$key] = '0';
					} else if ($types["$key"]->type == 'datetime') {
						$model[$key] = '1753-01-01 00:00:00.000';
					}
				}
			}
			$Password = $_REQUEST['p'];
			$random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
			$Password = hash('sha512', $Password . $random_salt);
			$model->AccountTypeID = 1;
			$model->Password = $Password;
			$model->Salt = $random_salt;

      $Setup = Setup::find()->one();
      $IdentityPrefix = $Setup['Insured Nos'];
      $IdentitySeries = Numberseries::find()->where("[Series Code] = '$IdentityPrefix'")->one();
      $LastUsedIdentity = $IdentitySeries['Last No_ Used'];
      $LastUsed = explode(".", $LastUsedIdentity);
      end($LastUsed);
      $key = key($LastUsed);
      $LastUsedNumber = $LastUsed[$key];
      $NextNumber = str_pad(($LastUsedNumber + $IdentitySeries['Increment-by No_']), 4, "0", STR_PAD_LEFT);
      $NextIdentity = $IdentityPrefix.'.'.$NextNumber;
      $IdentitySeries['Last No_ Used'] = $NextIdentity;
      $IdentitySeries['Last Date Used'] = date("Y-m-d 00:00:00.000");
      $IdentitySeries->save();

      $ClientProfile = new Client();
      $ClientProfile['No_'] = $NextIdentity;
      $ClientProfile['Name'] = $params['Name'];
      $ClientProfile['E-Mail'] = $params['UserName'];
      $ClientProfile['Phone No_'] = $params['PhoneNumber'];
      $ClientProfile['ID_Passport No_'] = $params['IDNumber'];
      $ClientProfile->save();

      $model->CustomerID = $NextIdentity;
			if ($model->save()) {
        Yii::$app->getSession()->setFlash('info', 'Your Profile has been created Successfully!');
        return $this->redirect(['index']);
      }
      else { print_r($model->getErrors()); exit;	}
    } else {  return $this->render('register', [  ]);  }
  }

	public function actionProfile()
	{
		$identity = Yii::$app->user->identity;
		$ProfileID = $identity->ProfileID;
		$model = Profiles::findOne($ProfileID);

		$params = Yii::$app->request->post();
		if (!empty($params))
		{
			foreach($model AS $key => $value)
			{
				if (array_key_exists($key,$params))
				{
					$model[$key] = $params[$key];
				}
			}
			if ($model->save())
			{
				return $this->render('profile', [ 'model' => $model, 'error' => 'Saved Successfully']);
			} else
			{
				return $this->render('profile', [ 'model' => $model, 'error' => 'Faild to Save']);
				//print_r($model->getErrors()); exit;
			}
        } else {
           return $this->render('profile', [ 'model' => $model]);
        }
	}

	public function actionChangepassword()
	{
		$params = Yii::$app->request->post();
		if (!empty($params))
		{
			$identity = Yii::$app->user->identity;
			$ProfileID = $identity->ProfileID;
			$model = Profiles::findOne($ProfileID);
			$OldPassword = $params['op'];
			$NewPassword = $params['np'];
			$ConfirmPassword = $params['cp'];

			$OldPassword = hash('sha512', $OldPassword .  $model->Salt);
			if ($OldPassword != $model->Password)
			{
				$msg = "Invalid Password";
			} else
			{
				$NewPassword = hash('sha512', $NewPassword . $model->Salt);
				$model->Password =$NewPassword;
				if ($model->save())
				{
					$msg = "Your password has been changed sucessfully";
				} else
				{
					$msg = "An error occured and we were not able to complete your request";
					//print_r($model->getErrors()); exit;
				}
			}
			return $this->render('changepassword', ['msg' => $msg]);

		} else
		{
			return $this->render('changepassword');
		}
	}

}
