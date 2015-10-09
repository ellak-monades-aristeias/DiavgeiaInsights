<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Organisations;

/**
 * OrganisationsSearch represents the model behind the search form about `app\models\Organisations`.
 */
class OrganisationsSearch extends Organisations
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid'], 'integer'],
            [['label', 'abbreviation', 'latinName', 'category', 'organizationDomains', 'status', 'supervisorId', 'supervisorLabel', 'website', 'odeManagerEmail', 'vatNumber', 'fekNumber', 'fekIssue'], 'safe'],
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
        $query = Organisations::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'uid' => $this->uid,
        ]);

        $query->andFilterWhere(['like', 'label', $this->label])
            ->andFilterWhere(['like', 'abbreviation', $this->abbreviation])
            ->andFilterWhere(['like', 'latinName', $this->latinName])
            ->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'organizationDomains', $this->organizationDomains])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'supervisorId', $this->supervisorId])
            ->andFilterWhere(['like', 'supervisorLabel', $this->supervisorLabel])
            ->andFilterWhere(['like', 'website', $this->website])
            ->andFilterWhere(['like', 'odeManagerEmail', $this->odeManagerEmail])
            ->andFilterWhere(['like', 'vatNumber', $this->vatNumber])
            ->andFilterWhere(['like', 'fekNumber', $this->fekNumber])
            ->andFilterWhere(['like', 'fekIssue', $this->fekIssue]);

        return $dataProvider;
    }
}
