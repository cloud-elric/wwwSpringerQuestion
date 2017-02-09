<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ent_preguntas".
 *
 * @property string $id_pregunta
 * @property string $id_modulo
 * @property string $txt_descripcion
 * @property string $txt_pregunta
 * @property string $b_habilitado
 *
 * @property CatModulos $idModulo
 * @property EntRespuestas[] $entRespuestas
 */
class EntPreguntas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ent_preguntas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_modulo', 'txt_descripcion'], 'required'],
            [['id_modulo', 'b_habilitado'], 'integer'],
            [['txt_descripcion', 'txt_pregunta'], 'string'],
            [['id_modulo'], 'exist', 'skipOnError' => true, 'targetClass' => CatModulos::className(), 'targetAttribute' => ['id_modulo' => 'id_modulo']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_pregunta' => 'Id Pregunta',
            'id_modulo' => 'Id Modulo',
            'txt_descripcion' => 'Txt Descripcion',
            'txt_pregunta' => 'Txt Pregunta',
            'b_habilitado' => 'B Habilitado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdModulo()
    {
        return $this->hasOne(CatModulos::className(), ['id_modulo' => 'id_modulo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntRespuestas()
    {
        return $this->hasMany(EntRespuestas::className(), ['id_pregunta' => 'id_pregunta']);
    }
}
