<?php
class Gudangs extends AppModel
{
	
	public $belongsTo = array('Item'=>array(
 		'className'=> 'Items',
 		'foreignKey'=> 'item_id'
 		));
	
	public $hasMany = array(
 		'Laporanbarangs'=>array(
 		'className'=> 'Laporanbarangs',
 		'foreignKey'=> 'Gudangs_id'
 		),'Transbeli'=>array(
 		'className'=>'Transbeli',
 		'foreignKey'=>'Gudangs_id')
 		);
	

    public function __construct($id = false, $table = null, $ds = null) {
    $this->virtualFields['nama'] = 'SELECT nama FROM items where id = Gudangs.item_id';
    parent::__construct($id, $table, $ds);
	}
    
   
    
    



}

?>