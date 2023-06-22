<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "view_odfs".
 *
 * @property int $id
 * @property int|null $province_id
 * @property int|null $office_id
 * @property int|null $exchange_id
 * @property int|null $area
 * @property string|null $abbr
 * @property int $saloon_id
 * @property int $odf_row
 * @property int $odf_column
 * @property int $odf_no
 * @property int $pos_count
 * @property float $odf_width cm
 * @property float $odf_depth cm
 * @property float $odf_height cm
 * @property float $odf_top px
 * @property float $odf_left px
 * @property float $odf_rotation degree
 * @property string|null $odf_desc
 */
class ViewOdfs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'view_odfs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'province_id', 'office_id', 'exchange_id', 'area', 'saloon_id', 'odf_row', 'odf_column', 'odf_no', 'pos_count'], 'integer'],
            [['saloon_id', 'odf_row', 'odf_column', 'odf_no', 'pos_count', 'odf_width', 'odf_depth', 'odf_height'], 'required'],
            [['odf_width', 'odf_depth', 'odf_height', 'odf_top', 'odf_left', 'odf_rotation'], 'number'],
            [['abbr'], 'string', 'max' => 50],
            [['odf_desc'], 'string', 'max' => 256],
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
            'odf_row' => 'Odf Row',
            'odf_column' => 'Odf Column',
            'odf_no' => 'Odf No',
            'pos_count' => 'Pos Count',
            'odf_width' => 'Odf Width',
            'odf_depth' => 'Odf Depth',
            'odf_height' => 'Odf Height',
            'odf_top' => 'Odf Top',
            'odf_left' => 'Odf Left',
            'odf_rotation' => 'Odf Rotation',
            'odf_desc' => 'Odf Desc',
        ];
    }
}
