<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pulseiras".
 *
 * @property int $id
 * @property string $estado
 * @property string $tipo
 * @property int $codigorp
 * @property int $id_evento
 * @property int $id_cliente
 *
 * @property Userprofile $cliente
 * @property Eventos $evento
 * @property Faturas[] $faturas
 * @property VipPulseira[] $vipPulseiras
 */
class Pulseiras extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pulseiras';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['estado', 'tipo', 'id_evento', 'id_cliente'], 'required', 'message' => '{attribute} não pode estar vazio'],
            [['id_evento', 'id_cliente'], 'integer'],
            [['estado', 'tipo', 'codigorp'], 'string', 'max' => 25],
            [['id_evento'], 'exist', 'skipOnError' => true, 'targetClass' => Eventos::class, 'targetAttribute' => ['id_evento' => 'id']],
            [['id_cliente'], 'exist', 'skipOnError' => true, 'targetClass' => Userprofile::class, 'targetAttribute' => ['id_cliente' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'estado' => 'Estado',
            'tipo' => 'Tipo',
            'codigorp' => 'Codigorp',
            'id_evento' => 'Id Evento',
            'id_cliente' => 'Id Cliente',
        ];
    }

    /**
     * Gets query for [[Cliente]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCliente()
    {
        return $this->hasOne(Userprofile::class, ['id' => 'id_cliente']);
    }

    /**
     * Gets query for [[Evento]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvento()
    {
        return $this->hasOne(Eventos::class, ['id' => 'id_evento']);
    }

    /**
     * Gets query for [[Faturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFaturas()
    {
        return $this->hasMany(Faturas::class, ['id_pulseira' => 'id']);
    }

    /**
     * Gets query for [[VipPulseiras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVipPulseiras()
    {
        return $this->hasMany(VipPulseira::class, ['id_pulseira' => 'id']);
    }
}