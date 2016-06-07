<?php

namespace common\models;

use Yii;
use yii\base\Security;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\base\NotSupportedException;


/**
* This is the model class for table "users".
*
* @property integer $UserID
* @property string $LastName
* @property string $MiddleName
* @property string $FirstName
* @property string $PostalAddress
* @property string $PostalCode
* @property string $Town
* @property integer $CountryID
* @property string $PhoneNumber
* @property string $Mobile
* @property string $Email
* @property string $Url
* @property string $UserName
* @property string $Password
* @property integer $UserStatusID
* @property string $CreatedDate
* @property integer $EmployeeID
* @property integer $CreatedUserID
* @property string $Telephone
* @property integer $AgencyID
* @property integer $Admin
* @property integer $SuperAdmin
* @property integer $AgencyBranchID
* @property integer $UserGroupID
* @property integer $UserTypeID
* @property string $Rights
*/

class Profiles extends \yii\db\ActiveRecord  implements \yii\web\IdentityInterface {

  const STATUS_DELETED = 0;
  const STATUS_ACTIVE = 10;

  /**
  * @inheritdoc
  */
  public static function tableName()
  {
    return 'TRANSCOOP$Online Profiles';
  }

  public static function primaryKey()
  {
    return array('ProfileID');
    // For composite primary key, return an array like the following
    // return array('pk1', 'pk2');
  }

  /** INCLUDE USER LOGIN VALIDATION FUNCTIONS**/
  /**
  * @inheritdoc
  */
  public static function findIdentity($id)
  {
    return static::findOne($id);
  }

  /**
  * @inheritdoc
  */
  /* modified */
  public static function findIdentityByAccessToken($token, $type = null)
  {
    return static::findOne(['access_token' => $token]);
  }

  /* removed
  public static function findIdentityByAccessToken($token)
  {
  throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
}
*/
/**
* Finds user by username
*
* @param  string      $username
* @return static|null
*/
public static function findByUsername($username)
{
  return static::findOne(['username' => $username]);
}

/**
* Finds user by password reset token
*
* @param  string      $token password reset token
* @return static|null
*/
public static function findByPasswordResetToken($token)
{
  $expire = \Yii::$app->params['user.passwordResetTokenExpire'];
  $parts = explode('_', $token);
  $timestamp = (int) end($parts);
  if ($timestamp + $expire < time()) {
    // token expired
    return null;
  }

  return static::findOne([
    'PasswordResetToken' => $token
  ]);
}

/**
* @inheritdoc
*/
public function getId()
{
  return $this->getPrimaryKey();
}

/**
* @inheritdoc
*/
public function getAuthKey()
{
  return $this->auth_key;
}

/**
* @inheritdoc
*/
public function validateAuthKey($authKey)
{
  return $this->getAuthKey() === $authKey;
}

/**
* Validates password
*
* @param  string  $password password to validate
* @return boolean if password provided is valid for current user
*/
public function validatePassword($password)
{
  return $this->password === sha1($password);
}

/**
* Generates password hash from password and sets it to the model
*
* @param string $password
*/
public function setPassword($password)
{
  $this->password_hash = Security::generatePasswordHash($password);
}

/**
* Generates "remember me" authentication key
*/
public function generateAuthKey()
{
  $this->auth_key = Security::generateRandomKey();
}

/**
* Generates new password reset token
*/
public function generatePasswordResetToken()
{
  $this->PasswordResetToken = Security::generateRandomString() . '_' . time();
}

/**
* Removes password reset token
*/
public function removePasswordResetToken()
{
  $this->PasswordResetToken = null;
}

/**
 * Finds out if password reset token is valid
 *
 * @param string $token password reset token
 * @return boolean
 */
public static function isPasswordResetTokenValid($token) {
  if (empty($token)) {
    return false;
  }

  $timestamp = (int) substr($token, strrpos($token, '_') + 1);
  $expire = Yii::$app->params['user.passwordResetTokenExpire'];
  return $timestamp + $expire >= time();
}


/** EXTENSION MOVIE **/
}
