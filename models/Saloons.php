<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "saloons".
 *
 * @property int $id
 * @property int $exchange_id
 * @property string|null $building
 * @property string|null $floor
 * @property string $saloon
 * @property float $saloon_width horizontal meter
 * @property float $saloon_height vertical meter
 *
 * @property Objects[] $objects
 * @property Odfs[] $odfs
 * @property Racks[] $racks
 * @property Exchanges $exchange
 */
class Saloons extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'saloons';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['exchange_id', 'saloon'], 'required'],
            [['exchange_id'], 'integer'],
            [['saloon_width', 'saloon_height'], 'number'],
            [['building', 'saloon'], 'string', 'max' => 128],
            [['floor'], 'string', 'max' => 64],
            [['exchange_id', 'saloon', 'building', 'floor'], 'unique', 'targetAttribute' => ['exchange_id', 'saloon', 'building', 'floor']],
            [['exchange_id'], 'exist', 'skipOnError' => true, 'targetClass' => Exchanges::className(), 'targetAttribute' => ['exchange_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'exchange_id' => 'Exchange ID',
            'building' => 'Building',
            'floor' => 'Floor',
            'saloon' => 'Saloon',
            'saloon_width' => 'Saloon Width',
            'saloon_height' => 'Saloon Height',
        ];
    }

    /**
     * Gets query for [[Objects]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getObjects()
    {
        return $this->hasMany(Objects::className(), ['saloon_id' => 'id']);
    }

    /**
     * Gets query for [[Odfs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOdfs()
    {
        return $this->hasMany(Odfs::className(), ['saloon_id' => 'id']);
    }

    /**
     * Gets query for [[Racks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRacks()
    {
        return $this->hasMany(Racks::className(), ['saloon_id' => 'id']);
    }

    /**
     * Gets query for [[Exchange]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExchange()
    {
        return $this->hasOne(Exchanges::className(), ['id' => 'exchange_id']);
    }
}
