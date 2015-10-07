<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "decisionsb22".
 *
 * @property string $b22_ada
 * @property string $afm
 * @property string $afmType
 * @property string $afmCountry
 * @property integer $enterName
 * @property string $name
 * @property string $noVATOrg
 * @property string $documentType
 *
 * @property Decisions $b22Ada
 */
class Decisionsb22 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'decisionsb22';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['b22_ada'], 'required'],
            [['enterName'], 'integer'],
            [['b22_ada'], 'string', 'max' => 15],
            [['afm', 'afmType', 'afmCountry', 'noVATOrg'], 'string', 'max' => 45],
            [['name'], 'string', 'max' => 100],
            [['documentType'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'b22_ada' => Yii::t('app', 'B22 Ada'),
            'afm' => Yii::t('app', 'Afm'),
            'afmType' => Yii::t('app', 'Afm Type'),
            'afmCountry' => Yii::t('app', 'Afm Country'),
            'enterName' => Yii::t('app', 'Enter Name'),
            'name' => Yii::t('app', 'Name'),
            'noVATOrg' => Yii::t('app', 'No Vatorg'),
            'documentType' => Yii::t('app', 'Document Type'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getB22Ada()
    {
        return $this->hasOne(Decisions::className(), ['ada' => 'b22_ada']);
    }
}
