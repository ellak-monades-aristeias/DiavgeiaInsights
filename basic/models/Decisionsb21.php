<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "decisionsb21".
 *
 * @property string $b13_ada
 * @property string $afm
 * @property string $afmType
 * @property string $afmCountry
 * @property integer $enterName
 * @property string $decisionsB21col
 * @property string $name
 * @property string $noVATOrg
 * @property string $documentType
 *
 * @property Decisions $b13Ada
 */
class Decisionsb21 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'decisionsb21';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['b13_ada'], 'required'],
            [['enterName'], 'integer'],
            [['b13_ada'], 'string', 'max' => 15],
            [['afm', 'afmType', 'afmCountry', 'decisionsB21col', 'noVATOrg'], 'string', 'max' => 45],
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
            'b13_ada' => Yii::t('app', 'B13 Ada'),
            'afm' => Yii::t('app', 'Afm'),
            'afmType' => Yii::t('app', 'Afm Type'),
            'afmCountry' => Yii::t('app', 'Afm Country'),
            'enterName' => Yii::t('app', 'Enter Name'),
            'decisionsB21col' => Yii::t('app', 'Decisions B21col'),
            'name' => Yii::t('app', 'Name'),
            'noVATOrg' => Yii::t('app', 'No Vatorg'),
            'documentType' => Yii::t('app', 'Document Type'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getB13Ada()
    {
        return $this->hasOne(Decisions::className(), ['ada' => 'b13_ada']);
    }
}
