<?php

namespace backend\controllers;

use Yii;
use common\models\BillOfLading;
use common\models\BillOfLadingSearch;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;

/**
 * BillOfLadingController implements the CRUD actions for BillOfLading model.
 */
class BillOfLadingController extends Controller
{


    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all BillOfLading models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BillOfLadingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $model = new BillOfLading();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model
        ]);
    }


    /**
     * Creates a new BillOfLading model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BillOfLading();
        $result = [];
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $result = ['result' => 'ok'];
        } else {
            $result = ['result' => 'fail'];
        }
        echo Json::encode($result);
    }

    /**
     * Updates an existing BillOfLading model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $result = [];
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $result = ['result' => 'ok'];
        } else {
            $result = ['result' => 'fail'];
        }
        echo Json::encode($result);
    }

    public function actionFind($id)
    {
        $model = $this->findModel($id);
        $result= $model->attributes;
        echo Json::encode($result);
    }

    /**
     * Deletes an existing BillOfLading model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete()
    {
        $ids=$_GET['ids'];
        if(!$ids) throw new HttpException(404,'Error');
        BillOfLading::deleteAll(['id'=>$ids]);
        $result = ['result' => 'ok'];
        echo Json::encode($result);
    }

    /**
     * Finds the BillOfLading model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BillOfLading the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BillOfLading::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
