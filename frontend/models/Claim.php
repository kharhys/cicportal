<?php

namespace frontend\models;

use yii\db\ActiveRecord;

class Claim extends ActiveRecord {

    /**
     * @return string the name of the table associated with this ActiveRecord class.
     */
    public static function tableName()    {
        return 'TRANSCOOP$Claim';
    }
}
