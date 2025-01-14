<?php

namespace app\models\sincronizar;

use Yii;
use app\models\financas\ItensAtivo;
use app\lib\behavior\AuditoriaBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "atualiza_ativo_manual".
 *
 * @property int $id
 * @property int $itens_ativo_id
 *
 * @property ItensAtivo $itensAtivo
 */
class AtualizaAtivoManual extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'atualiza_ativo_manual';
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
            [['itens_ativo_id'], 'required'],
            [['itens_ativo_id'], 'default', 'value' => null],
            [['itens_ativo_id'], 'integer'],
            [['itens_ativo_id'], 'unique'],
            [['itens_ativo_id'], 'exist', 'skipOnError' => true, 'targetClass' => ItensAtivo::class, 'targetAttribute' => ['itens_ativo_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'itens_ativo_id' => 'Itens Ativo',
        ];
    }

    /**
     * Gets query for [[ItensAtivo]].
     *
     * @return ActiveQuery
     */
    public function getItensAtivo()
    {
        return $this->hasOne(ItensAtivo::class, ['id' => 'itens_ativo_id']);
    }
}
