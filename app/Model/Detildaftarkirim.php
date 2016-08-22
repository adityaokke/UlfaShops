<?php 
class Detildaftarkirim extends AppModel {	
	public $useTable = "detildaftarkirims";
	public $belongsTo =array( 
			'Item'=>array(
            	'className' => 'Items',
            	'foreignKey' => 'item_id'
				),
			'Daftarkirim' => array(
				'className' => 'Daftarkirims',
				'foreignKey' => 'daftarkirim_id'
				)
		);
	
}

 ?>