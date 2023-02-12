<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "disco".
 *
 * @property int $id
 * @property string $nome
 * @property string $nif
 * @property string $localidade
 * @property string $codpostal
 * @property string $morada
 * @property int $lotacao
 */
class Disco extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'disco';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'nif', 'localidade', 'codpostal', 'morada', 'lotacao'], 'required', 'message' => '{attribute} não pode estar vazio'],
            ['lotacao', 'integer'],
            [['nome', 'localidade'], 'string', 'max' => 25],
            ['nif', 'match', 'pattern' => '/^[0-9]\w*$/i', 'message' => 'NIF invalido o NIF são 9 números'],
            ['nif', 'string', 'max' => 9, 'min' => 9],
            ['codpostal', 'string', 'max' => 8],
            ['codpostal', 'match', 'pattern' => '/^[0-9_]{4,4}+([0-9_]+)*[-][0-9_]{2,2}+([0-9_])$/', 'message' => 'codigopostal invalido, formato valido = (xxxx-xxx)'],
            ['morada', 'string', 'max' => 50],
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
            'nif' => 'Nif',
            'localidade' => 'Localidade',
            'codpostal' => 'Codpostal',
            'morada' => 'Morada',
            'lotacao' => 'Lotacao',
        ];
    }
}
