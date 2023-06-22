<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "view_racks".
 *
 * @property int $id
 * @property int|null $province_id
 * @property int|null $office_id
 * @property int|null $exchange_id
 * @property int|null $area
 * @property string|null $abbr
 * @property int $saloon_id
 * @property string|null $saloon
 * @property int $rack_row
 * @property int $rack_column
 * @property float $rack_width centimeter
 * @property float $rack_depth centimeter
 * @property float $rack_height centimeter
 * @property float $rack_top px
 * @property float $rack_left px
 * @property float $rack_rotation degree
 * @property string|null $rack_desc
 */
class ViewRacks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'view_racks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'province_id', 'office_id', 'exchange_id', 'area', 'saloon_id', 'rack_row', 'rack_column'], 'integer'],
            [['saloon_id', 'rack_row', 'rack_column', 'rack_width', 'rack_depth', 'rack_height'], 'required'],
            [['rack_width', 'rack_depth', 'rack_height', 'rack_top', 'rack_left', 'rack_rotation'], 'number'],
            [['abbr'], 'string', 'max' => 50],
            [['saloon'], 'string', 'max' => 128],
            [['rack_desc'], 'string', 'max' => 512],
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
            'rack_row' => 'Rack Row',
            'rack_column' => 'Rack Column',
            'rack_width' => 'Rack Width',
            'rack_depth' => 'Rack Depth',
            'rack_height' => 'Rack Height',
            'rack_top' => 'Rack Top',
            'rack_left' => 'Rack Left',
            'rack_rotation' => 'Rack Rotation',
            'rack_desc' => 'Rack Desc',
        ];
    }
}
