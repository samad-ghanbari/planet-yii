<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "view_recommendation".
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $name
 * @property string|null $lastname
 * @property string|null $national_id
 * @property int|null $province_id
 * @property string|null $province
 * @property int|null $office_id
 * @property string|null $office
 * @property string $time_stamp
 * @property string $recommendation
 */
class ViewRecommendation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'view_recommendation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'province_id', 'office_id'], 'integer'],
            [['user_id', 'recommendation'], 'required'],
            [['time_stamp'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['lastname', 'province', 'office'], 'string', 'max' => 200],
            [['national_id'], 'string', 'max' => 15],
            [['recommendation'], 'string', 'max' => 2048],
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
            'name' => 'Name',
            'lastname' => 'Lastname',
            'national_id' => 'National ID',
            'province_id' => 'Province ID',
            'province' => 'Province',
            'office_id' => 'Office ID',
            'office' => 'Office',
            'time_stamp' => 'Time Stamp',
            'recommendation' => 'Recommendation',
        ];
    }
}
