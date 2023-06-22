<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "view_saloons".
 *
 * @property int $id
 * @property int|null $province_id
 * @property int|null $office_id
 * @property int $exchange_id
 * @property int|null $area
 * @property string|null $abbr
 * @property string|null $building
 * @property string|null $floor
 * @property string $saloon
 * @property float $saloon_width horizontal metr
 * @property float $saloon_height vertical metr
 */
class ViewSaloons extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'view_saloons';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'province_id', 'office_id', 'exchange_id', 'area'], 'integer'],
            [['exchange_id', 'saloon'], 'required'],
            [['saloon_width', 'saloon_height'], 'number'],
            [['abbr'], 'string', 'max' => 50],
            [['building', 'saloon'], 'string', 'max' => 128],
            [['floor'], 'string', 'max' => 64],
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
            'building' => 'Building',
            'floor' => 'Floor',
            'saloon' => 'Saloon',
            'saloon_width' => 'Saloon Width',
            'saloon_height' => 'Saloon Height',
        ];
    }
}
