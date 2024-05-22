<?php

namespace app\models\financas;

use Yii;
use app\models\financas\ItensAtivo;
use app\lib\behavior\AuditoriaBehavior;
use app\models\financas\OperacoesImport;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * grava os valores antigos (bruto e liquido) dos
 * ativos de renda fixa da NuInvest. Porque quando
 * a importação for removida atribui os valores atingos
 * dos itens ativos
 *
 * @property float $valor_antigo
 * @property int $operacoes_import_id
 *
 */
class AtualizaNu extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'atualiza_nu';
    }

    public function behaviors()
    {
        return [
            AuditoriaBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['valor_bruto_antigo', 'valor_liquido_antigo', 'operacoes_import_id', 'itens_ativo_id'], 'required'],
            [['valor_bruto_antigo', 'valor_liquido_antigo'], 'number'],
            [['operacoes_import_id', 'itens_ativo_id'], 'default', 'value' => null],
            [['operacoes_import_id', 'itens_ativo_id'], 'integer'],
            [['operacoes_import_id'], 'exist', 'skipOnError' => true, 'targetClass' => OperacoesImport::class, 'targetAttribute' => ['operacoes_import_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'valor_bruto_antigo' => 'Valor bruto Antigo',
            'valor_liquido_antigo' => 'Valor liquido Antigo',
            'operacoes_import_id' => 'Operacao Import ID',
            'itens_ativo_id' => 'Itens Ativo Id'
        ];
    }

    /**
     * Gets query for [[ItensAtivoImport]].
     *
     * @return ActiveQuery
     */
    public function getOperacoesImport()
    {
        return $this->hasOne(OperacoesImport::class, ['id' => 'operacoes_import_id']);
    }

    public function getItensAtivo()
    {
        return $this->hasOne(ItensAtivo::class, ['id' => 'itens_ativo_id']);
    }
}
