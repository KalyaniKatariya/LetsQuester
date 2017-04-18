<?php

namespace frontend\models;


use Yii;

/**
 * This is the model class for table "module".
 *
 * @property integer $id
 * @property integer $owner_id
 * @property string $name
 * @property string $description
 * @property string $status
 * @property string $review_status
 * @property integer $reviewer_id
 *
 * @property User $reviewer
 * @property User $owner
 */
class Module extends \yii\db\ActiveRecord
{
    public $reviewComment;
    public $reviewComments;
    public $enquirySpecialistsList;
    public $statusList;
    public $moduleIdList;
    public $learnerOne;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'module';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['owner_id', 'name', 'description', 'status'], 'required'],
            [['owner_id', 'reviewer_id'], 'integer'],
            [['description', 'status', 'review_status','reviewComment',], 'string'],
            [['name'], 'string', 'max' => 255],
             [['owner_id', 'reviewer_id','age_group'], 'integer'], //updated by kalyani - age group field
            [['status', 'review_status','reviewComment', 'outcome','mode_of_inquiry'], 'string'], //updated by kalyani removed desription field from string rule outcome and 'mode_of_inquiry' added
           
            [['reviewer_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['reviewer_id' => 'id']],
            [['owner_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['owner_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Module ID',
            'owner_id' => 'Owner ID',
            'name' => 'Module Name',
            'description' => 'Module Description',
            'status' => 'Status',
            'review_status' => 'Review Status',
            'reviewer_id' => 'Reviewer ID',
            'reviewComment' => 'Module owner\'s comment',
            'outcome'=> 'Outcome Expected From this Module',//added by kalyani
            'mode_of_inquiry' => 'Mode Of Inquiry', //added by kalyani
            'age_group' => 'Age Group', //added by kalyani
            'intro_txt' => 'Introduction Text', //added by kalyani
            'add_vid_img' => 'Add video/Image as a paert of Introduction', //added by kalyani

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviewer()
    {
        return $this->hasOne(User::className(), ['id' => 'reviewer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne(User::className(), ['id' => 'owner_id']);
    }

}
