<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "vip_pulseira".
 *
 * @property int $id
 * @property int $id_vip
 * @property int $id_pulseira
 *
 * @property Pulseiras $pulseira
 * @property Vip $vip
 */
class VipPulseira extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vip_pulseira';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_vip', 'id_pulseira'], 'required'],
            [['id_vip', 'id_pulseira'], 'integer'],
            [['id_vip'], 'exist', 'skipOnError' => true, 'targetClass' => Vip::class, 'targetAttribute' => ['id_vip' => 'id']],
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
            'id_vip' => 'Id Vip',
            'id_pulseira' => 'Id Pulseira',
        ];
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

    /**
     * Gets query for [[Vip]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVip()
    {
        return $this->hasOne(Vip::class, ['id' => 'id_vip']);
    }
}