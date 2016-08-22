<?php 
class Itemtoko extends AppModel {	
	public $useTable = "itemtokos";
	public $hasMany = array(
					'Transjual'=> array(
					),
					'Hargaunit'=> array(
						'className' => 'Hargaunits',
						'foreignKey' => 'itemtoko_id',
            			'dependent' => true
					)
	);
	public $belongsTo = array(
				'Toko'=> array(
						'className' => 'Tokos',
						'foreignKey' => 'toko_id'
					),
				'Item' => array(
					)
			);
}

 ?>