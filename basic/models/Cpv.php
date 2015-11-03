<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cpv".
 *
 * @property string $uid
 * @property string $cpv_label
 */
class Cpv extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cpv';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid'], 'required'],
            [['uid'], 'string', 'max' => 20],
            [['cpv_label'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid' => Yii::t('app', 'Uid'),
            'cpv_label' => Yii::t('app', 'Cpv Label'),
        ];
    }

    /**
     * @inheritdoc
     * @return CpvQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CpvQuery(get_called_class());
    }
    
    public static function dropdownSearch() {
            $models = static::findBySql("SELECT uid, cpv_label FROM cpv")->all();
            foreach ($models as $model) {
                    $dropdown[$model->uid] = $model->cpv_label;
            }
            return $dropdown;
    }    
}
