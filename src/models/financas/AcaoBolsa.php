<?php

namespace app\models\financas;

use app\lib\behavior\AuditoriaBehavior;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "acao_bolsa".
 *
 * @property int $id
 * @property string $nome
 * @property string $codigo
 * @property string $setor
 */
class AcaoBolsa extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'acao_bolsa';
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
            [['nome', 'codigo', 'setor', 'cnpj'], 'required'],
            [['nome', 'setor', 'cnpj'], 'string'],
            [['codigo'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cnpj' => 'Registro Empresa (CPNJ,IRS)',
            'id' => 'ID',
            'nome' => 'Nome',
            'codigo' => 'Código',
            'setor' => 'Setor',
            'rank_ano' => 'Rank Ano',
            'rank_trimestre' => 'Rank trimestre'
        ];
    }
}
