<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ViewExchanges;

/**
 * ViewExchangesSearch represents the model behind the search form of `app\models\ViewExchanges`.
 */
class ViewExchangesSearch extends ViewExchanges
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'province_id', 'office_id', 'area', 'type_no', 'mother_id', 'uplink_id', 'site_cascade', 'site_node'], 'integer'],
            [['province', 'office', 'name', 'abbr', 'type', 'mother_abbr', 'uplink_abbr', 'address'], 'safe'],
            [['site_top', 'site_left'], 'number'],
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
        $query = ViewExchanges::find();

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
        $query->andFilterWhere([
            'id' => $this->id,
            'province_id' => $this->province_id,
            'office_id' => $this->office_id,
            'area' => $this->area,
            'type_no' => $this->type_no,
            'mother_id' => $this->mother_id,
            'uplink_id' => $this->uplink_id,
            'site_cascade' => $this->site_cascade,
            'site_node' => $this->site_node,
            'site_top' => $this->site_top,
            'site_left' => $this->site_left,
        ]);

        $query->andFilterWhere(['REGEXP', 'province', $this->province])
            ->andFilterWhere(['REGEXP', 'office', $this->office])
            ->andFilterWhere(['REGEXP', 'name', $this->name])
            ->andFilterWhere(['REGEXP', 'abbr', $this->abbr])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['REGEXP', 'mother_abbr', $this->mother_abbr])
            ->andFilterWhere(['REGEXP', 'uplink_abbr', $this->uplink_abbr])
            ->andFilterWhere(['REGEXP', 'address', $this->address]);

        return $dataProvider;
    }
}
