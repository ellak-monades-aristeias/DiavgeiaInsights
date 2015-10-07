<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Decisionsb22;

/**
 * Decisionsb22Search represents the model behind the search form about `app\models\Decisionsb22`.
 */
class Decisionsb22Search extends Decisionsb22
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['b22_ada', 'afm', 'afmType', 'afmCountry', 'name', 'noVATOrg', 'documentType'], 'safe'],
            [['enterName'], 'integer'],
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
        $query = Decisionsb22::find();

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
            'enterName' => $this->enterName,
        ]);

        $query->andFilterWhere(['like', 'b22_ada', $this->b22_ada])
            ->andFilterWhere(['like', 'afm', $this->afm])
            ->andFilterWhere(['like', 'afmType', $this->afmType])
            ->andFilterWhere(['like', 'afmCountry', $this->afmCountry])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'noVATOrg', $this->noVATOrg])
            ->andFilterWhere(['like', 'documentType', $this->documentType]);

        return $dataProvider;
    }
}
