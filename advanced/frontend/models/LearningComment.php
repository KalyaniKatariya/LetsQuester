<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "learning_comment".
 *
 * @property integer $id
 * @property integer $commenter_id
 * @property integer $module_id
 * @property string $comment
 * @property string $learning_status_before
 * @property string $learning_status_after
 *
 * @property Module $module
 * @property User $commenter
 */
class LearningComment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'learning_comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'commenter_id', 'module_id', 'comment', 'learning_status_before', 'learning_status_after'], 'required'],
            [['id', 'commenter_id', 'module_id'], 'integer'],
            [['comment', 'learning_status_before', 'learning_status_after'], 'string'],
            [['module_id'], 'exist', 'skipOnError' => true, 'targetClass' => Module::className(), 'targetAttribute' => ['module_id' => 'id']],
            [['commenter_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['commenter_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'commenter_id' => 'Commenter ID',
            'module_id' => 'Module ID',
            'comment' => 'Comment',
            'learning_status_before' => 'Learning Status Before',
            'learning_status_after' => 'Learning Status After',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModule()
    {
        return $this->hasOne(Module::className(), ['id' => 'module_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommenter()
    {
        return $this->hasOne(User::className(), ['id' => 'commenter_id']);
    }
}
