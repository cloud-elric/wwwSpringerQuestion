<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "view_reporte_usuarios".
 *
 * @property string $id_usuario
 * @property string $txt_nombre_completo
 * @property string $num_modulos_incompletos
 * @property string $num_modulos_completos
 * @property double $num_puntuacion_usuario
 * @property string $b_emitio_certificado
 */
class ViewReporteUsuarios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'view_reporte_usuarios';
    }

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
    public function attributeLabels()
    {
        return [
            'id_usuario' => 'Id Usuario',
            'txt_nombre_completo' => 'Txt Nombre Completo',
            'num_modulos_incompletos' => 'Num Modulos Incompletos',
            'num_modulos_completos' => 'Num Modulos Completos',
            'num_puntuacion_usuario' => 'Num Puntuacion Usuario',
            'b_emitio_certificado' => 'B Emitio Certificado',
        ];
    }
    
   
}
