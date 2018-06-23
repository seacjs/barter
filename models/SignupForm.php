<?php
namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $repeatPassword;
    public $confirmTerms = false;

    public $complited = false;

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

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

//            ['repeatPassword', 'required'],
//            ['repeatPassword', 'string'],

            ['confirmTerms', 'boolean'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
//        $user->generateEmailConfirmToken();

        if($user->save()) {
            $this->complited = true;
            $auth = Yii::$app->authManager;
            $userRole = $auth->getRole('user');
            $auth->assign($userRole, $user->getId());

            $this->sendEmailConfirmationCode($user);
            
            Yii::$app->session->addFlash('reg', 'Вы зарегистрированы, на ваш email отправлено письмо для подтверждения регистрации.');
            return $user;
        }
        
        return null;
    }

    /**
     * Send email confirmation code
     *
     */
    public function sendEmailConfirmationCode($user)
    {

//        Yii::$app->mailer->compose(['html' => '@app/mail/emailConfirm'], ['user' => $user])
//            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
//            ->setTo($this->email)
//            ->setSubject(Yii::t('app','Email confirmation for ') . Yii::$app->name)
//            ->send();

    }

    /**
     *
     * TODO::ADD Event AfterSignUp, and send confirmation email
     *
     * */
}
