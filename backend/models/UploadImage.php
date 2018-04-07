<?php
namespace backend\models;
use yii\base\Model;
use backend\models\DataRun;
use Yii;


class UploadImage extends Model {
    public $image;
    public $id;
    public $sql;
    public function rules() {
     return [
        [['image'], 'file', 'skipOnEmpty' => false, 'extensions' => 'jpg, png'],
     ];
    }
    public function upload($file_name,$id) {
        if ($this->validate()) {
            $this->image->saveAs(Yii::getAlias('@app') . "/../uploads/" . $file_name . '.' . $this->image->extension);
            
            $this->sql = new DataRun();
            $this->sql->SaveFileName($file_name . '.' . $this->image->extension,$id);

            return true;
        } else {
            return false;
        }
    }
    
    public function attributeLabels(){
        return [
            'image'=>'Chụp hình sản phẩm'
        ];
    }
}