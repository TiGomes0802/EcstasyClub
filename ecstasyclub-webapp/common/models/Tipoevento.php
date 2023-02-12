<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tipoevento".
 *
 * @property int $id
 * @property string|null $tipo
 *
 * @property Eventos[] $eventos
 */
class Tipoevento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipoevento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['tipo', 'required', 'message' => '{attribute} não pode estar vazio'],
            ['tipo', 'string', 'max' => 25],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipo' => 'Tipo',
        ];
    }

    /**
     * Gets query for [[Eventos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEventos()
    {
        return $this->hasMany(Eventos::class, ['id_tipo_evento' => 'id']);
    }
}
