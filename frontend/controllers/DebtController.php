<?php

namespace frontend\controllers;

use Yii;
use common\models\Debts;
use common\models\SearchDebts;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Expenses;

/**
 * DebtController implements the CRUD actions for Debts model.
 */
class DebtController extends Controller
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
     * Lists all Debts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchDebts();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $debtModels = Debts::find()->select(['debt_amount'])->where(['user_id' => Yii::$app->user->identity->id])->all();
        $debt = 0;
        foreach($debtModels as $debtModel){
            $debt += $debtModel->debt_amount;
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'total' => $debt,
        ]);
    }

    /**
     * Displays a single Debts model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Debts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Debts();

        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->identity->id;
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->debt_id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Debts model.
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
                return $this->redirect(['view', 'id' => $model->debt_id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    /**
     * Deletes an existing Debts model.
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

    public function actionDeletePlus($id)
    {
        $expenseModel = new Expenses();
        $debtModel = $this->findModel($id);
        $expenseModel->expense_amount = $debtModel->debt_amount;
        $expenseModel->expense_date = Yii::$app->jdate->date('Y-m-d');
        $expenseModel->user_id = Yii::$app->user->identity->id;
        $expenseModel->expense_description = "Paid : " . $debtModel->debt_description;
        $expenseModel->expense_tag_id = $debtModel->debt_tag_id;

        if($expenseModel->save()){
            $debtModel->delete();
        }
        return $this->redirect(['index']);
        
    }

    /**
     * Finds the Debts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Debts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Debts::find()->where(['debt_id' => $id, 'user_id' => Yii::$app->user->identity->id])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
