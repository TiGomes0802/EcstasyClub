<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "noticias".
 *
 * @property int $id
 * @property string $titulo
 * @property string $datanoticia
 * @property string $descricao
 * @property int $id_criador
 *
 * @property Userprofile $criador
 */
class Noticias extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'noticias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titulo', 'datanoticia', 'descricao', 'id_criador'], 'required', 'message' => '{attribute} não pode estar vazio'],
            ['datanoticia', 'safe'],
            ['datanoticia', 'datetime', 'format' => 'php:Y-m-d H:i:s'],
            ['id_criador', 'integer'],
            ['titulo', 'string', 'max' => 25],
            ['descricao', 'string', 'max' => 750],
            ['id_criador', 'exist', 'skipOnError' => true, 'targetClass' => Userprofile::class, 'targetAttribute' => ['id_criador' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'titulo' => 'Titulo',
            'datanoticia' => 'Datanoticia',
            'descricao' => 'Descricao',
            'id_criador' => 'Id Criador',
        ];
    }

     /**
     * Gets query for [[Criador]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCriador()
    {
        return $this->hasOne(Userprofile::class, ['id' => 'id_criador']);
    }
}