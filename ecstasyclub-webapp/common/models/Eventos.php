<?php

namespace common\models;

use Yii;
use DateTime;
use yii\base\Model;
use yii\web\UploadedFile;
/**
 * This is the model class for table "eventos".
 *
 * @property int $id
 * @property string $nome
 * @property string $descricao
 * @property string $cartaz
 * @property string $dataevento
 * @property int $numbilhetesdisp
 * @property float $preco
 * @property string $estado
 * @property int $id_criador
 * @property int $id_tipo_evento
 *
 * @property Userprofile $criador
 * @property Galerias[] $galerias
 * @property Pulseiras[] $pulseiras
 * @property Tipoevento $tipoEvento
 */
class Eventos extends \yii\db\ActiveRecord
{
    /**
     * @var \yii\web\UploadedFile
     */
    public $imageFile;
    public $imageFileUpdate;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'eventos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        $date = new DateTime();
        $min = $date->format('Y-m-d H:i');
        $disco = Disco::findOne(1);

        return [
            [['nome', 'descricao', 'cartaz', 'dataevento', 'numbilhetesdisp', 'preco', 'estado', 'id_criador', 'id_tipo_evento', 'imageFile'], 'required', 'message' => '{attribute} não pode estar vazio'],
            ['dataevento', 'safe'],
            ['dataevento', 'datetime', 'format' => 'php:Y-m-d H:i', 'min' => $min, 'tooSmall' => 'Data minima é ' . $min],
            [['numbilhetesdisp', 'id_criador', 'id_tipo_evento'], 'integer'],
            ['numbilhetesdisp', 'integer', 'max' => $disco->lotacao],
            ['preco', 'double'],
            [['nome', 'estado'], 'string', 'max' => 25],
            ['descricao', 'string', 'max' => 750],
            ['cartaz', 'string', 'max' => 250],
            ['id_criador', 'exist', 'skipOnError' => true, 'targetClass' => Userprofile::class, 'targetAttribute' => ['id_criador' => 'id']],
            ['id_tipo_evento', 'exist', 'skipOnError' => true, 'targetClass' => Tipoevento::class, 'targetAttribute' => ['id_tipo_evento' => 'id']],
            [['imageFile','imageFileUpdate'], 'file', 'extensions' => 'png, jpg'],
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
            'descricao' => 'Descrição',
            'cartaz' => 'Cartaz',
            'imageFile' => 'Imagem do cartaz',
            'imageFileUpdate' => 'Imagem do cartaz',
            'dataevento' => 'Data do evento',
            'numbilhetesdisp' => 'Número de bilhetes',
            'preco' => 'Preço',
            'estado' => 'Estado',
            'id_criador' => 'Id Criador',
            'id_tipo_evento' => 'Id Tipo Evento',
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

    /**
     * Gets query for [[Galerias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGalerias()
    {
        return $this->hasMany(Galerias::class, ['id_evento' => 'id']);
    }

    /**
     * Gets query for [[Pulseiras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPulseiras()
    {
        return $this->hasMany(Pulseiras::class, ['id_evento' => 'id']);
    }

    /**
     * Gets query for [[TipoEvento]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipoEvento()
    {
        return $this->hasOne(Tipoevento::class, ['id' => 'id_tipo_evento']);
    }
}
