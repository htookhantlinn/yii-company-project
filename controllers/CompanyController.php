<?php

namespace app\controllers;

use app\models\UserActivity;
use Yii;
use app\models\Company;
use app\models\CompanySearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\User;

/**
 * CompanyController implements the CRUD actions for Company model.
 */
class CompanyController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['create', 'update', 'delete', 'view', 'index'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ]
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
     * Lists all Company models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompanySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);



        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Company model.
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
     * Creates a new Company model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Company();
        $userActivity = new UserActivity();

        if ($model->load(Yii::$app->request->post())) {
            $model->name = $_POST['Company']['name'];
            $model->description = $_POST['Company']['description'];
            $model->website = $_POST['Company']['website'];
            $model->address = $_POST['Company']['address'];
            $model->ph_no = $_POST['Company']['ph_no'];
            $model->user = Yii::$app->user->id;
            $model->category = $_POST['Company']['id'];
            if ($model->save()) {
                $userActivity->user = $model->user;
                $userActivity->company = $model->id;
                $userActivity->modified = null;
                $userActivity->created = date("Y-m-d h:i:s");

                $userActivity->action = "user (" . User::find()
                        ->select('name')
                        ->where(['id' => Yii::$app->user->id])
                        ->one()->name . ')is created ' . $model->name . 'company.';
                $userActivity->save(false);
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Company model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->db->createCommand()
                ->insert('user_activity', ['user' => Yii::$app->user->id, 'company' => $model->id,
                    'modified' => date("Y-m-d h:i:s"),
                    'created' => date("Y-m-d h:i:s"), 'action' => 'User (' . User::find()
                            ->select('name')
                            ->where(['id' => Yii::$app->user->id])
                            ->one()->name . ') is updated (' . $model->name. ' )company'])
                ->execute();
            return $this->redirect(['view', 'id' => $model->id]);
        }
        if ($model->user0->id === Yii::$app->user->id) {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
        return $this->redirect('/site/login');
    }

    /**
     * Deletes an existing Company model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->user0->id === Yii::$app->user->id) {
            $this->findModel($id)->delete();
            Yii::$app->db->createCommand()
                ->insert('user_activity', ['user' => Yii::$app->user->id, 'company' => $model->id,
                    'modified' => date("Y-m-d h:i:s"),
                    'created' => date("Y-m-d h:i:s"), 'action' => 'User (' . User::find()
                            ->select('name')
                            ->where(['id' => Yii::$app->user->id])
                            ->one()->name . ') is deleted (' . $model->name. ' )company'])
                ->execute();
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Company model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Company the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Company::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
