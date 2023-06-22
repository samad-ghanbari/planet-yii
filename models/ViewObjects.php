<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "view_objects".
 *
 * @property int $id
 * @property int|null $province_id
 * @property int|null $office_id
 * @property int|null $exchange_id
 * @property int $saloon_id
 * @property int|null $object_template_id
 * @property int|null $font_size
 * @property string|null $text
 * @property float|null $object_width cm
 * @property float|null $object_depth cm
 * @property float|null $object_height cm
 * @property float $object_top px
 * @property float $object_left px
 * @property float $object_rotation degree
 * @property string|null $object_desc
 */
class ViewObjects extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'view_objects';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'province_id', 'office_id', 'exchange_id', 'saloon_id', 'object_template_id', 'font_size'], 'integer'],
            [['saloon_id', 'object_top', 'object_left'], 'required'],
            [['object_width', 'object_depth', 'object_height', 'object_top', 'object_left', 'object_rotation'], 'number'],
            [['text'], 'string', 'max' => 100],
            [['object_desc'], 'string', 'max' => 256],
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
            'saloon_id' => 'Saloon ID',
            'object_template_id' => 'Object Template ID',
            'font_size' => 'Font Size',
            'text' => 'Text',
            'object_width' => 'Object Width',
            'object_depth' => 'Object Depth',
            'object_height' => 'Object Height',
            'object_top' => 'Object Top',
            'object_left' => 'Object Left',
            'object_rotation' => 'Object Rotation',
            'object_desc' => 'Object Desc',
        ];
    }
}
