<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "devices".
 *
 * @property int $id
 * @property int $province_id
 * @property int $office_id
 * @property string $device
 * @property string $type
 * @property string $vendor
 * @property float|null $device_width cm
 * @property float|null $device_depth cm
 * @property float|null $device_height cm
 * @property int $slot_count
 * @property int $line_slot_count
 * @property int|null $start_shelf
 * @property int $start_slot
 * @property int|null $start_subslot
 *
 * @property Provinces $province
 * @property Offices $office
 * @property Rackdevs[] $rackdevs
 */
class Devices extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'devices';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['province_id', 'office_id', 'device', 'type', 'vendor', 'slot_count', 'line_slot_count', 'start_slot'], 'required'],
            [['province_id', 'office_id', 'slot_count', 'line_slot_count', 'start_shelf', 'start_slot', 'start_subslot'], 'integer'],
            [['device_width', 'device_depth', 'device_height'], 'number'],
            [['device'], 'string', 'max' => 100],
            [['type', 'vendor'], 'string', 'max' => 50],
            [['province_id', 'office_id', 'device', 'type', 'vendor'], 'unique', 'targetAttribute' => ['province_id', 'office_id', 'device', 'type', 'vendor']],
            [['province_id'], 'exist', 'skipOnError' => true, 'targetClass' => Provinces::className(), 'targetAttribute' => ['province_id' => 'id']],
            [['office_id'], 'exist', 'skipOnError' => true, 'targetClass' => Offices::className(), 'targetAttribute' => ['office_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'province_id' => 'Province ID',
            'office_id' => 'Office ID',
            'device' => 'Device',
            'type' => 'Type',
            'vendor' => 'Vendor',
            'device_width' => 'Device Width',
            'device_depth' => 'Device Depth',
            'device_height' => 'Device Height',
            'slot_count' => 'Slot Count',
            'line_slot_count' => 'Line Slot Count',
            'start_shelf' => 'Start Shelf',
            'start_slot' => 'Start Slot',
            'start_subslot' => 'Start Subslot',
        ];
    }

    /**
     * Gets query for [[Province]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProvince()
    {
        return $this->hasOne(Provinces::className(), ['id' => 'province_id']);
    }

    /**
     * Gets query for [[Office]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOffice()
    {
        return $this->hasOne(Offices::className(), ['id' => 'office_id']);
    }

    /**
     * Gets query for [[Rackdevs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRackdevs()
    {
        return $this->hasMany(Rackdevs::className(), ['device_id' => 'id']);
    }
}
