<?php

namespace app\migrations;

use app\lib\Categoria;
use yii\db\Migration;

/**
 * Class m190609_143226_inicio
 */
class m200307_173226_remove_table_categoria extends Migration
{

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        //remove categória
        $this->execute("DROP table categoria;");

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        return true;
    }

}
