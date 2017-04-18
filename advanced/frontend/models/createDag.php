<?php
namespace app\models;

namespace frontend\models;

use Yii;
use yii\base\Model;


 
/*class  aboutPage extends \kartik\tree\models\Tree
{
    /**
     * @inheritdoc
     
    public static function tableName()
    {
        return 'tbl_tree';
    }    
    
    *
     * Override isDisabled method if you need as shown in the  
     * example below. You can override similarly other methods
     * like isActive, isMovable etc.
     
   /* public function isDisabled()
    {
        if (Yii::$app->user->username !== 'admin') {
            return true;
        }
        return parent::isDisabled();
    }
}
*/
 

 
class createDag extends \yii\db\ActiveRecord
{
    use \kartik\tree\models\TreeTrait {
        isDisabled as parentIsDisabled; // note the alias
    }
 
    /**
     * @var string the classname for the TreeQuery that implements the NestedSetQueryBehavior.
     * If not set this will default to `kartik  ree\models\TreeQuery`.
     */
    public static $treeQueryClass; // change if you need to set your own TreeQuery
 
    /**
     * @var bool whether to HTML encode the tree node names. Defaults to `true`.
     */
    public $encodeNodeNames = true;
 
    /**
     * @var bool whether to HTML purify the tree node icon content before saving.
     * Defaults to `true`.
     */
    public $purifyNodeIcons = true;
 
    /**
     * @var array activation errors for the node
     */
    public $nodeActivationErrors = [];
 
    /**
     * @var array node removal errors
     */
    public $nodeRemovalErrors = [];
 
    /**
     * @var bool attribute to cache the `active` state before a model update. Defaults to `true`.
     */
    public $activeOrig = true;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tree';
    }
    
    /**
     * Note overriding isDisabled method is slightly different when
     * using the trait. It uses the alias.
     */
   // public function isDisabled()
   // {
   //     if (Yii::$app->user->username !== 'admin') {
   //         return true;
   //     }
   //     return $this->parentIsDisabled();
   // }
}
/**
 * Signup form
 */
