<?php
namespace app\models;
use yii\base\Model;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * Signup form
 */
class AuthenForm extends Model
{
    public $authname;
   
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           
            ['authname', 'string', 'max' => 255],
       
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'authname' => 'สิทธิ์การใช้งาน',       
        ];
    }
     public static function itemsAlias($key){

    $items = [
              'authname' => [
                  'admin' => 'admin',
                  'manager' => 'manager',
                  'member' => 'member'
              ],
          ];
        return ArrayHelper::getValue($items, $key, []);
    }
    
    public function getItemAuthname()
    {
      return self::itemsAlias('authname');
    }
}