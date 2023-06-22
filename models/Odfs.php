<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "odfs".
 *
 * @property int $id
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
 *
 * @property Saloons $saloon
 */
class Odfs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'odfs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['saloon_id', 'odf_row', 'odf_column', 'odf_no', 'pos_count', 'odf_width', 'odf_depth', 'odf_height'], 'required'],
            [['saloon_id', 'odf_row', 'odf_column', 'odf_no', 'pos_count'], 'integer'],
            [['odf_width', 'odf_depth', 'odf_height', 'odf_top', 'odf_left', 'odf_rotation'], 'number'],
            [['odf_desc'], 'string', 'max' => 256],
            [['saloon_id', 'odf_row', 'odf_column', 'odf_no', 'pos_count'], 'unique', 'targetAttribute' => ['saloon_id', 'odf_row', 'odf_column', 'odf_no', 'pos_count']],
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
