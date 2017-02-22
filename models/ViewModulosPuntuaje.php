<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "view_modulos_puntuaje".
 *
 * @property string $id_modulo
 * @property string $txt_nombre
 * @property double $num_puntuacion
 */
class ViewModulosPuntuaje extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'view_modulos_puntuaje';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_modulo'], 'integer'],
            [['txt_nombre'], 'required'],
            [['num_puntuacion'], 'number'],
            [['txt_nombre'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_modulo' => 'Id Modulo',
            'txt_nombre' => 'Txt Nombre',
            'num_puntuacion' => 'Num Puntuacion',
        ];
    }
}
