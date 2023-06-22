<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "recommendation".
 *
 * @property int $id
 * @property int $user_id
 * @property string $time_stamp
 * @property string $recommendation
 *
 * @property Users $user
 */
class Recommendation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'recommendation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'recommendation'], 'required'],
            [['user_id'], 'integer'],
            [['time_stamp'], 'safe'],
            [['recommendation'], 'string', 'max' => 2048],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'time_stamp' => 'Time Stamp',
            'recommendation' => 'Recommendation',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
}
