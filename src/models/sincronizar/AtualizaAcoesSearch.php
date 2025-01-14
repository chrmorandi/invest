<?php

namespace app\models\sincronizar;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\sincronizar\AtualizaAcoes;
use const SORT_DESC;

/**
 * AtualizaAcoesSearch represents the model behind the search form of `app\models\sincronizar\AtualizaAcoes`.
 */
class AtualizaAcoesSearch extends AtualizaAcoes
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['data', 'ativo_atualizado', 'status'], 'safe'],
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
        $query = AtualizaAcoes::find()
            ->orderBy(['data' => SORT_DESC]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
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
            'data' => $this->data,
        ]);

        $query->andFilterWhere(['ilike', 'ativo_atualizado', $this->ativo_atualizado])
            ->andFilterWhere(['ilike', 'status', $this->status]);

        return $dataProvider;
    }
}
