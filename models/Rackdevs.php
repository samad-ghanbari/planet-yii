<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rackdevs".
 *
 * @property int $id
 * @property int $rack_id
 * @property int $device_id
 * @property int $shelf_no
 * @property string $device_name
 * @property string $purchase
 * @property string|null $description
 *
 * @property Racks $rack
 * @property Devices $device
 */
class Rackdevs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rackdevs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rack_id', 'device_id', 'shelf_no', 'device_name', 'purchase'], 'required'],
            [['rack_id', 'device_id', 'shelf_no'], 'integer'],
            [['device_name'], 'string', 'max' => 150],
            [['purchase'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 512],
            [['rack_id', 'shelf_no'], 'unique', 'targetAttribute' => ['rack_id', 'shelf_no']],
            [['rack_id'], 'exist', 'skipOnError' => true, 'targetClass' => Racks::className(), 'targetAttribute' => ['rack_id' => 'id']],
            [['device_id'], 'exist', 'skipOnError' => true, 'targetClass' => Devices::className(), 'targetAttribute' => ['device_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rack_id' => 'Rack ID',
            'device_id' => 'Device ID',
            'shelf_no' => 'Shelf No',
            'device_name' => 'Device Name',
            'purchase' => 'Purchase',
            'description' => 'Description',
        ];
    }

    /**
     * Gets query for [[Rack]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRack()
    {
        return $this->hasOne(Racks::className(), ['id' => 'rack_id']);
    }

    /**
     * Gets query for [[Device]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDevice()
    {
        return $this->hasOne(Devices::className(), ['id' => 'device_id']);
    }
}
