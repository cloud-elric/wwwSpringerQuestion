<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cat_modulos".
 *
 * @property string $id_modulo
 * @property string $txt_nombre
 * @property string $txt_descripcion
 * @property string $b_habilitado
 *
 * @property EntPreguntas[] $entPreguntas
 * @property EntRespuestas[] $entRespuestas
 * @property EntRespuestasUsuarios[] $entRespuestasUsuarios
 */
class CatModulos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cat_modulos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['txt_nombre'], 'required'],
            [['txt_descripcion'], 'string'],
            [['b_habilitado'], 'integer'],
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
            'txt_descripcion' => 'Txt Descripcion',
            'b_habilitado' => 'B Habilitado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntPreguntas()
    {
        return $this->hasMany(EntPreguntas::className(), ['id_modulo' => 'id_modulo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntRespuestas()
    {
        return $this->hasMany(EntRespuestas::className(), ['id_modulo' => 'id_modulo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntRespuestasUsuarios()
    {
        return $this->hasMany(EntRespuestasUsuarios::className(), ['id_modulo' => 'id_modulo']);
    }
}
