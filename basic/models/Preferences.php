<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "preferences".
 *
 * @property integer $pref_ID
 * @property string $pref_name
 * @property string $pref_value
 */
class Preferences extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'preferences';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pref_name', 'pref_value'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pref_ID' => Yii::t('app', 'Pref  ID'),
            'pref_name' => Yii::t('app', 'Pref Name'),
            'pref_value' => Yii::t('app', 'Pref Value'),
        ];
    }
    
   
    
        public static function getSelectedOrgIds() {
            $models = static::findBySql(" SELECT pref_value FROM preferences WHERE pref_name LIKE 'organisationID'")->all();
            $dropdown = array();
            foreach ($models as $model) {
                array_push($dropdown, $model['pref_value']);
            }
            return $dropdown;
    }
    
        public static function getSelectedTypes() {
            $models = static::findBySql(" SELECT pref_value, pref_value FROM preferences WHERE pref_name LIKE 'selectedTypes'")->all();
            $dropdown = array();
            foreach ($models as $model) {
                array_push($dropdown, $model['pref_value']);
            }
            return $dropdown;
    }
    
    
        public static function getSelectedDates() {
            $models1 = static::findBySql(" SELECT pref_value, pref_value FROM preferences WHERE pref_name LIKE 'start_date'")->all();
            $dropdown = array();
            foreach ($models1 as $model) {
                array_push($dropdown, $model['pref_value']);

            }
            $models2 = static::findBySql(" SELECT pref_value, pref_value FROM preferences WHERE pref_name LIKE 'end_date'")->all();
            foreach ($models2 as $model) {
                array_push($dropdown, $model['pref_value']);
            }
            
            return $dropdown;
    }
    
        public static function getRefreshDate() {
            $models = static::findBySql(" SELECT pref_value, pref_value FROM preferences WHERE pref_name LIKE 'lastrefreshdate'")->all();
            $dropdown = array();
            foreach ($models as $model) {
                array_push($dropdown, $model['pref_value']);
            }
            return $dropdown;
    }
}
