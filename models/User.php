<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string|null $phone
 * @property string|null $telegram
 * @property string $password
 * @property string|null $date
 * @property string|null $role
 * @property string|null $authKey
 * @property string|null $accessToken
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
    return 'users';
  }

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['username', 'email', 'password'], 'required'],
      [['username', 'email', 'phone', 'telegram', 'password', 'date', 'role', 'authKey', 'accessToken'], 'string', 'max' => 255],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels()
  {
    return [
      'id' => 'ID',
      'username' => 'Username',
      'email' => 'Email',
      'phone' => 'Phone',
      'telegram' => 'Telegram',
      'password' => 'Password',
      'date' => 'Date',
      'role' => 'Role',
      'authKey' => 'Auth Key',
      'accessToken' => 'Access Token',
    ];
  }

  public static function findIdentity($id)
  {
    return static::findOne($id);
  }

  public function validatePassword($password)
  {
    return Yii::$app->getSecurity()->validatePassword($password, $this->password);
  }

  public function validateAuthKey($authKey)
  {
    return $this->authKey === $authKey;
  }

  public function getAuthKey()
  {
    return $this->authKey;
  }
  public function getId()
  {
    return $this->id;
  }

  public static function findByPhone($phone)
  {
    return static::findOne(['phone' => $phone]);
  }

  public static function findByUsername($username)
  {
    return static::findOne(['username' => $username]);
  }

  public static function findIdentityByAccessToken($token, $type = null)
  {
    return static::find()->where(['id' => (string) $token->getClaim('uid')])->one();
  }
}
