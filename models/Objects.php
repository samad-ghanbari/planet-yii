<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "objects".
 *
 * @property int $id
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
 *
 * @property Saloons $saloon
 * @property ObjectsTemplate $objectTemplate
 */
class Objects extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['saloon_id', 'object_top', 'object_left'], 'required'],
            [['saloon_id', 'object_template_id', 'font_size'], 'integer'],
            [['object_width', 'object_depth', 'object_height', 'object_top', 'object_left', 'object_rotation'], 'number'],
            [['text'], 'string', 'max' => 100],
            [['object_desc'], 'string', 'max' => 256],
            [['saloon_id'], 'exist', 'skipOnError' => true, 'targetClass' => Saloons::className(), 'targetAttribute' => ['saloon_id' => 'id']],
            [['object_template_id'], 'exist', 'skipOnError' => true, 'targetClass' => ObjectsTemplate::className(), 'targetAttribute' => ['object_template_id' => 'id']],
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

    /**
     * Gets query for [[Saloon]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSaloon()
    {
        return $this->hasOne(Saloons::className(), ['id' => 'saloon_id']);
    }

    /**
     * Gets query for [[ObjectTemplate]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getObjectTemplate()
    {
        return $this->hasOne(ObjectsTemplate::className(), ['id' => 'object_template_id']);
    }
}
