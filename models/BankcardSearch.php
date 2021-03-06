<?php

namespace yuncms\wallet\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * BankCardSearch represents the model behind the search form about `yuncms\user\models\BankCard`.
 */
class BankcardSearch extends Bankcard
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at'], 'integer'],
            [['bank', 'city', 'username', 'name', 'number'], 'safe'],
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
        $query = Bankcard::find()->where(['user_id' => Yii::$app->user->id]);

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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'bank', $this->bank])
            ->andFilterWhere(['like', 'bank_city', $this->city])
            ->andFilterWhere(['like', 'bank_username', $this->username])
            ->andFilterWhere(['like', 'bank_name', $this->name])
            ->andFilterWhere(['like', 'bankcard_number', $this->number]);

        return $dataProvider;
    }
}
