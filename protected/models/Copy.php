<?php
class Copy extends RelationalDocument {
    
    public $ean;
    public $create_date;
    public $last_updated;
    
    public static function model($cl = __CLASS__) {
        return parent::model($cl);
    }
    
    public function collectionName() {
        return 'copies';
    }
    
    public function relations() {
        return array(
            'owner' => array('one', 'User', '_id', 'on' => 'owner_ref', 'embed' => true),
            'product' => array('one', 'Product', '_id', 'on' => 'product_ref', 'embed' => true)
        );
    }
    
    public function beforeSave() {
        if($this->isNewRecord) {
            $this->create_date = new MongoDate();
        }
        $this->last_updated = new MongoDate();
        
        return parent::beforeSave();
    }
    
    public function rules() {
        return array(
            array('ean', 'required'),
            
            array('owner, product', 'isReference')
        );
    }
    
}   
