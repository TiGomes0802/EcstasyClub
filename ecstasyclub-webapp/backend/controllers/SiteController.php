<?php

namespace backend\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use common\models\LoginForm;
use common\models\Tipoevento;
use common\models\Userprofile;
use common\models\EventosUpdate;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        $model = new Eventosupdate();
        $model->UpdateEstadoEvento();
        
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['gestor','admin'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    Yii::$app->user->logout();
                    return $this->redirect(['site/login']);
                }
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = Userprofile::find()->where(['user_id' => Yii::$app->user->id])->one();    

        //--------------- Dados de todos os eventos ---------------//

        $numeventos = (new yii\db\Query())
            ->from('eventos')
            ->select(['ISNULL(id, 0)'])
            ->where(['!=', 'estado', 'cancelado'])
            ->count();

        $valorfaturado = (new yii\db\Query())
            ->from('faturas')
            ->select(['ISNULL(preco, 0)'])
            ->leftJoin('pulseiras', 'pulseiras.id = faturas.id_pulseira')
            ->andwhere(['!=', 'pulseiras.estado', 'cancelada'])
            ->sum('faturas.preco');

        $bilhetesveendidos = (new yii\db\Query())
            ->from('pulseiras')
            ->select(['ISNULL(id, 0)'])
            ->andwhere(['!=', 'estado', 'cancelada'])
            ->count();

        //--------------- Dados dos proprios eventos ---------------//

        $numeventosuser = (new yii\db\Query())
            ->from('eventos')
            ->select(['ISNULL(id, 0)'])
            ->where(['id_criador' => $model->id])
            ->andwhere(['!=', 'estado', 'cancelado'])
            ->count();

        $valorfaturadouser = (new yii\db\Query())
            ->from('faturas')
            ->select(['ISNULL(preco, 0)'])
            ->leftJoin('pulseiras', 'pulseiras.id = faturas.id_pulseira')
            ->leftJoin('eventos', 'eventos.id = pulseiras.id_evento')
            ->where(['eventos.id_criador' => $model->id])
            ->andwhere(['!=', 'pulseiras.estado', 'cancelada'])
            ->sum('faturas.preco');

        $bilhetesveendidosuser = (new yii\db\Query())
            ->from('pulseiras')
            ->select(['ISNULL(id, 0)'])
            ->leftJoin('eventos', 'eventos.id = pulseiras.id_evento')
            ->where(['eventos.id_criador' => $model->id])
            ->andwhere(['!=', 'pulseiras.estado', 'cancelada'])
            ->count('pulseiras.id');

        //--------------- Graficos ---------------//

        $grafico = (new yii\db\Query())
            ->from('auth_assignment')
            ->select(['item_name', 'COUNT(item_name) AS quantidade_item_name'])
            ->where(['!=', 'auth_assignment.item_name', 'cliente'])
            ->groupBy('item_name')
            ->all();

        $grafico2 = (new yii\db\Query())
            ->from('userprofile')
            ->select(['sexo', 'COUNT(sexo) AS quantidade'])
            ->leftJoin('user', 'user.id = userprofile.user_id')
            ->leftJoin('auth_assignment', 'auth_assignment.user_id = user.id')
            ->where(['auth_assignment.item_name' => 'cliente'])
            ->orderBy(['sexo'=>SORT_ASC])
            ->groupBy('sexo')
            ->all();

        $grafico3 = Yii::$app->db->createCommand('
            SELECT tipoevento.tipo, Sum(faturas.preco) as faturamento, DATE_FORMAT(datahora_compra, "%M") as mes FROM faturas
            JOIN pulseiras 
                ON pulseiras.id = faturas.id_pulseira
            JOIN eventos 
                ON eventos.id = pulseiras.id_evento
            JOIN tipoevento 
                ON tipoevento.id = eventos.id_tipo_evento
            where datahora_compra >= now() - interval 12 month && eventos.estado != "cancelado"
            group by tipoevento.tipo, DATE_FORMAT(datahora_compra, "%M")')
        ->queryAll();

        $listatiposeventos = (new yii\db\Query())
            ->from('tipoevento')
            ->select(['tipo'])
            ->all();

        return $this->render('index', [
            'model' => $model,
            'numeventos' => $numeventos,
            'numeventosuser' => $numeventosuser,
            'valorfaturado' => $valorfaturado,
            'valorfaturadouser' => $valorfaturadouser,
            'bilhetesveendidos' => $bilhetesveendidos,
            'bilhetesveendidosuser' => $bilhetesveendidosuser,
            'grafico' => $grafico,
            'grafico2' => $grafico2,
            'grafico3' => $grafico3,
            'listatiposeventos' => $listatiposeventos,
        ]);
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        //if (!Yii::$app->user->isGuest && $model->verifycanbackend()*/) {
        //    return $this->goHome();
        //}

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login() && $model->verifycanbackend()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }   
}
