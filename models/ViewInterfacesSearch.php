<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ViewInterfaces;

/**
 * ViewInterfacesSearch represents the model behind the search form of `app\models\ViewInterfaces`.
 */
class ViewInterfacesSearch extends ViewInterfaces
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['int_id', 'slots_id', 'devex_id', 'exchange_id', 'area_no', 'saloon_no', 'device_id', 'shelf', 'slot', 'sub_slot', 'port', 'pin_id', 'ether_trunk'], 'integer'],
            [['area', 'abbr', 'exchange', 'saloon_name', 'device', 'interface_type', 'interface', 'label', 'module', 'peer_abbr', 'peer_device', 'peer_interface', 'peer_label'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ViewInterfaces::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere(["REGEXP",'int_id',$this->int_id])
            ->andFilterWhere(["REGEXP",'slots_id' , $this->slots_id])
            ->andFilterWhere(["REGEXP",'devex_id' , $this->devex_id])
            ->andFilterWhere(["REGEXP",'exchange_id' , $this->exchange_id])
            ->andFilterWhere(["REGEXP",'area_no' , $this->area_no])
            ->andFilterWhere(["REGEXP",'saloon_no' , $this->saloon_no])
            ->andFilterWhere(["REGEXP",'device_id' , $this->device_id])
            ->andFilterWhere(["REGEXP",'shelf' , $this->shelf])
            ->andFilterWhere(["REGEXP",'slot' , $this->slot])
            ->andFilterWhere(["REGEXP",'sub_slot' , $this->sub_slot])
            ->andFilterWhere(["REGEXP",'port' , $this->port])
            ->andFilterWhere(["REGEXP",'pin_id' , $this->pin_id])
            ->andFilterWhere(["REGEXP",'ether_trunk' , $this->ether_trunk])

            ->andFilterWhere(['REGEXP', 'area', $this->area])
            ->andFilterWhere(['REGEXP', 'abbr', $this->abbr])
            ->andFilterWhere(['REGEXP', 'exchange', $this->exchange])
            ->andFilterWhere(['REGEXP', 'saloon_name', $this->saloon_name])
            ->andFilterWhere(['REGEXP', 'device', $this->device])
            ->andFilterWhere(['REGEXP', 'interface_type', $this->interface_type])
            ->andFilterWhere(['REGEXP', 'interface', $this->interface])
            ->andFilterWhere(['REGEXP', 'label', $this->label])
            ->andFilterWhere(['REGEXP', 'module', $this->module])
            ->andFilterWhere(['REGEXP', 'peer_abbr', $this->peer_abbr])
            ->andFilterWhere(['REGEXP', 'peer_device', $this->peer_device])
            ->andFilterWhere(['REGEXP', 'peer_interface', $this->peer_interface])
            ->andFilterWhere(['REGEXP', 'peer_label', $this->peer_label]);

        return $dataProvider;
    }
}
