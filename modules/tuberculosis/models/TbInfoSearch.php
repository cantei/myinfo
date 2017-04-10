<?php

namespace app\modules\tuberculosis\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\tuberculosis\models\TbInfo;

/**
 * TbInfoSearch represents the model behind the search form about `app\modules\tuberculosis\models\TbInfo`.
 */
class TbInfoSearch extends TbInfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TBNUMBER', 'DATE_REG', 'HMAIN', 'HN', 'PRENAME', 'FNAME', 'LNAME', 'CID', 'SEX', 'HNO', 'VILLAGE_ID', 'PHONE', 'MEMO'], 'safe'],
            [['AGE', 'BW'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = TbInfo::find();

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
            'DATE_REG' => $this->DATE_REG,
            'AGE' => $this->AGE,
            'BW' => $this->BW,
        ]);

        $query->andFilterWhere(['like', 'TBNUMBER', $this->TBNUMBER])
            ->andFilterWhere(['like', 'HMAIN', $this->HMAIN])
            ->andFilterWhere(['like', 'HN', $this->HN])
            ->andFilterWhere(['like', 'PRENAME', $this->PRENAME])
            ->andFilterWhere(['like', 'FNAME', $this->FNAME])
            ->andFilterWhere(['like', 'LNAME', $this->LNAME])
            ->andFilterWhere(['like', 'CID', $this->CID])
            ->andFilterWhere(['like', 'SEX', $this->SEX])
            ->andFilterWhere(['like', 'HNO', $this->HNO])
            ->andFilterWhere(['like', 'VILLAGE_ID', $this->VILLAGE_ID])
            ->andFilterWhere(['like', 'PHONE', $this->PHONE])
            ->andFilterWhere(['like', 'MEMO', $this->MEMO]);

        return $dataProvider;
    }
}
