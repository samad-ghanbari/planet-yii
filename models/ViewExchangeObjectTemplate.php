<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "view_exchange_object_template".
 *
 * @property int|null $province_id
 * @property int|null $office_id
 * @property int|null $exchange_id
 * @property int $object_template_id
 * @property string $object_name
 * @property string $object_icon
 * @property string $object_template
 */
class ViewExchangeObjectTemplate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'view_exchange_object_template';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['province_id', 'office_id', 'exchange_id', 'object_template_id'], 'integer'],
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
            'province_id' => 'Province ID',
            'office_id' => 'Office ID',
            'exchange_id' => 'Exchange ID',
            'object_template_id' => 'Object Template ID',
            'object_name' => 'Object Name',
            'object_icon' => 'Object Icon',
            'object_template' => 'Object Template',
        ];
    }
}
