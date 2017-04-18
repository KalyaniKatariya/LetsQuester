<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "learning".
 *
 * @property integer $id
 * @property integer $learner_id
 * @property integer $module_id
 * @property string $status
 *
 * @property Module $module
 * @property User $learner
 */
class Learning extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'learning';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['learner_id', 'module_id', 'status'], 'required'],
            [['learner_id', 'module_id'], 'integer'],
            [['status'], 'string'],
            [['module_id'], 'exist', 'skipOnError' => true, 'targetClass' => Module::className(), 'targetAttribute' => ['module_id' => 'id']],
            [['learner_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['learner_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'learner_id' => 'Learner ID',
            'module_id' => 'Module ID',
            'status' => 'Status',
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
    public function getLearner()
    {
        return $this->hasOne(User::className(), ['id' => 'learner_id']);
    }
}
