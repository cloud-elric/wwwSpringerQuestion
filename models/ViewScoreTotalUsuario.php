<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "view_score_total_usuario".
 *
 * @property string $id_usuario
 * @property string $txt_nombre_completo
 * @property double $num_puntuacion_usuario
 */
class ViewScoreTotalUsuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'view_score_total_usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_usuario'], 'integer'],
            [['num_puntuacion_usuario'], 'number'],
            [['txt_nombre_completo'], 'string', 'max' => 286],
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
            'num_puntuacion_usuario' => 'Num Puntuacion Usuario',
        ];
    }
}
