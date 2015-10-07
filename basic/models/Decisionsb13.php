<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "decisionsb13".
 *
 * @property string $b13_ada
 * @property integer $financialYear
 * @property string $budgettype
 * @property string $entryNumber
 * @property integer $partialead
 * @property integer $recalledExpenseDecision
 * @property double $amount
 * @property string $currency
 * @property string $relatedPartialADA
 * @property string $documentType
 * @property integer $amountWithKae_ID
 *
 * @property Decisions $b13Ada
 * @property Amountwithkae $amountWithKae
 */
class Decisionsb13 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'decisionsb13';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['b13_ada', 'financialYear', 'budgettype', 'partialead', 'amountWithKae_ID'], 'required'],
            [['financialYear', 'partialead', 'recalledExpenseDecision', 'amountWithKae_ID'], 'integer'],
            [['amount'], 'number'],
            [['b13_ada'], 'string', 'max' => 15],
            [['budgettype', 'currency'], 'string', 'max' => 45],
            [['entryNumber', 'relatedPartialADA', 'documentType'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'b13_ada' => Yii::t('app', 'B13 Ada'),
            'financialYear' => Yii::t('app', 'Financial Year'),
            'budgettype' => Yii::t('app', 'Budgettype'),
            'entryNumber' => Yii::t('app', 'Entry Number'),
            'partialead' => Yii::t('app', 'Partialead'),
            'recalledExpenseDecision' => Yii::t('app', 'Recalled Expense Decision'),
            'amount' => Yii::t('app', 'Amount'),
            'currency' => Yii::t('app', 'Currency'),
            'relatedPartialADA' => Yii::t('app', 'Related Partial Ada'),
            'documentType' => Yii::t('app', 'Document Type'),
            'amountWithKae_ID' => Yii::t('app', 'Amount With Kae  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getB13Ada()
    {
        return $this->hasOne(Decisions::className(), ['ada' => 'b13_ada']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAmountWithKae()
    {
        return $this->hasOne(Amountwithkae::className(), ['awk_ID' => 'amountWithKae_ID']);
    }
}
