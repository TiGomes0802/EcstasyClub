<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "vip".
 *
 * @property int $id
 * @property int $npessoas
 * @property string $descricao
 * @property int $nbebidas
 * @property float $preco
 *
 * @property VipPulseira[] $vipPulseiras
 */
class Vip extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vip';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['npessoas', 'descricao', 'nbebidas', 'preco'], 'required', 'message' => '{attribute} não pode estar vazio'],
            [['npessoas', 'nbebidas'], 'integer'],
            ['preco', 'number'],
            ['descricao', 'string', 'max' => 750],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'npessoas' => 'Npessoas',
            'descricao' => 'Descricao',
            'nbebidas' => 'Nbebidas',
            'preco' => 'Preco',
        ];
    }

    /**
     * Gets query for [[VipPulseiras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVipPulseiras()
    {
        return $this->hasMany(VipPulseira::class, ['id_vip' => 'id']);
    }
}
