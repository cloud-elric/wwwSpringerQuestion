<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "view_score_modulo_usuario".
 *
 * @property string $id_usuario
 * @property string $txt_nombre_completo
 * @property string $id_modulo
 * @property double $num_puntuacion_usuario
 * @property string $num_preguntas
 * @property string $num_preguntas_correctas
 * @property integer $b_modulo_completado
 * @property string $txt_nombre
 */
class ViewScoreModuloUsuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'view_score_modulo_usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_usuario', 'id_modulo', 'num_preguntas', 'num_preguntas_correctas', 'b_modulo_completado'], 'integer'],
            [['num_puntuacion_usuario'], 'number'],
            [['txt_nombre'], 'required'],
            [['txt_nombre_completo'], 'string', 'max' => 286],
            [['txt_nombre'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_usuario' => 'Id Usuario',
            'txt_nombre_completo' => 'Txt Nombre Completo',
            'id_modulo' => 'Id Modulo',
            'num_puntuacion_usuario' => 'Num Puntuacion Usuario',
            'num_preguntas' => 'Num Preguntas',
            'num_preguntas_correctas' => 'Num Preguntas Correctas',
            'b_modulo_completado' => 'B Modulo Completado',
            'txt_nombre' => 'Txt Nombre',
        ];
    }
}
