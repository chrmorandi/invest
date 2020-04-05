<?php

namespace app\controllers;

use app\models\AcaoBolsa;
use app\models\AcaoBolsaOperacao;
use app\models\AcaoBolsaSearch;
use app\models\BalancoEmpresaBolsaSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * AcaoBolsaController implements the CRUD actions for AcaoBolsa model.
 */
class AcaoBolsaController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all AcaoBolsa models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new AcaoBolsaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AcaoBolsa model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AcaoBolsa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new AcaoBolsa();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing AcaoBolsa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * define um rank para cada ação cadastrada
     */
    public function actionRank() {
        //false=> monta apenas anos
        //true=> monta apenas trimestres
        try {
            $transaction = Yii::$app->db->beginTransaction();
            $dadosAnuais = BalancoEmpresaBolsaSearch::dadosBalanco(false);
            $dadosTrimestre = BalancoEmpresaBolsaSearch::dadosBalanco(true);
            List($resp, $msg) = AcaoBolsaOperacao::geraRankMinQuad($dadosAnuais,'rank_ano');
            List($resp, $msg) = AcaoBolsaOperacao::geraRankMinQuad($dadosTrimestre,'rank_trimestre');
            // $rankAno = [];
            if ($resp == true) {
                $transaction->commit();
                Yii::$app->session->setFlash('success', $msg);
                return $this->redirect(['index']);
            } else {
                $transaction->rollBack();
                Yii::$app->session->setFlash('danger', $msg);
                return $this->redirect(['index']);
            }
        } catch (Exception $e) {
            $transaction->rollBack();
            Yii::$app->session->setFlash('danger', 'Exceção capturada: ', $e->getMessage(), "\n");
            return $this->redirect(['index']);
        }

        //foreach ($dados as $dados)
        //print_r($rankAno);
        //exit();
    }

    /**
     * Deletes an existing AcaoBolsa model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AcaoBolsa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AcaoBolsa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = AcaoBolsa::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
