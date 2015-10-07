<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Decisionsb13;

/**
 * Decisionsb13Search represents the model behind the search form about `app\models\Decisionsb13`.
 */
class Decisionsb13Search extends Decisionsb13
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['b13_ada', 'budgettype', 'entryNumber', 'currency', 'relatedPartialADA', 'documentType'], 'safe'],
            [['financialYear', 'partialead', 'recalledExpenseDecision', 'amountWithKae_ID'], 'integer'],
            [['amount'], 'number'],
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
        $query = Decisionsb13::find();

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
            'financialYear' => $this->financialYear,
            'partialead' => $this->partialead,
            'recalledExpenseDecision' => $this->recalledExpenseDecision,
            'amount' => $this->amount,
            'amountWithKae_ID' => $this->amountWithKae_ID,
        ]);

        $query->andFilterWhere(['like', 'b13_ada', $this->b13_ada])
            ->andFilterWhere(['like', 'budgettype', $this->budgettype])
            ->andFilterWhere(['like', 'entryNumber', $this->entryNumber])
            ->andFilterWhere(['like', 'currency', $this->currency])
            ->andFilterWhere(['like', 'relatedPartialADA', $this->relatedPartialADA])
            ->andFilterWhere(['like', 'documentType', $this->documentType]);

        return $dataProvider;
    }
}
