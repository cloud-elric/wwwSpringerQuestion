<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "view_usuario_respuesta".
 *
 * @property string $id_usuario
 * @property string $id_pregunta
 * @property string $id_modulo
 * @property string $id_respuesta
 * @property string $b_correcto
 */
class ViewUsuarioRespuesta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'view_usuario_respuesta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_usuario', 'id_pregunta', 'id_modulo', 'id_respuesta'], 'required'],
            [['id_usuario', 'id_pregunta', 'id_modulo', 'id_respuesta', 'b_correcto'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_usuario' => 'Id Usuario',
            'id_pregunta' => 'Id Pregunta',
            'id_modulo' => 'Id Modulo',
            'id_respuesta' => 'Id Respuesta',
            'b_correcto' => 'B Correcto',
        ];
    }
}
