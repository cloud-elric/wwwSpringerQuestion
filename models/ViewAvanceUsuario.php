<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "view_avance_usuario".
 *
 * @property string $id_usuario
 * @property string $id_modulo
 * @property string $num_preguntas
 * @property string $num_preguntas_faltantes
 * @property integer $b_modulo_completado
 */
class ViewAvanceUsuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'view_avance_usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_usuario', 'id_modulo'], 'required'],
            [['id_usuario', 'id_modulo', 'num_preguntas', 'num_preguntas_faltantes', 'b_modulo_completado'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_usuario' => 'Id Usuario',
            'id_modulo' => 'Id Modulo',
            'num_preguntas' => 'Num Preguntas',
            'num_preguntas_faltantes' => 'Num Preguntas Faltantes',
            'b_modulo_completado' => 'B Modulo Completado',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdModulo()
    {
    	return $this->hasOne(CatModulos::className(), ['id_modulo' => 'id_modulo']);
    }
}
