<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Preferences;

/**
 * PreferencesSearch represents the model behind the search form about `app\models\Preferences`.
 */
class PreferencesSearch extends Preferences
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pref_ID'], 'integer'],
            [['pref_name', 'pref_value'], 'safe'],
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
        $query = Preferences::find();

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
            'pref_ID' => $this->pref_ID,
        ]);

        $query->andFilterWhere(['like', 'pref_name', $this->pref_name])
            ->andFilterWhere(['like', 'pref_value', $this->pref_value]);

        return $dataProvider;
    }
}
