<?php

namespace app\models\financas;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\financas\Proventos;
use app\lib\behavior\DateRangeBehaviorAlterado;
use const SORT_DESC;

/**
 * ProventosSearch represents the model behind the search form of `app\models\financas\Proventos`.
 */
class ProventosSearch extends Proventos
{

    public $ativo_codigo;
    public $pais;
    public $createTimeRange;
    public $createTimeStart;
    public $createTimeEnd;
    public $investidor;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'movimentacao'], 'integer'],
            [['data', 'itens_ativos_id', 'ativo_codigo', 'pais', 'investidor'], 'safe'],
            [['createTimeRange'], 'match', 'pattern' => '/^.+\s\-\s.+$/'],
            [['valor'], 'number'],
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

    public function behaviors()
    {
        return [
            [
                'class' => DateRangeBehaviorAlterado::class,
                'attribute' => 'createTimeRange',
                'dateStartAttribute' => 'createTimeStart',
                'dateEndAttribute' => 'createTimeEnd',
            ]
        ];
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
        $query = Proventos::find()
            ->joinWith(['itensAtivo.investidor', 'itensAtivo.ativos'])
            ->orderBy(['data' => SORT_DESC]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => ['defaultOrder' => ['data' => SORT_DESC]],
        ]);

        $dataProvider->sort->attributes['ativo_codigo'] = [
            'asc' => ['ativo.codigo' => SORT_ASC],
            'desc' => ['ativo.codigo' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['pais'] = [
            'asc' => ['ativo.pais' => SORT_ASC],
            'desc' => ['ativo.pais' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['investidor'] = [
            'asc' => ['investidor.nome' => SORT_ASC],
            'desc' => ['investidor.nome' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'proventos.id' => $this->id,
            'valor' => $this->valor,
            'itens_ativos_id' => $this->itens_ativos_id,
            'pais' => $this->pais,
            'movimentacao' => $this->movimentacao,
        ]);

        if ($this->createTimeRange != null && $this->createTimeRange != '') {
            $query->andFilterWhere(['>=', 'data', $this->createTimeStart])
                ->andFilterWhere(['<=', 'data', $this->createTimeEnd]);
        }

        //$query->andFilterWhere(['ilike', 'ativo.codigo', $this->ativo_codigo]);
        $query->andFilterWhere(['ilike', 'investidor.nome', $this->investidor]);

        $query = FiltrosGrid::pesquisaAtivo($query, $this->ativo_codigo);

        return $dataProvider;
    }
}
