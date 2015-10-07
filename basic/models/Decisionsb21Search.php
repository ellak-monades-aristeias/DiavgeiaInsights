<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Decisionsb21;

/**
 * Decisionsb21Search represents the model behind the search form about `app\models\Decisionsb21`.
 */
class Decisionsb21Search extends Decisionsb21
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['b13_ada', 'afm', 'afmType', 'afmCountry', 'decisionsB21col', 'name', 'noVATOrg', 'documentType'], 'safe'],
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
        $query = Decisionsb21::find();

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

        $query->andFilterWhere(['like', 'b13_ada', $this->b13_ada])
            ->andFilterWhere(['like', 'afm', $this->afm])
            ->andFilterWhere(['like', 'afmType', $this->afmType])
            ->andFilterWhere(['like', 'afmCountry', $this->afmCountry])
            ->andFilterWhere(['like', 'decisionsB21col', $this->decisionsB21col])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'noVATOrg', $this->noVATOrg])
            ->andFilterWhere(['like', 'documentType', $this->documentType]);

        return $dataProvider;
    }
}
