<?php
   namespace frontend\models;
   use yii\base\Model;

use Yii;
   class UploadImageForm extends Model {
      public $image;
      public function rules() {
         return [
            [['image'], 'file', 'skipOnEmpty' => false, 'extensions' => 'jpg, png'],
         ];
      }
      public function upload($file_name) {
         if ($this->validate()) {
             $this->image->saveAs(Yii::getAlias('@app') . "/../uploads/" . $file_name . '.' . $this->image->extension);
            return true;
         } else {
            return false;
         }
      }
   }
?>