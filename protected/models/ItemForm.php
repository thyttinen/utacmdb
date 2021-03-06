<?php

/**
 * Description of ItemForm
 * The class storing the information received from the actual html form in add_item.php
 *
 * $type is in serial id form, not as a string
 */
class ItemForm extends CFormModel {
    
    public $name;
    public $type;
    
    
    /* Constructor, saves type_id at the beginning of a page-load for later use */
    public function __construct() {
        
        // Get type id from GET, the page should reload when type is changed above
        // default is first (by name). Note: should be done more efficiently
        $types = Type::getAll();
        $this->type = $types[0]->id;
        if (isset($_GET['type'])) {
            $this->type = $_GET['type'];
        }
        
        
    }
    
    
    
    /* Form labels for attributes differing from the ones above, e.g. "Item Name" instead of "Name" */
    public function attributeLabels() {
        
    }
    
    
    
    /* Rules for form input 
     */
    public function rules() {
        
        $rules = array();
        $rules[] = array('name, type', 'required');
        
        return $rules;
    }
    
    /* Returns all available types in the database as an array with id and name pairings */
    public function getAvailableTypes() {
        $types = Type::getAll();
        $data = array();
        
        foreach ($types as $type) {
            $data[$type->id] = $type->name;
        }
        
        
        return $data;
    }
    
    /* Saves the item upon submitting the form
     * if $item_id is null, creates a new item
     */
    public function saveItem($item_id) {
        
        if (is_null($item_id)) {
            return Item::add($this->name, $this->type);
        }
        
        else {
            $item = Item::model()->findByPk($item_id);
            $item->name = $this->name;
            $item->save();
            return $item;
        }
    }
    
    
}

?>
