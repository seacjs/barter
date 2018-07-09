<?php
namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email_confirm_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $online_at
 * @property string $password write-only password
 *
 * @property Profile $profile
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_NEW = 1;
    const STATUS_BLOCKED = 2;
    const STATUS_ACTIVE = 10;

    /**
     * Get user statuses as array
     *
     * @return array
     */
    public static function getStatusesArray()
    {
        return [
            self::STATUS_DELETED => 'Удаленный',
            self::STATUS_NEW => 'Новый',
            self::STATUS_BLOCKED => 'Заблокированый',
            self::STATUS_ACTIVE  => 'Активный',
        ];
    }

    public $sendEmailToUserWithData = false;
    public $role;

    /**
     * Get user roles throw authManager as array
     *
     * @return array
     */
    public static function getRolesArray()
    {
        $result = [];
        foreach(Yii::$app->authManager->getRoles() as $role)
        {
            $result[$role->name] = $role->description;
        }
        return $result;
    }

    /**
     * Get user child roles without current user role, throw authManager as array
     *
     * @return array
     */
    public static function getChildRolesArray()
    {
        $result = [];
        $userRoles = Yii::$app->authManager->getRolesByUser(Yii::$app->user->id);
        foreach($userRoles as $key => $value) {
            foreach (Yii::$app->authManager->getChildRoles($key) as $role) {
                if ($key !== $role->name) {
                    $result[$role->name] = $role->description;
                }
            }
        }
        return $result;
    }




    /**
     * Remove all roles and add $newRoleName
     *
     * @param string $newRoleName
     * */
    public function changeRole($newRoleName)
    {
        $auth = Yii::$app->authManager;
        $auth->removeAllRoles();
        $newRole = $auth->getRole($newRoleName);
        $auth->assign($newRole, $this->id);
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],

            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => array_keys(self::getStatusesArray())],

            [['sendEmailToUserWithData', 'role'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne([
            'username' => $username,
//            'status' => self::STATUS_ACTIVE
        ]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * Generates new email confirm token
     */
    public function generateEmailConfirmToken()
    {
        $this->email_confirm_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes email confirm token
     */
    public function removeEmailConfirmToken()
    {
        $this->email_confirm_token = null;
    }

    public static function findByEmailConfirmToken($token)
    {
        return static::findOne([
            'email_confirm_token' => $token,
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::class, ['user_id' => 'id']);
    }



    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes)
    {
        if($insert) {
            $profile = new Profile();
            $profile->user_id = $this->id;
            $profile->save();
        }

        parent::afterSave($insert, $changedAttributes);
    }
    /**
     * @inheritdoc
     */
    public function afterDelete()
    {
        Profile::deleteAll(['user_id' => $this->id]);
        parent::afterDelete();
    }

    /**
     * is current user is === current auth user
     * @return bool
     */
    public function getIsMe()
    {
        return $this->id === Yii::$app->user->id;
    }
    /**
     * is user online now
     * @return bool
     */
    public function getIsOnline()
    {
        return ($this->online_at > time() - (60 * 1000));
    }

}
