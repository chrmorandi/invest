<?php

namespace app\lib\behavior;

use Exception;
use app\lib\CajuiHelper;
use app\models\admin\Auditoria;
use Throwable;
use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;

/**
 * Class AuditoriaBehavior
 *
 * @property ActiveRecord $owner
 *
 */
class AuditoriaBehavior extends Behavior
{

    private $action;
    private $changes = [];
    private $erros = [];
    private $transaction;

    /**
     * {@inheritdoc}
     */
    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'afterInsert',
            ActiveRecord::EVENT_BEFORE_INSERT => 'beforeInsert',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'beforeUpdate',
            ActiveRecord::EVENT_BEFORE_DELETE => 'beforeDelete',
        ];
    }


    public function beforeInsert()
    {
        $this->transaction = Yii::$app->db->beginTransaction();
    }

    /**
     * {@inheritdoc}
     */
    public function afterInsert()
    {
        $this->action = 'insert';
        $this->insereAfterAuditoria();
    }

    public function insereAfterAuditoria()
    {
        try {
            if (!$this->saveAuditoria()) {
                $this->transaction->rollBack();
                throw new Exception("Error ao inserir auditoria:</br>" . $this->erros);
            }
            $this->transaction->commit();
        } catch (Throwable $e) {
            $this->transaction->rollBack();
            throw new Exception("Error ao inserir auditoria");
        }
    }

    private function saveAuditoria()
    {
        $this->changes = [];
        foreach ($this->owner->getAttributes() as $name => $value) {
            $this->changes[$name] = $value;
        }
        $user = Yii::$app->user->id ?? Yii::$app->params['userAdminPadraoId'];
        $auditoria = new Auditoria();
        $auditoria->model = get_class($this->owner);
        $auditoria->operacao = $this->action;
        $auditoria->changes = $this->changes;
        $auditoria->user_id = $user;
        $auditoria->created_at = time();
        if (!$auditoria->save()) {
            $this->erros = CajuiHelper::processaErros($auditoria->getErrors());
            return false;
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function beforeUpdate()
    {
        $this->action = 'update';
        $this->insereBeforeAuditoria();
    }

    public function insereBeforeAuditoria()
    {
        if (!$this->saveAuditoria()) {

            throw new Exception("Error ao inserir auditoria:</br>" . $this->erros);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function beforeDelete()
    {
        $this->action = 'delete';
        $this->insereBeforeAuditoria();
    }
}
