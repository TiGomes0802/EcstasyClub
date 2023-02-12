<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "faturas".
 *
 * @property int $id
 * @property string $datahora_compra
 * @property float $preco
 * @property int $id_pulseira
 *
 * @property LinhaFatura[] $linhaFaturas
 * @property Pulseiras $pulseira
 */
class Faturas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'faturas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['datahora_compra', 'preco', 'id_pulseira'], 'required', 'message' => '{attribute} não pode estar vazio'],
            [['datahora_compra'], 'safe'],
            [['preco'], 'number'],
            [['id_pulseira'], 'integer'],
            [['id_pulseira'], 'exist', 'skipOnError' => true, 'targetClass' => Pulseiras::class, 'targetAttribute' => ['id_pulseira' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'datahora_compra' => 'Datahora Compra',
            'preco' => 'Preco',
            'id_pulseira' => 'Id Pulseira',
        ];
    }

    /**
     * Gets query for [[LinhaFaturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLinhaFaturas()
    {
        return $this->hasMany(LinhaFatura::class, ['id_fatura' => 'id']);
    }

    /**
     * Gets query for [[Pulseira]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPulseira()
    {
        return $this->hasOne(Pulseiras::class, ['id' => 'id_pulseira']);
    }
}
