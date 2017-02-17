<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rel_usuario_modulos".
 *
 * @property string $id_usuario
 * @property string $id_modulo
 *
 * @property ModUsuariosEntUsuarios $idUsuario
 * @property CatModulos $idModulo
 */
class RelUsuarioModulos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rel_usuario_modulos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_usuario', 'id_modulo'], 'required'],
            [['id_usuario', 'id_modulo'], 'integer'],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => ModUsuariosEntUsuarios::className(), 'targetAttribute' => ['id_usuario' => 'id_usuario']],
            [['id_modulo'], 'exist', 'skipOnError' => true, 'targetClass' => CatModulos::className(), 'targetAttribute' => ['id_modulo' => 'id_modulo']],
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
    public function getIdModulo()
    {
        return $this->hasOne(CatModulos::className(), ['id_modulo' => 'id_modulo']);
    }
}
