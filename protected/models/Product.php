<?php
class Product extends RelationalDocument {
    
    public $title;
    public $ean;
    public $description;
    public $create_date;
    
    public function collectionName() {
        return 'products';
    }
    
    public static function model($cl = __CLASS__) {
        return parent::model($cl);
    }
    
    public function embeddedFields() {
        return array('ean', 'title');
    }
    
    public function relations() {
        return array(
            'copies' => array('many', 'Copy', 'product_ref.$id', 'embedded' => true)
        );
    }   
    
}   
