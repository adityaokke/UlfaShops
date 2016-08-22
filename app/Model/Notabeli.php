<?php

class Notabeli extends AppModel
{
		
		
		public $hasMany = array(
		    'Transbeli' => array(
		        'className' => 'Transbeli',
		        'foreignKey' => 'Notabeli_id',
		        'dependent' => true
		    )
		);
		//var $hasOne = array('Penyedia');
		var $belongsTo = array('Penyedia');
		
		/*var $belongsTo = array(
		   'Supplier' => array(
		   'className' => 'Supplier',
		   'foreignKey'=> 'supplier_id'
		    )
		 );*/
}
?>