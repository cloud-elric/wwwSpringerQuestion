<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mod_usuarios_ent_usuarios".
 *
 * @property string $id_usuario
 * @property string $id_tipo_usuario
 * @property string $txt_token
 * @property string $txt_username
 * @property string $txt_apellido_paterno
 * @property string $txt_apellido_materno
 * @property string $txt_auth_key
 * @property string $txt_password_hash
 * @property string $txt_password_reset_token
 * @property string $txt_email
 * @property string $fch_creacion
 * @property string $fch_actualizacion
 * @property string $id_status
 *
 * @property EntRespuestasUsuarios[] $entRespuestasUsuarios
 * @property ModUsuariosEntSesiones[] $modUsuariosEntSesiones
 * @property ModUsuariosCatStatusUsuarios $idStatus
 * @property ModUsuariosCatTipoUsuarios $idTipoUsuario
 * @property ModUsuariosEntUsuariosActivacion[] $modUsuariosEntUsuariosActivacions
 * @property ModUsuariosEntUsuariosCambioPass[] $modUsuariosEntUsuariosCambioPasses
 * @property ModUsuariosEntUsuariosFacebook $modUsuariosEntUsuariosFacebook
 * @property RelUsuarioModulos[] $relUsuarioModulos
 */
class ModUsuariosEntUsuarios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mod_usuarios_ent_usuarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_tipo_usuario', 'id_status'], 'integer'],
            [['txt_username', 'txt_auth_key', 'txt_password_hash', 'txt_email'], 'required'],
            [['fch_creacion', 'fch_actualizacion'], 'safe'],
            [['txt_token'], 'string', 'max' => 100],
            [['txt_username', 'txt_password_hash', 'txt_password_reset_token', 'txt_email'], 'string', 'max' => 255],
            [['txt_apellido_paterno', 'txt_apellido_materno'], 'string', 'max' => 30],
            [['txt_auth_key'], 'string', 'max' => 32],
            [['txt_email'], 'unique'],
            [['txt_token'], 'unique'],
            [['txt_password_reset_token'], 'unique'],
            [['id_status'], 'exist', 'skipOnError' => true, 'targetClass' => ModUsuariosCatStatusUsuarios::className(), 'targetAttribute' => ['id_status' => 'id_status']],
            [['id_tipo_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => ModUsuariosCatTipoUsuarios::className(), 'targetAttribute' => ['id_tipo_usuario' => 'id_tipo_usuario']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_usuario' => 'Id Usuario',
            'id_tipo_usuario' => 'Id Tipo Usuario',
            'txt_token' => 'Txt Token',
            'txt_username' => 'Txt Username',
            'txt_apellido_paterno' => 'Txt Apellido Paterno',
            'txt_apellido_materno' => 'Txt Apellido Materno',
            'txt_auth_key' => 'Txt Auth Key',
            'txt_password_hash' => 'Txt Password Hash',
            'txt_password_reset_token' => 'Txt Password Reset Token',
            'txt_email' => 'Txt Email',
            'fch_creacion' => 'Fch Creacion',
            'fch_actualizacion' => 'Fch Actualizacion',
            'id_status' => 'Id Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntRespuestasUsuarios()
    {
        return $this->hasMany(EntRespuestasUsuarios::className(), ['id_usuario' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModUsuariosEntSesiones()
    {
        return $this->hasMany(ModUsuariosEntSesiones::className(), ['id_usuario' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdStatus()
    {
        return $this->hasOne(ModUsuariosCatStatusUsuarios::className(), ['id_status' => 'id_status']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTipoUsuario()
    {
        return $this->hasOne(ModUsuariosCatTipoUsuarios::className(), ['id_tipo_usuario' => 'id_tipo_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModUsuariosEntUsuariosActivacions()
    {
        return $this->hasMany(ModUsuariosEntUsuariosActivacion::className(), ['id_usuario' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModUsuariosEntUsuariosCambioPasses()
    {
        return $this->hasMany(ModUsuariosEntUsuariosCambioPass::className(), ['id_usuario' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModUsuariosEntUsuariosFacebook()
    {
        return $this->hasOne(ModUsuariosEntUsuariosFacebook::className(), ['id_usuario' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRelUsuarioModulos()
    {
        return $this->hasMany(RelUsuarioModulos::className(), ['id_usuario' => 'id_usuario']);
    }
}
