<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cat_codigos".
 *
 * @property string $id_codigo
 * @property string $txt_nombre
 * @property string $b_usado
 */
class CatCodigos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cat_codigos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['txt_nombre'], 'required'],
            [['b_usado'], 'integer'],
            [['txt_nombre'], 'string', 'max' => 50],
            [['txt_nombre'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_codigo' => 'Id Codigo',
            'txt_nombre' => 'Txt Nombre',
            'b_usado' => 'B Usado',
        ];
    }
}
