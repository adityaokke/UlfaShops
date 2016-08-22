<?php 
class Daftarkirims  extends AppModel {	
	public $useTable = "daftarkirims";
	public $belongsTo = array(				
				'Toko'=>array(
            'className' => 'Tokos',
            'foreignKey' => 'toko_id'
					)
			);
	public $hasMany = array(
				'Detildaftarkirim' => array(
						'className' => 'Detildaftarkirims',
						'foreignKey' => 'daftarkirim_id',
            'dependent' => true
					)
			);
}

 ?>