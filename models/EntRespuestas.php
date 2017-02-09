<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ent_respuestas".
 *
 * @property string $id_respuesta
 * @property string $id_pregunta
 * @property string $id_modulo
 * @property string $txt_letra
 * @property string $txt_respuesta
 * @property string $txt_justificacion
 * @property string $txt_lectura_sugerida
 * @property string $b_correcto
 *
 * @property CatModulos $idModulo
 * @property EntPreguntas $idPregunta
 * @property EntRespuestasUsuarios[] $entRespuestasUsuarios
 */
class EntRespuestas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ent_respuestas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_pregunta', 'id_modulo', 'txt_letra', 'txt_respuesta'], 'required'],
            [['id_pregunta', 'id_modulo', 'b_correcto'], 'integer'],
            [['txt_justificacion', 'txt_lectura_sugerida'], 'string'],
            [['txt_letra'], 'string', 'max' => 10],
            [['txt_respuesta'], 'string', 'max' => 200],
            [['id_modulo'], 'exist', 'skipOnError' => true, 'targetClass' => CatModulos::className(), 'targetAttribute' => ['id_modulo' => 'id_modulo']],
            [['id_pregunta'], 'exist', 'skipOnError' => true, 'targetClass' => EntPreguntas::className(), 'targetAttribute' => ['id_pregunta' => 'id_pregunta']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_respuesta' => 'Id Respuesta',
            'id_pregunta' => 'Id Pregunta',
            'id_modulo' => 'Id Modulo',
            'txt_letra' => 'Txt Letra',
            'txt_respuesta' => 'Txt Respuesta',
            'txt_justificacion' => 'Txt Justificacion',
            'txt_lectura_sugerida' => 'Txt Lectura Sugerida',
            'b_correcto' => 'B Correcto',
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
    public function getIdPregunta()
    {
        return $this->hasOne(EntPreguntas::className(), ['id_pregunta' => 'id_pregunta']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntRespuestasUsuarios()
    {
        return $this->hasMany(EntRespuestasUsuarios::className(), ['id_respuesta' => 'id_respuesta']);
    }
}
