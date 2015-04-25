<?php
class User extends RelationalDocument
{
    public $name;
    
    public $nid;
    
    public $sub;
    
    public function collectionName() {
        return 'users';
    }
    
    public function relations() {
        return array(
            'copies' => array('many', 'Copy', 'owner_ref.$id', 'embedded' => true, 'embedded_relation' => 'owner')
        );
    }
    
    public static function model($cl = __CLASS__) {
        return parent::model($cl);
    }
    
    public function embeddedFields() {
        return array('name', 'nid');
    }
    
}