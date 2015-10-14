<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Decisions;

/**
 * DecisionsSearch represents the model behind the search form about `app\models\Decisions`.
 */
class DecisionsSearch extends Decisions
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ada', 'protocolNumber', 'subject', 'issueDate', 'decisionTypeId', 'organizationId', 'submissionTimestamp', 'status', 'versionId', 'documentChecksum', 'correctedVersionId'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Decisions::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'ada', $this->ada])
            ->andFilterWhere(['like', 'protocolNumber', $this->protocolNumber])
            ->andFilterWhere(['like', 'subject', $this->subject])
            ->andFilterWhere(['like', 'issueDate', $this->issueDate])
            ->andFilterWhere(['like', 'decisionTypeId', $this->decisionTypeId])
            ->andFilterWhere(['like', 'organizationId', $this->organizationId])
            ->andFilterWhere(['like', 'submissionTimestamp', $this->submissionTimestamp])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'versionId', $this->versionId])
            ->andFilterWhere(['like', 'documentChecksum', $this->documentChecksum])
            ->andFilterWhere(['like', 'correctedVersionId', $this->correctedVersionId]);

        return $dataProvider;
    }
}
