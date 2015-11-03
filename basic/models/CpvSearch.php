<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cpv;

/**
 * CpvSearch represents the model behind the search form about `app\models\Cpv`.
 */
class CpvSearch extends Cpv
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'cpv_label'], 'safe'],
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
        $query = Cpv::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'uid', $this->uid])
            ->andFilterWhere(['like', 'cpv_label', $this->cpv_label]);

        return $dataProvider;
    }
}
