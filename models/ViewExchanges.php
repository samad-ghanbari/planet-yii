<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "view_exchanges".
 *
 * @property int $id
 * @property int $province_id
 * @property string|null $province
 * @property int $office_id
 * @property string|null $office
 * @property int $area
 * @property string $name
 * @property string $abbr
 * @property int $type_no 1:kol;2:exch;3:site
 * @property string|null $type
 * @property int|null $mother_id
 * @property string|null $mother_abbr
 * @property int|null $uplink_id
 * @property string|null $uplink_abbr
 * @property int|null $site_cascade
 * @property int|null $site_node
 * @property float $site_top px
 * @property float $site_left px
 * @property string $address
 */
class ViewExchanges extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'view_exchanges';
    }

    public static function primaryKey()
    {
        return ['id'];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'province_id', 'office_id', 'area', 'type_no', 'mother_id', 'uplink_id', 'site_cascade', 'site_node'], 'integer'],
            [['province_id', 'office_id', 'area', 'name', 'abbr', 'type_no', 'address'], 'required'],
            [['site_top', 'site_left'], 'number'],
            [['province', 'office', 'address'], 'string', 'max' => 200],
            [['name'], 'string', 'max' => 100],
            [['abbr', 'mother_abbr', 'uplink_abbr'], 'string', 'max' => 50],
            [['type'], 'string', 'max' => 8],
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
            'province' => 'Province',
            'office_id' => 'Office ID',
            'office' => 'Office',
            'area' => 'Area',
            'name' => 'Name',
            'abbr' => 'Abbr',
            'type_no' => 'Type No',
            'type' => 'Type',
            'mother_id' => 'Mother ID',
            'mother_abbr' => 'Mother Abbr',
            'uplink_id' => 'Uplink ID',
            'uplink_abbr' => 'Uplink Abbr',
            'site_cascade' => 'Site Cascade',
            'site_node' => 'Site Node',
            'site_top' => 'Site Top',
            'site_left' => 'Site Left',
            'address' => 'Address',
        ];
    }
}
