<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $name
 * @property string $surname
 * @property AuthAssignment[] $roles
 * @property string $email
 * @property string $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends \yii\db\ActiveRecord
{
    public $authRolesAll;
    public $authRolesAssigned;
    public $rolesSummary;

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
            [
                [
                    'username', 'auth_key', 'password_hash', 
                    'email', 
                    //'name','surname',
                    'created_at', 'updated_at',
                    //'authRolesAll', 'authRolesAssigned'
                ], 
                'required'
            ],
            [['created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'name','surname','email','status'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'name' => 'Name',
            'surname' => 'Surname',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'authRolesAssigned' => 'Roles Assigned'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoles()
    {        
        return $this->hasMany(AuthAssignment::className(), ['user_id' => 'id']);
    }
}
