<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Pulseiras;

/**
 * PulseirasSearch represents the model behind the search form of `common\models\Pulseiras`.
 */
class PulseirasSearch extends Pulseiras
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'codigorp', 'id_evento', 'id_cliente'], 'integer'],
            [['estado', 'tipo'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Pulseiras::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'codigorp' => $this->codigorp,
            'id_evento' => $this->id_evento,
            'id_cliente' => $this->id_cliente,
        ]);

        $query->andFilterWhere(['like', 'estado', $this->estado])
            ->andFilterWhere(['like', 'tipo', $this->tipo]);

        return $dataProvider;
    }
}
