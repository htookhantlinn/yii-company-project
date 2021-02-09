<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $email
 * @property string|null $password
 * @property string|null $auth_key
 * @property string|null $access_token
 * @property string|null $role
 * @property string|null $created_at
 *
 * @property Company[] $companies
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at'], 'safe'],
            [['name', 'email', 'password', 'auth_key', 'access_token', 'role'], 'string', 'max' => 255],
            ['email','email'],
            [['name','email','password'],'required']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'auth_key' => 'Auth Key',
            'access_token' => 'Access Token',
            'role' => 'Role',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Companies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompanies()
    {
        return $this->hasMany(Company::className(), ['user' => 'id']);
    }

    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return self::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        $this->auth_key = $authKey;
    }

    public function validatePassword($password)
    {
        return password_verify($password, $this->password);
    }

    public function findByUsername($username)
    {
        return self::findOne(['name' => $username]);

    }
}
