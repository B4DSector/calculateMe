<?php

namespace frontend\controllers;

use Yii;
use common\models\Expenses;
use common\models\SearchExpenses;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * ExpenseController implements the CRUD actions for Expenses model.
 */
class ExpenseController extends Controller
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
     * Lists all Expenses models.
     * @return mixed
     */
    public function actionIndex()
    {

        $models = Expenses::find()->where(['user_id' => Yii::$app->user->identity->id])->orderBy(['expense_date' => SORT_DESC])->all();
        $date1 = new \DateTime(Yii::$app->jdate->date('Y-m-d'));
        $total = 0;
        foreach($models as $model){
            $date2 = new \DateTime($model->expense_date);
            if($date1->diff($date2)->format("%a") <= 31){
                $total += $model->expense_amount;
            }
            
            
            // echo (string)$date1->diff($date2);
            
        }
        $searchModel = new SearchExpenses();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'amount' => $total,
        ]);
    }

    /**
     * Displays a single Expenses model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)


    {
        $model = $this->findModel($id);

        
        $date2 = Yii::$app->formatter->asTimestamp($model->expense_date);
        $date1 = Yii::$app->formatter->asTimestamp(Yii::$app->jdate->date('Y-m-d'));
        $diff = abs($date1 - $date2);
        $model->expense_date = $diff / (60*60*24);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Expenses model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Expenses();
        
        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->identity->id;
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->expense_id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Expenses model.
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
                return $this->redirect(['view', 'id' => $model->expense_id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Expenses model.
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
     * Finds the Expenses model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Expenses the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Expenses::find()->where(['expense_id' => $id, 'user_id' => Yii::$app->user->identity->id])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
