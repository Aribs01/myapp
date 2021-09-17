<?php

namespace app\controllers;

use app\models\AnnouncedPuResults;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AnnouncedPuResultsController implements the CRUD actions for AnnouncedPuResults model.
 */
class AnnouncedPuResultsController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all AnnouncedPuResults models.
     * @return mixed
     */
    public function actionIndex($id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => AnnouncedPuResults::find()->andWhere(['polling_unit_uniqueid'=> $id]),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'result_id' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AnnouncedPuResults model.
     * @param int $result_id Result ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($result_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($result_id),
        ]);
    }

    /**
     * Creates a new AnnouncedPuResults model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AnnouncedPuResults();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'result_id' => $model->result_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AnnouncedPuResults model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $result_id Result ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($result_id)
    {
        $model = $this->findModel($result_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'result_id' => $model->result_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AnnouncedPuResults model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $result_id Result ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($result_id)
    {
        $this->findModel($result_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AnnouncedPuResults model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $result_id Result ID
     * @return AnnouncedPuResults the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($result_id)
    {
        if (($model = AnnouncedPuResults::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
