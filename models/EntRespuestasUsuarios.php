<?php

namespace app\models;

use Yii;
use app\modules\ModUsuarios\models\EntUsuarios;

/**
 * This is the model class for table "ent_respuestas_usuarios".
 *
 * @property string $id_usuario
 * @property string $id_pregunta
 * @property string $id_modulo
 * @property string $id_respuesta
 *
 * @property ModUsuariosEntUsuarios $idUsuario
 * @property EntPreguntas $idPregunta
 * @property CatModulos $idModulo
 * @property EntRespuestas $idRespuesta
 */
class EntRespuestasUsuarios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ent_respuestas_usuarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_usuario', 'id_pregunta', 'id_modulo', 'id_respuesta'], 'required'],
            [['id_usuario', 'id_pregunta', 'id_modulo', 'id_respuesta'], 'integer'],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => EntUsuarios::className(), 'targetAttribute' => ['id_usuario' => 'id_usuario']],
            [['id_pregunta'], 'exist', 'skipOnError' => true, 'targetClass' => EntPreguntas::className(), 'targetAttribute' => ['id_pregunta' => 'id_pregunta']],
            [['id_modulo'], 'exist', 'skipOnError' => true, 'targetClass' => CatModulos::className(), 'targetAttribute' => ['id_modulo' => 'id_modulo']],
            [['id_respuesta'], 'exist', 'skipOnError' => true, 'targetClass' => EntRespuestas::className(), 'targetAttribute' => ['id_respuesta' => 'id_respuesta']],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario()
    {
        return $this->hasOne(ModUsuariosEntUsuarios::className(), ['id_usuario' => 'id_usuario']);
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
    public function getIdModulo()
    {
        return $this->hasOne(CatModulos::className(), ['id_modulo' => 'id_modulo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdRespuesta()
    {
        return $this->hasOne(EntRespuestas::className(), ['id_respuesta' => 'id_respuesta']);
    }
}
