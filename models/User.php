<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $fullname
 * @property string $email
 * @property string $phone
 * @property string $role
 * @property integer $cityId
 * @property integer $year
 * @property string $authKey
 * @property integer $disabled
 *
 * @property Photo[] $photos
 * @property City $city
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role'], 'required'],
            [['cityId', 'year', 'disabled'], 'integer'],
            [['username', 'password', 'fullname', 'email', 'phone', 'role', 'authKey'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['phone'], 'unique'],
            [['email'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Логин',
            'password' => 'Пароль',
            'fullname' => 'Полное имя',
            'email' => 'Email',
            'phone' => 'Телефон',
            'role' => 'Роль',
            'cityId' => 'City ID',
            'year' => 'Год',
            'authKey' => 'Ключ авторизации',
            'disabled' => 'Активен?',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotos()
    {
        return $this->hasMany(Photo::className(), ['uploadUserId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'cityId']);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @param $credential
     * @return static
     */
    public static function findByCredential($credential)
    {
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new \LogicException('Not implemented');
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }

    /**
     * @param string $password
     * @return bool
     */
    public function validatePassword($password)
    {
        return true;
    }
}
