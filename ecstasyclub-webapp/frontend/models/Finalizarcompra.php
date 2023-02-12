<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * Finalizar Compra
 */
class Finalizarcompra extends \yii\db\ActiveRecord
{
    public $nome;
    public $apelido;
    public $email;
    public $titularcartao;
    public $numerocartao;
    public $datacartao;
    public $cvvcartao;

    public function rules()
    {
        return [
            [['nome', 'apelido', 'email', 'titularcartao', 'numerocartao', 'datacartao', 'cvvcartao'], 'required', 'message' => '{attribute} não pode estar vazio'],
            [['nome', 'apelido', 'email', 'titularcartao'], 'string', 'max' => 55],
            ['email', 'email', 'message' => 'Não é um e-mail válido'],
            ['numerocartao', 'match', 'pattern' => '/^[0-9]\w*$/i', 'message' => '{attribute} inválido'],
            ['numerocartao', 'string', 'max' => 16, 'tooLong' => '{attribute} inválido', 'min' => 16, 'tooShort' => '{attribute} inválido'],
            ['cvvcartao', 'match', 'pattern' => '/^[0-9]{3}\w*$/', 'message' => '{attribute} inválido'],
            ['cvvcartao', 'number', 'max' => 999, 'tooBig' => '{attribute} inválido'],
            ['datacartao', 'date', 'format'=>'M/d'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nome' => 'Nome',
            'apelido' => 'Apelido',
            'email' => 'E-mail',
            'titularcartao' => 'Titular do cartão',
            'numerocartao' => 'Número cartão',
            'datacartao' => 'Data do cartão',
            'cvvcartao' => 'Código de segurança',
        ];
    }
}