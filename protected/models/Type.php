<?php

class Type extends CActiveRecord {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public function relations() {
        return array(
          'items'=>array(self::HAS_MANY, 'item', 'type_id')
        );
    }

    public function tableName() {
        return 'type';
    }

}

?>