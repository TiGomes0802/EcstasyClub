<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bebidas".
 *
 * @property int $id
 * @property string $nome
 *
 * @property LinhaFatura[] $linhaFaturas
 */
class Bebidas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bebidas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome'], 'required', 'message' => '{attribute} não pode estar vazio'],
            [['nome'], 'string', 'max' => 50],
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
        ];
    }

    /**
     * Gets query for [[LinhaFaturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLinhaFaturas()
    {
        return $this->hasMany(LinhaFatura::class, ['id_bebida' => 'id']);
    }
}
