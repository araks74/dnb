<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "photo".
 *
 * @property integer $id
 * @property integer $year
 * @property string $filename
 * @property integer $uploadUserId
 * @property integer $schoolId
 * @property integer $type
 * @property string $class
 * @property integer $state
 * @property string $name
 * @property string $surname
 * @property string $profession
 * @property integer $agree_wall
 * @property integer $width
 * @property integer $height
 *
 * @property School $school
 * @property User $uploadUser
 */
class Photo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'photo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['year', 'uploadUserId', 'schoolId', 'type', 'state', 'agree_wall', 'width', 'height'], 'integer'],
            [['schoolId'], 'required'],
            [['filename', 'class', 'name', 'surname', 'profession'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'year' => 'Год',
            'filename' => 'Имя файла',
            'uploadUserId' => 'Id загрузившего',
            'schoolId' => 'School ID',
            'type' => 'Тип',
            'class' => 'Класс (буква или цифра)',
            'state' => 'Состояние',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'profession' => 'Профессия',
            'agree_wall' => 'Согласие на печать на баннере',
            'width' => 'Ширина',
            'height' => 'Высота',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchool()
    {
        return $this->hasOne(School::className(), ['id' => 'schoolId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUploadUser()
    {
        return $this->hasOne(User::className(), ['id' => 'uploadUserId']);
    }
}
