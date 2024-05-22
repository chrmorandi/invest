<?php

namespace app\models\financas;

use app\lib\behavior\AuditoriaBehavior;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "investidor".
 *
 * @property int $id
 * @property string $cpf
 * @property string $nome
 *
 * @property Ativo[] $ativos
 */
class Investidor extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'investidor';
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
            [['cpf', 'nome'], 'required'],
            [['nome'], 'string'],
            [['cpf'], 'string'],
            [['cpf'], 'unique'],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cpf' => 'CPF',
            'nome' => 'Nome',
        ];
    }

    /**
     * Gets query for [[Ativos]].
     *
     * @return ActiveQuery
     */
    public function getAtivos()
    {
        return $this->hasMany(Ativo::class, ['investidor_id' => 'id']);
    }
}
