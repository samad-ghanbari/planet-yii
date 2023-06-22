<?php

namespace app\models;

use Yii;

/**
* This is the model class for table "view_interfaces".
*
* @property int $int_id
* @property int $slots_id
* @property int|null $devex_id
* @property int|null $exchange_id
* @property int|null $area_no
* @property string|null $area
* @property string|null $abbr
* @property string|null $exchange
* @property int|null $saloon_no
* @property string|null $saloon_name
* @property int|null $device_id
* @property string|null $device
* @property string $interface_type
* @property int|null $shelf
* @property int|null $slot
* @property int|null $sub_slot
* @property int $port
* @property string $interface
* @property int|null $pin_id
* @property string $label
* @property string $module
* @property string|null $peer_abbr
* @property string|null $peer_device
* @property string|null $peer_interface
* @property string|null $peer_label
* @property int|null $ether_trunk
*/
class ViewInterfaces extends \yii\db\ActiveRecord
{
  /**
  * {@inheritdoc}
  */
  public static function tableName()
  {
    return 'view_interfaces';
  }

  public static function primaryKey()
  {
    return ['int_id'];
  }

  /**
  * {@inheritdoc}
  */
  public function rules()
  {
    return [
      [['int_id', 'slots_id', 'devex_id', 'exchange_id', 'area_no', 'saloon_no', 'device_id', 'shelf', 'slot', 'sub_slot', 'port', 'pin_id', 'ether_trunk'], 'integer'],
      [['slots_id', 'interface_type', 'port', 'interface', 'label'], 'required'],
      [['area'], 'string', 'max' => 11],
      [['abbr', 'interface'], 'string', 'max' => 20],
      [['exchange'], 'string', 'max' => 30],
      [['saloon_name'], 'string', 'max' => 50],
      [['device'], 'string', 'max' => 42],
      [['interface_type', 'module'], 'string', 'max' => 10],
      [['label'], 'string', 'max' => 80],
      [['peer_abbr', 'peer_device', 'peer_interface'], 'string', 'max' => 100],
      [['peer_label'], 'string', 'max' => 150],
    ];
  }

  /**
  * {@inheritdoc}
  */
  public function attributeLabels()
  {
    return [
      'int_id' => 'Int ID',
      'slots_id' => 'Slots ID',
      'devex_id' => 'Devex ID',
      'exchange_id' => 'Exchange ID',
      'area_no' => 'Area No',
      'area' => 'Area',
      'abbr' => 'Abbr',
      'exchange' => 'Exchange',
      'saloon_no' => 'Saloon No',
      'saloon_name' => 'Saloon Name',
      'device_id' => 'Device ID',
      'device' => 'Device',
      'interface_type' => 'Interface Type',
      'shelf' => 'Shelf',
      'slot' => 'Slot',
      'sub_slot' => 'Sub Slot',
      'port' => 'Port',
      'interface' => 'Interface',
      'pin_id' => 'Pin ID',
      'label' => 'Label',
      'module' => 'Module',
      'peer_abbr' => 'Peer Abbr',
      'peer_device' => 'Peer Device',
      'peer_interface' => 'Peer Interface',
      'peer_label' => 'Peer Label',
      'ether_trunk' => 'Ether Trunk',
    ];
  }
}
