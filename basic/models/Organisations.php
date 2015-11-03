<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "organisations".
 *
 * @property integer $uid
 * @property string $label
 * @property string $abbreviation
 * @property string $latinName
 * @property string $category
 * @property string $organizationDomains
 * @property string $status
 * @property string $supervisorId
 * @property string $supervisorLabel
 * @property string $website
 * @property string $odeManagerEmail
 * @property string $vatNumber
 * @property string $fekNumber
 * @property string $fekIssue
 */
class Organisations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'organisations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid'], 'required'],
            [['uid'], 'integer'],
            [['label'], 'string', 'max' => 100],
            [['abbreviation'], 'string', 'max' => 75],
            [['latinName', 'category', 'organizationDomains', 'status', 'supervisorId', 'supervisorLabel', 'odeManagerEmail', 'vatNumber', 'fekNumber', 'fekIssue'], 'string', 'max' => 45],
            [['website'], 'string', 'max' => 65]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid' => Yii::t('app', 'Uid'),
            'label' => Yii::t('app', 'Label'),
            'abbreviation' => Yii::t('app', 'Abbreviation'),
            'latinName' => Yii::t('app', 'Latin Name'),
            'category' => Yii::t('app', 'Category'),
            'organizationDomains' => Yii::t('app', 'Organization Domains'),
            'status' => Yii::t('app', 'Status'),
            'supervisorId' => Yii::t('app', 'Supervisor ID'),
            'supervisorLabel' => Yii::t('app', 'Supervisor Label'),
            'website' => Yii::t('app', 'Website'),
            'odeManagerEmail' => Yii::t('app', 'Ode Manager Email'),
            'vatNumber' => Yii::t('app', 'Vat Number'),
            'fekNumber' => Yii::t('app', 'Fek Number'),
            'fekIssue' => Yii::t('app', 'Fek Issue'),
        ];
    }
    
    public function getOrganisations() {
        return Organisations::findBySql("SELECT uid, label FROM organisations");
    }
    
    public static function dropdown() {
            $models = static::find()->all();
            foreach ($models as $model) {
                    $dropdown[$model->uid] = $model->label;
            }
            return $dropdown;
    }
    
    public static function dropdownSearch() {
            $models = static::findBySql("SELECT org.uid as uid, org.label as label FROM preferences as pr, organisations as org
WHERE pr.pref_name LIKE 'organisationID' AND pr.pref_value=org.uid")->all();
            foreach ($models as $model) {
                    $dropdown[$model->uid] = $model->label;
            }
            return $dropdown;
    }
}
