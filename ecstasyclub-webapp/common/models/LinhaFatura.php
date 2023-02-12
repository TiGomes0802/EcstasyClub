<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "linha_fatura".
 *
 * @property int $id
 * @property int $id_bebida
 * @property int $id_fatura
 *
 * @property Bebidas $bebida
 * @property Faturas $fatura
 */
class LinhaFatura extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'linha_fatura';
    }

    public $bebidas;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_bebida', 'id_fatura', 'bebidas'], 'required'],
            [['id_bebida', 'id_fatura'], 'integer'],
            [['id_bebida'], 'exist', 'skipOnError' => true, 'targetClass' => Bebidas::class, 'targetAttribute' => ['id_bebida' => 'id']],
            [['id_fatura'], 'exist', 'skipOnError' => true, 'targetClass' => Faturas::class, 'targetAttribute' => ['id_fatura' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_bebida' => 'Id Bebida',
            'id_fatura' => 'Id Fatura',
            'bebidas' => 'bebidas',
        ];
    }

    /**
     * Gets query for [[Bebida]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBebida()
    {
        return $this->hasOne(Bebidas::class, ['id' => 'id_bebida']);
    }

    /**
     * Gets query for [[Fatura]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFatura()
    {
        return $this->hasOne(Faturas::class, ['id' => 'id_fatura']);
    }
}
