<?php

namespace frontend\controllers;

use Yii;
use common\models\Contacts;
use common\models\SearchContacts;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Debts;
use common\models\Demands;
use yii\data\ActiveDataProvider;

/**
 * ContactController implements the CRUD actions for Contacts model.
 */
class ContactController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Contacts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchContacts();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Contacts model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $debtsDataProvider = new ActiveDataProvider([
            'query' => Debts::find()->where(['user_id' => Yii::$app->user->identity->id, 'contact_id' => $id]),
            'pagination' => [
                'pageSize' => 15,
            ],
        ]);
        $demandsDataProvider = new ActiveDataProvider([
            'query' => Demands::find()->where(['user_id' => Yii::$app->user->identity->id, 'contact_id' => $id]),
            'pagination' => [
                'pageSize' => 15,
            ],
        ]);

        $debtModels = Debts::find()->where(['user_id' => Yii::$app->user->identity->id, 'contact_id' => $id])->all();
        $demandModels = Demands::find()->where(['user_id' => Yii::$app->user->identity->id, 'contact_id' => $id])->all();

        $dept = 0;
        $demand = 0;
        foreach($debtModels as $debtModel){
            $dept += $debtModel->debt_amount;
        }
        foreach($demandModels as $demandModel){
            $demand += $demandModel->demand_amount;
        }
        $total = $demand - $dept;

        return $this->render('view', [
            'model' => $this->findModel($id),
            'debtsDataProvider' => $debtsDataProvider,
            'demandsDataProvider' => $demandsDataProvider,
            'total' => $total,
        ]);
    }

    /**
     * Creates a new Contacts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Contacts();
        
        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->identity->id;
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->contact_id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Contacts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->identity->id;
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->contact_id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Contacts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Contacts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Contacts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contacts::find()->where(['contact_id' => $id, 'user_id' => Yii::$app->user->identity->id])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
