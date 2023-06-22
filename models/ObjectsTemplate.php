<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "objects_template".
 *
 * @property int $id
 * @property string $object_name
 * @property string $object_icon
 * @property string $object_template
 *
 * @property Objects[] $objects
 */
class ObjectsTemplate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects_template';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['object_name', 'object_icon', 'object_template'], 'required'],
            [['object_name'], 'string', 'max' => 100],
            [['object_icon'], 'string', 'max' => 1024],
            [['object_template'], 'string', 'max' => 2048],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'object_name' => 'Object Name',
            'object_icon' => 'Object Icon',
            'object_template' => 'Object Template',
        ];
    }

    /**
     * Gets query for [[Objects]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getObjects()
    {
        return $this->hasMany(Objects::className(), ['object_template_id' => 'id']);
    }
}
