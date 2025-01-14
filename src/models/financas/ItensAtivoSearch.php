<?php

namespace app\models\financas;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\financas\Ativo;

/**
 * AtivoSearch represents the model behind the search form of `app\models\financas\Ativo`.
 */
class ItensAtivoSearch extends ItensAtivo
{
    public $tipo;
    public $categoria;
    public $nome;
    public $codigo;
    public $pais;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'quantidade'], 'integer'],
            [['nome', 'codigo', 'tipo', 'categoria', 'pais', 'investidor_id'], 'safe'],
            [['ativo'], 'boolean'],
            [['valor_compra', 'valor_bruto', 'valor_liquido'], 'number'],
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
        $query = ItensAtivo::find()
            ->joinWith(['ativos', 'investidor']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $dataProvider->sort->attributes['codigo'] = [
            'asc' => ['ativo.codigo' => SORT_ASC],
            'desc' => ['ativo.codigo' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['tipo'] = [
            'asc' => ['ativo.tipo' => SORT_ASC],
            'desc' => ['ativo.tipo' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['categoria'] = [
            'asc' => ['ativo.categoria' => SORT_ASC],
            'desc' => ['ativo.categoria' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'itens_ativo.id' => $this->id,
            'quantidade' => $this->quantidade,
            'valor_compra' => $this->valor_compra,
            'valor_bruto' => $this->valor_bruto,
            'valor_liquido' => $this->valor_liquido,
            'ativo.tipo' => $this->tipo,
            'ativo.categoria' => $this->categoria,
            'ativo.pais' => $this->pais,
            'itens_ativo.ativo' => $this->ativo
        ]);

        $query->andFilterWhere(['ilike', 'ativo.nome', $this->nome])
            ->andFilterWhere(['ilike', 'investidor.nome', $this->investidor_id]);
        $query = FiltrosGrid::pesquisaAtivo($query, $this->codigo);

        return $dataProvider;
    }
}
