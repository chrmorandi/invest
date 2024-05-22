<?php

namespace app\models\sincronizar;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use app\lib\behavior\AuditoriaBehavior;


/**
 * This is the model class for table "atualiza_operacoes_manual".
 *
 * @property int $id
 * @property float $valor_bruto
 * @property float $valor_liquido
 * @property int $atualiza_ativo_manual_id
 * @property string $data
 *
 * @property AtualizaOperacoesManual $atualizaAtivoManual
 * @property AtualizaOperacoesManual[] $atualizaOperacoesManuals
 */
class AtualizaOperacoesManual extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'atualiza_operacoes_manual';
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
            [['valor_bruto', 'valor_liquido', 'atualiza_ativo_manual_id', 'data'], 'required'],
            [['valor_bruto', 'valor_liquido'], 'number'],
            [['atualiza_ativo_manual_id'], 'default', 'value' => null],
            [['atualiza_ativo_manual_id'], 'integer'],
            [['data'], 'safe'],
            [['atualiza_ativo_manual_id'], 'exist', 'skipOnError' => true, 'targetClass' => AtualizaAtivoManual::class, 'targetAttribute' => ['atualiza_ativo_manual_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'valor_bruto' => 'Valor Bruto',
            'valor_liquido' => 'Valor Liquido ',
            'atualiza_ativo_manual_id' => 'Item Ativo',
            'data' => 'Data',
        ];
    }

    /**
     * Gets query for [[AtualizaAtivoManual]].
     *
     * @return ActiveQuery
     */
    public function getAtualizaAtivoManual()
    {
        return $this->hasOne(AtualizaAtivoManual::class, ['id' => 'atualiza_ativo_manual_id']);
    }
}
