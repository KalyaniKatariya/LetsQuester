<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                /* modified error message based on membership status */
                $status = User::getStatus($this->username);
                if("pending"==$status){    
                    $this->addError($attribute, 'Membership approval pending, please try later.');
                 }
                 elseif("suspended"==$status){
                        $this->addError($attribute, 'Account suspended.Please contact site admin.');
                 }
                 elseif("deleted"==$status){
                        $this->addError($attribute, 'Account removed.Please contact site admin.');
                 }
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            $status = User::getStatus($this->username);
            if("pending"==$status){

                Yii::$app->session->addFlash('info', 
                    '<large><b>Approval Pending</b></large><br/>Your membership has been submitted for approval 
                    by core team member. It <b>should be approved within 48 hours</b> from signup. 
                    <br> (In case if you are in hurry, 
                    feel free to call core team member for prompt approval.) ');
                
            } elseif("suspended"==$status){

                Yii::$app->session->addFlash('warning', 
                    '<b>Membership suspended</b><br/> 
                    Your membership has been suspended. 
                    Please contact  core team member for further details.');

            } elseif("deleted"==$status){
                
                Yii::$app->session->addFlash('danger', 
                    '<b>Membership removed</b><br/>
                    Your membership has been removed. 
                    Please contact core team member for further details.');
            }             
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
