<?php

namespace backend\controllers;

use DateTime;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\Noticias;
use common\models\NoticiasSearch;
use common\models\EventosUpdate;

/**
 * NoticiasController implements the CRUD actions for Noticias model.
 */
class NoticiasController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        $model = new Eventosupdate();
        $model->UpdateEstadoEvento();
        
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'actions' => ['index', 'view', 'create', 'update', 'delete'],
                            'allow' => true,
                            'roles' => ['gestor','admin'],
                        ],
                    ],
                    'denyCallback' => function ($rule, $action) {
                        Yii::$app->user->logout();
                        return $this->redirect(['site/login']);
                    }
                ],
            ]
        );
    }

    /**
     * Lists all Noticias models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (\Yii::$app->user->can('viewNoticia')) {
            $searchModel = new NoticiasSearch();
            $dataProvider = $searchModel->search($this->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);

        }else{
            Yii::$app->user->logout();
            return $this->redirect(['site/login']);
        }
        
    }

    public function actionView($id)
    {
        if (\Yii::$app->user->can('viewNoticia')) {

            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);

        }else{
            Yii::$app->user->logout();
            return $this->redirect(['site/login']);
        }    
    }

    public function actionCreate()
    {
        if (\Yii::$app->user->can('viewNoticia')) {
            
            $model = new Noticias();

            if ($this->request->isPost && $model->load($this->request->post())) {
                
                $datetime = new Datetime();
                $datetime = $datetime->format('Y-m-d H:i:s');
                $model->datanoticia = $datetime;
            
                $model->id_criador = Yii::$app->user->getId();

                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {
                $model->loadDefaultValues();
            }

            return $this->render('create', [
                'model' => $model,
            ]);

        }else{
            Yii::$app->user->logout();
            return $this->redirect(['site/login']);
        }
    }

    public function actionUpdate($id)
    {
        if (\Yii::$app->user->can('viewNoticia')) {

            $model = $this->findModel($id);

            if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('update', [
                'model' => $model,
            ]);

        }else{
            Yii::$app->user->logout();
            return $this->redirect(['site/login']);
        }
    }

    public function actionDelete($id)
    {
        if (\Yii::$app->user->can('viewNoticia')) {

            $this->findModel($id)->delete();
            return $this->redirect(['index']);

        }else{
            Yii::$app->user->logout();
            return $this->redirect(['site/login']);
        }
    }

    protected function findModel($id)
    {
        if (($model = Noticias::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
