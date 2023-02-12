<?php

namespace common\models;

use Yii;
use DateTime;
use DateInterval;

/**
 * This is the model class for table "userprofile".
 *
 * @property int $id
 * @property string $nome
 * @property string $apelido
 * @property string $datanascimento
 * @property string|null $codigoRP
 * @property string|null $sexo
 * @property int $user_id
 *
 * @property Eventos[] $eventos
 * @property Noticias[] $noticias
 * @property Pulseiras[] $pulseiras
 * @property User $user
 */
class Userprofile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'userprofile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        $date = new DateTime();
        $date->sub(new DateInterval('P18Y'));
        $max = $date->format('Y-m-d');

        return [
            [['nome', 'apelido', 'datanascimento', 'user_id'], 'required', 'message' => '{attribute} não pode estar vazio'],
            [['datanascimento'], 'safe'],
            ['datanascimento', 'date', 'format' => 'php:Y-m-d', 'max' => $max, 'tooBig' => 'Precisa ser maior de 18 anos.'],
            [['user_id'], 'integer'],
            [['nome', 'apelido', 'codigoRP'], 'string', 'max' => 25],
            ['sexo', 'string', 'max' => 9],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'apelido' => 'Apelido',
            'datanascimento' => 'Data de nascimento',
            'codigoRP' => 'Codigo Rp',
            'sexo' => 'Sexo',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[Eventos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEventos()
    {
        return $this->hasMany(Eventos::class, ['id_criador' => 'id']);
    }

    /**
     * Gets query for [[Noticias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNoticias()
    {
        return $this->hasMany(Noticias::class, ['id_criador' => 'id']);
    }

    /**
     * Gets query for [[Pulseiras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPulseiras()
    {
        return $this->hasMany(Pulseiras::class, ['id_cliente' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}