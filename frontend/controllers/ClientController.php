<?php

namespace frontend\controllers;

use yii\web\Response;
use yii\helpers\VarDumper;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use yii\web\BadRequestHttpException;

class ClientController extends ActiveController {

  public $reservedParams = ['sort','q'];
  public $modelClass = 'frontend\models\Client';

  public function behaviors() {
    return ArrayHelper::merge(parent::behaviors(), [
      [
          'class' => 'yii\filters\ContentNegotiator',
          'only' => ['view', 'index', 'search'],  // in a controller
          // if in a module, use the following IDs for user actions
          // 'only' => ['user/view', 'user/index']
          'formats' => [
              'application/json' => Response::FORMAT_JSON,
          ],
          'languages' => [ 'en', 'de', ],
      ],
    ]);
  }

  public function actionSearch() {
    $params = \Yii::$app->request->queryParams;

    $model = new $this->modelClass;
    // I'm using yii\base\Model::getAttributes() here
    // In a real app I'd rather properly assign
    // $model->scenario then use $model->safeAttributes() instead
    $modelAttr = $model->attributes;


    // this will hold filtering attrs pairs ( 'name' => 'value' )
    $search = [];

    if (!empty($params)) {
      foreach ($params as $key => $value) {
        // In case if you don't want to allow wired requests
        // holding 'objects', 'arrays' or 'resources'
        if(!is_scalar($key) or !is_scalar($value)) {
          throw new BadRequestHttpException('Bad Request');
        }
        // if the attr name is not a reserved Keyword like 'q' or 'sort' and
        // is matching one of models attributes then we need it to filter results
        if (!in_array(strtolower($key), $this->reservedParams)
        && ArrayHelper::keyExists($key, $modelAttr, false)) {
          $search[urldecode($key)] = $value;
        }
      }
    }

    // search by pk only.
    // 'pk' is alias for 'ID_Passport No_' ...damn spaces in db table column name
    if(isset($params['pk'])) {
      $query = [ 'ID_Passport No_' => $params['pk'] ];
      $provider = new ActiveDataProvider([
        'query' => $model->find()->where($query),
        'pagination' => [
          'pageSize' => 20,
        ],
      ]);
      return $provider;
    }

    return null;

  }

}
