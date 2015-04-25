<?php
class Group extends RelationalDocument
{
    public $name;
    public $members;
    
    public function collectionName() {
        return 'groups';
    }
    
    public function relations() {
        return array(
            'users' => array('many', 'User', 'member_of', 'on' => 'stringId')
        );
    }
    
    public function getStringId() {
        return mongoId($this);
    }
    
    public static function model($cl = __CLASS__) {
        return parent::model($cl);
    }
    
    public function embeddedFields() {
        return array('name');
    }
    
}