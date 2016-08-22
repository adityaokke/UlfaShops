<?php 
App::uses('AppModel', 'Model');
class Hargaunit extends AppModel {	

	public $useTable = "hargaunits";

	public $belongsTo = array(

				'Unit'=>array(

						'className' => 'Units',

						'foreignKey' => 'unit_id',

            

					),

					'Itemtoko'=>array(

						'className' => 'Itemtokos',

						'foreignKey' => 'itemtoko_id',

            

					)

			);

}



 ?>