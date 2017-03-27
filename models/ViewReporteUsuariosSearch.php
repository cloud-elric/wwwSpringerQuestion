<?php

namespace app\models;

use app\models\ViewReporteUsuarios;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * PersonalSearch represents the model behind the search form about `app\models\Personal`.
 */
class ViewReporteUsuariosSearch extends ViewReporteUsuarios
{
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
				[['id_usuario', 'b_emitio_certificado'], 'integer'],
				[['num_modulos_incompletos', 'num_modulos_completos', 'num_puntuacion_usuario'], 'number'],
				[['txt_nombre_completo'], 'string', 'max' => 286],
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
		$query = ViewReporteUsuarios::find();

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
				'id_usuario' => $this->id_usuario,
				'txt_nombre_completo' => $this->txt_nombre_completo,
				'num_modulos_incompletos' => $this->num_modulos_incompletos,
				'num_modulos_completos' => $this->num_modulos_completos,
				'num_puntuacion_usuario' => $this->num_puntuacion_usuario,
				'b_emitio_certificado' => $this->b_emitio_certificado,
		]);

		$query->andFilterWhere(['like', 'txt_nombre_completo', $this->txt_nombre_completo]);

		return $dataProvider;
	}
}

