<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "view_rackdevs".
 *
 * @property int $id
 * @property int|null $province_id
 * @property int|null $office_id
 * @property int|null $exchange_id
 * @property int|null $area
 * @property string|null $abbr
 * @property int|null $saloon_id
 * @property string|null $saloon
 * @property int $rack_id
 * @property int|null $rack_row
 * @property int|null $rack_column
 * @property int $device_id
 * @property string|null $device_type
 * @property string|null $device
 * @property float|null $device_width cm
 * @property float|null $device_depth cm
 * @property float|null $device_height cm
 * @property int $shelf_no
 * @property string $device_name
 * @property string $purchase
 * @property string|null $description
 */
class ViewRackdevs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'view_rackdevs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'province_id', 'office_id', 'exchange_id', 'area', 'saloon_id', 'rack_id', 'rack_row', 'rack_column', 'device_id', 'shelf_no'], 'integer'],
            [['rack_id', 'device_id', 'shelf_no', 'device_name', 'purchase'], 'required'],
            [['device_width', 'device_depth', 'device_height'], 'number'],
            [['abbr', 'device_type', 'purchase'], 'string', 'max' => 50],
            [['saloon'], 'string', 'max' => 128],
            [['device'], 'string', 'max' => 100],
            [['device_name'], 'string', 'max' => 150],
            [['description'], 'string', 'max' => 512],
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
            'exchange_id' => 'Exchange ID',
            'area' => 'Area',
            'abbr' => 'Abbr',
            'saloon_id' => 'Saloon ID',
            'saloon' => 'Saloon',
            'rack_id' => 'Rack ID',
            'rack_row' => 'Rack Row',
            'rack_column' => 'Rack Column',
            'device_id' => 'Device ID',
            'device_type' => 'Device Type',
            'device' => 'Device',
            'device_width' => 'Device Width',
            'device_depth' => 'Device Depth',
            'device_height' => 'Device Height',
            'shelf_no' => 'Shelf No',
            'device_name' => 'Device Name',
            'purchase' => 'Purchase',
            'description' => 'Description',
        ];
    }
}
