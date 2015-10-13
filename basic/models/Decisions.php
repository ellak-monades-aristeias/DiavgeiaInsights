<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "decisions".
 *
 * @property string $ada
 * @property string $protocolNumber
 * @property string $subject
 * @property string $issueDate
 * @property string $decisionTypeId
 * @property string $organizationId
 * @property string $privateData
 * @property string $submissionTimestamp
 * @property string $status
 * @property string $versionId
 * @property string $documentChecksum
 * @property string $correctedVersionId
 *
 * @property Amountwithkae[] $amountwithkaes
 * @property Cpvperdecisions[] $cpvperdecisions
 * @property Decisionsb13 $decisionsb13
 * @property Decisionsb21 $decisionsb21
 * @property Decisionsb22 $decisionsb22
 * @property Decisionsd1 $decisionsd1
 * @property Decisionsd21 $decisionsd21
 * @property Decisionsd22 $decisionsd22
 * @property Signersperdecisions[] $signersperdecisions
 * @property Sponsor $sponsor
 * @property Unitsperdecisions[] $unitsperdecisions
 */
class Decisions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'decisions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ada'], 'required'],
            [['ada'], 'string', 'max' => 15],
            [['protocolNumber', 'subject', 'issueDate', 'decisionTypeId', 'organizationId', 'submissionTimestamp', 'status', 'versionId', 'documentChecksum', 'correctedVersionId'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ada' => Yii::t('app', 'Ada'),
            'protocolNumber' => Yii::t('app', 'Protocol Number'),
            'subject' => Yii::t('app', 'Subject'),
            'issueDate' => Yii::t('app', 'Issue Date'),
            'decisionTypeId' => Yii::t('app', 'Decision Type ID'),
            'organizationId' => Yii::t('app', 'Organization ID'),
            'submissionTimestamp' => Yii::t('app', 'Submission Timestamp'),
            'status' => Yii::t('app', 'Status'),
            'versionId' => Yii::t('app', 'Version ID'),
            'documentChecksum' => Yii::t('app', 'Document Checksum'),
            'correctedVersionId' => Yii::t('app', 'Corrected Version ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAmountwithkaes()
    {
        return $this->hasMany(Amountwithkae::className(), ['awk_ada' => 'ada']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCpvperdecisions()
    {
        return $this->hasMany(Cpvperdecisions::className(), ['cpd_ada' => 'ada']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDecisionsb13()
    {
        return $this->hasOne(Decisionsb13::className(), ['b13_ada' => 'ada']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDecisionsb21()
    {
        return $this->hasOne(Decisionsb21::className(), ['b13_ada' => 'ada']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDecisionsb22()
    {
        return $this->hasOne(Decisionsb22::className(), ['b22_ada' => 'ada']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDecisionsd1()
    {
        return $this->hasOne(Decisionsd1::className(), ['d1_ada' => 'ada']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDecisionsd21()
    {
        return $this->hasOne(Decisionsd21::className(), ['d21_ada' => 'ada']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDecisionsd22()
    {
        return $this->hasOne(Decisionsd22::className(), ['d22_ada' => 'ada']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSignersperdecisions()
    {
        return $this->hasMany(Signersperdecisions::className(), ['spd_ada' => 'ada']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSponsor()
    {
        return $this->hasOne(Sponsor::className(), ['sp_ada' => 'ada']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnitsperdecisions()
    {
        return $this->hasMany(Unitsperdecisions::className(), ['upd_ada' => 'ada']);
    }
}
