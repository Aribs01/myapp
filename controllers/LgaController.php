<?php

namespace app\controllers;

use app\models\Lga;
use app\models\PollingUnit;
use app\models\AnnouncedPuResults;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LgaController implements the CRUD actions for Lga model.
 */
class LgaController extends Controller
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
     * Lists all Lga models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Lga::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'uniqueid' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Lga model.
     * @param int $uniqueid Uniqueid
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $polling_units = PollingUnit::find()->andWhere(['lga_id' => $id])->all();
        $totalPollingUnitResults = array('PDP' => 0, 'DPP' => 0, 'ACN' => 0, 'PPA' => 0, 'CDC' => 0,
                'JP' => 0, 'ANPP' => 0, 'LABO' => 0, 'CPP' => 0);
        foreach($polling_units as $polling_unit) {
            $results = AnnouncedPuResults::find()->andWhere(['polling_unit_uniqueid'=> $polling_unit->uniqueid])->all();
            foreach ($results as $result) {
                if ($totalPollingUnitResults[''.$result->party_abbreviation] == null) {
                    $totalPollingUnitResults[''.$result->party_abbreviation] = $result->party_score;
                }
                else {
                    $totalPollingUnitResults[''.$result->party_abbreviation] = $totalPollingUnitResults[''.$result->party_abbreviation] + $result->party_score;
                }
            }
        }

        return $this->render('view', [
            // 'model' => $this->findModel($id),
            'model' => $totalPollingUnitResults,
        ]);
    }

    /**
     * Creates a new Lga model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Lga();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'uniqueid' => $model->uniqueid]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Lga model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $uniqueid Uniqueid
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($uniqueid)
    {
        $model = $this->findModel($uniqueid);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'uniqueid' => $model->uniqueid]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Lga model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $uniqueid Uniqueid
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($uniqueid)
    {
        $this->findModel($uniqueid)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Lga model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $uniqueid Uniqueid
     * @return Lga the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Lga::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
