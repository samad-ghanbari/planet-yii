<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "devcp".
 *
 * @property int $id
 * @property int $device_id
 * @property float $dcp_top
 * @property float $dcp_left
 * @property float $dcp_width
 * @property float $dcp_height
 * @property string $dcp_type
 * @property string $dcp_text
 *
 * @property Devices $device
 */
class Devcp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'devcp';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['device_id', 'dcp_top', 'dcp_left', 'dcp_width', 'dcp_height', 'dcp_type', 'dcp_text'], 'required'],
            [['device_id'], 'integer'],
            [['dcp_top', 'dcp_left', 'dcp_width', 'dcp_height'], 'number'],
            [['dcp_type'], 'string'],
            [['dcp_text'], 'string', 'max' => 200],
            [['device_id'], 'exist', 'skipOnError' => true, 'targetClass' => Devices::className(), 'targetAttribute' => ['device_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'device_id' => 'Device ID',
            'dcp_top' => 'Dcp Top',
            'dcp_left' => 'Dcp Left',
            'dcp_width' => 'Dcp Width',
            'dcp_height' => 'Dcp Height',
            'dcp_type' => 'Dcp Type',
            'dcp_text' => 'Dcp Text',
        ];
    }

    /**
     * Gets query for [[Device]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDevice()
    {
        return $this->hasOne(Devices::className(), ['id' => 'device_id']);
    }
}
