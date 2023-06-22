<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "racks".
 *
 * @property int $id
 * @property int $saloon_id
 * @property int $rack_row
 * @property int $rack_column
 * @property float $rack_width centimeter
 * @property float $rack_depth centimeter
 * @property float $rack_height centimeter
 * @property float|null $rack_top px
 * @property float|null $rack_left px
 * @property float $rack_rotation degree
 * @property string|null $rack_desc
 *
 * @property Rackdevs[] $rackdevs
 * @property Saloons $saloon
 */
class Racks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'racks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['saloon_id', 'rack_row', 'rack_column', 'rack_width', 'rack_depth', 'rack_height'], 'required'],
            [['saloon_id', 'rack_row', 'rack_column'], 'integer'],
            [['rack_width', 'rack_depth', 'rack_height', 'rack_top', 'rack_left', 'rack_rotation'], 'number'],
            [['rack_desc'], 'string', 'max' => 512],
            [['saloon_id', 'rack_row', 'rack_column'], 'unique', 'targetAttribute' => ['saloon_id', 'rack_row', 'rack_column']],
            [['saloon_id'], 'exist', 'skipOnError' => true, 'targetClass' => Saloons::className(), 'targetAttribute' => ['saloon_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'saloon_id' => 'Saloon ID',
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

    /**
     * Gets query for [[Rackdevs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRackdevs()
    {
        return $this->hasMany(Rackdevs::className(), ['rack_id' => 'id']);
    }

    /**
     * Gets query for [[Saloon]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSaloon()
    {
        return $this->hasOne(Saloons::className(), ['id' => 'saloon_id']);
    }
}
