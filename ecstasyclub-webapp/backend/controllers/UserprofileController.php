<?php

namespace backend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use common\models\AuthAssignment;
use common\models\EventosUpdate;
use common\models\User;
use common\models\Userprofile;
use common\models\Disco;
use common\models\DiscoSearch;
use common\models\UserprofileSearch;
use backend\models\SignupEmpregados;


/**
 * UserprofileController implements the CRUD actions for Userprofile model.
 */
class UserprofileController extends Controller
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
                ],
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'actions' => ['index', 'view', 'create', 'update', 'update_password'],
                            'allow' => true,
                            'roles' => ['gestor','admin'],
                        ],
                        [
                            'actions' => ['indexclientes'],
                            'allow' => true,
                            'roles' => ['admin'],
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
     * Lists all Userprofile models.
     *
     * @return string
    */
    public function actionIndex()
    {
        if(array_keys(Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId()))[0] == 'admin') {
            $model = Userprofile::find()
            ->select('*')
            ->leftJoin('user', 'user.id = userprofile.user_id')
            ->leftJoin('auth_assignment', 'auth_assignment.user_id = user.id')
            ->orwhere(['auth_assignment.item_name' => 'admin'])
            ->orwhere(['auth_assignment.item_name' => 'gestor'])
            ->orwhere(['auth_assignment.item_name' => 'rp'])
            ->orwhere(['auth_assignment.item_name' => 'seguranca'])
            ->orderBy(['nome' => SORT_ASC,'apelido'=> SORT_ASC]);

        }
        if(array_keys(Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId()))[0] == 'gestor') {
            $model = Userprofile::find()
            ->select('*')
            ->leftJoin('user', 'user.id = userprofile.user_id')
            ->leftJoin('auth_assignment', 'auth_assignment.user_id = user.id')
            ->where(['auth_assignment.item_name' => 'rp'])
            ->orderBy(['nome' => SORT_ASC,'apelido'=> SORT_ASC]);
        }

        $searchModel = new ActiveDataProvider([
            'query' => $model,
            'pagination' => [
                'pageSize' => 25,
            ],
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
        ]);
    }

    public function actionIndexclientes()
    {
        if(array_keys(Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId()))[0] == 'admin') {
            $model = Userprofile::find()
            ->select('*')
            ->leftJoin('user', 'user.id = userprofile.user_id')
            ->leftJoin('auth_assignment', 'auth_assignment.user_id = user.id')
            ->orwhere(['auth_assignment.item_name' => 'cliente'])
            ->orderBy(['nome' => SORT_ASC,'apelido'=> SORT_ASC]);
        }

        $searchModel = new ActiveDataProvider([
            'query' => $model,
            'pagination' => [
                'pageSize' => 25,
            ],
        ]);

        return $this->render('indexclientes', [
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single Userprofile model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
    */
    public function actionView($id)
    {
        $userprofile = Userprofile::find()->where(['user_id' => $id])->one();

        $numeventosuser = (new yii\db\Query())
            ->from('eventos')
            ->select(['ISNULL(id, 0)'])
            ->where(['id_criador' => $userprofile->id])
            ->andwhere(['!=', 'estado', 'cancelado'])
            ->count();

        $valorfaturadouser = (new yii\db\Query())
            ->from('faturas')
            ->select(['ISNULL(preco, 0)'])
            ->leftJoin('pulseiras', 'pulseiras.id = faturas.id_pulseira')
            ->leftJoin('eventos', 'eventos.id = pulseiras.id_evento')
            ->where(['eventos.id_criador' => $userprofile->id])
            ->andwhere(['!=', 'pulseiras.estado', 'cancelado'])
            ->sum('faturas.preco');

        $bilhetesveendidosuser = (new yii\db\Query())
            ->from('pulseiras')
            ->select(['ISNULL(id, 0)'])
            ->leftJoin('eventos', 'eventos.id = pulseiras.id_evento')
            ->where(['eventos.id_criador' => $userprofile->id])
            ->andwhere(['!=', 'pulseiras.estado', 'cancelada'])
            ->count('pulseiras.id');

        $grafico = (new yii\db\Query())
            ->from('eventos')
            ->select(['tipoevento.tipo AS item_name', 'COUNT(eventos.id_tipo_evento) AS quantidade_item_name'])
            ->leftJoin('tipoevento', 'tipoevento.id = eventos.id_tipo_evento')
            ->where(['eventos.id_criador' => $userprofile->id])
            ->groupBy('tipoevento.tipo')
            ->all();

        //--------------- Dados de rp ---------------//
        $graficorp = (new yii\db\Query())
            ->from('eventos')
            ->select(['tipoevento.tipo AS item_name', 'COUNT(pulseiras.codigorp) AS quantidade_item_name'])
            ->leftJoin('pulseiras', 'pulseiras.id_evento = eventos.id')
            ->leftJoin('tipoevento', 'tipoevento.id = eventos.id_tipo_evento')
            ->where(['pulseiras.codigorp' => $userprofile->codigoRP])
            ->groupBy('tipoevento.tipo')
            ->all();
        
        $grafico2rp = (new yii\db\Query())
            ->from('userprofile')
            ->select(['sexo', 'COUNT(pulseiras.codigorp) AS quantidade'])
            ->leftJoin('user', 'user.id = userprofile.user_id')
            ->leftJoin('pulseiras', 'pulseiras.id_cliente = userprofile.id')
            ->leftJoin('auth_assignment', 'auth_assignment.user_id = user.id')
            ->where(['auth_assignment.item_name' => 'cliente'])
            ->andwhere(['pulseiras.codigorp' => $userprofile->codigoRP])
            ->orderBy(['sexo'=>SORT_ASC])
            ->groupBy('sexo')
            ->all();

        $listaeventosrp = (new yii\db\Query())
            ->from('eventos')
            ->select(['eventos.nome AS nome', 'eventos.dataevento AS dataevento', 'COUNT(pulseiras.codigorp) AS quantidade_codigos'])
            ->leftJoin('pulseiras', 'pulseiras.id_evento = eventos.id')
            ->where(['pulseiras.codigorp' => $userprofile->codigoRP])
            ->orderBy(['eventos.dataevento'=>SORT_DESC])
            ->groupBy('eventos.nome')
            ->all();

        if(array_keys(Yii::$app->authManager->getRolesByUser(Yii::$app->user->id))[0] == 'gestor'){
            if(array_keys(Yii::$app->authManager->getRolesByUser($userprofile->user_id))[0] != 'rp'){
                return $this->redirect(['index']);
            }
        }

        return $this->render('view', [
            'model' => $userprofile,
            'numeventosuser' => $numeventosuser,
            'valorfaturadouser' => $valorfaturadouser,
            'bilhetesveendidosuser' => $bilhetesveendidosuser,
            'graficorp' => $graficorp,
            'grafico2rp' => $grafico2rp,
            'listaeventosrp' => $listaeventosrp,
            'grafico' => $grafico,
        ]);
    }

    public function actionCreate()
    {
        $model = new SignupEmpregados();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->createnewfuncionario()) {
                return $this->redirect(['index']);
            }else {
                #$model->loadDefaultValues();
            }
        } 
    
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = new SignupEmpregados();

        $model = $model->loadingdados($id);

        if ($model->load($this->request->post()) && $model->updateload($id)) {
            return $this->redirect(['view', 'id' => $id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionUpdate_password($id)
    {
        $model = new SignupEmpregados();

        $model = $model->loadingdados($id);

        if ($model->load($this->request->post()) && $model->updateload($id)) {
            if(Yii::$app->user->getId() == $id){
                return $this->redirect(['/site/login']);
            }else{
                return $this->redirect(['view', 'id' => $id]);
                die;
            }
        }

        return $this->render('update_password', [
            'model' => $model,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Userprofile::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
