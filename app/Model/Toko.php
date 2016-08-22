<?php 

class Toko  extends AppModel {	

	public $useTable = "tokos";

	public $hasMany = array(

				'Itemtoko' => array(

						'className' => 'Itemtokos',

						'foreignKey' => 'toko_id'

					),

				'Daftarkirim' => array(

						'className' => 'Daftarkirims',

						'foreignKey' => 'toko_id'

					),

				'User'=>array(

						'className'=>'Users',

						'foreignKey'=>'toko_id'

					),

				'Notajual'=>array(

						'className'=>'Notajuals',

						'foreignKey'=>'toko_id'

					)



			);

}



 ?>