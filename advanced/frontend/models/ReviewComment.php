<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "review_comment".
 *
 * @property integer $id
 * @property integer $commenter_id
 * @property integer $module_id
 * @property string $comment
 * @property string $review_status_before
 * @property string $review_status_after
 *
 * @property Module $module
 * @property User $commenter
 */
class ReviewComment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'review_comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['commenter_id', 'module_id', 'comment'], 'required'],
            [['commenter_id', 'module_id'], 'integer'],
            [['comment', 'review_status_before', 'review_status_after'], 'string'],
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
            'review_status_before' => 'Review Status Before',
            'review_status_after' => 'Review Status After',
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
