<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rel_usuarios_codigos".
 *
 * @property string $id_usuario
 * @property string $id_codigo
 *
 * @property CatCodigos $idCodigo
 * @property ModUsuariosEntUsuarios $idUsuario
 */
class RelUsuariosCodigos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rel_usuarios_codigos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_usuario', 'id_codigo'], 'required'],
            [['id_usuario', 'id_codigo'], 'integer'],
            [['id_codigo'], 'exist', 'skipOnError' => true, 'targetClass' => CatCodigos::className(), 'targetAttribute' => ['id_codigo' => 'id_codigo']],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => ModUsuariosEntUsuarios::className(), 'targetAttribute' => ['id_usuario' => 'id_usuario']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_usuario' => 'Id Usuario',
            'id_codigo' => 'Id Codigo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCodigo()
    {
        return $this->hasOne(CatCodigos::className(), ['id_codigo' => 'id_codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario()
    {
        return $this->hasOne(ModUsuariosEntUsuarios::className(), ['id_usuario' => 'id_usuario']);
    }
}
