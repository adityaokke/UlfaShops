<?php 

class Unit  extends AppModel {	

	public $useTable = "units";

	public $hasMany = array(

				'Hargaunit' => array(


            			'dependent' => true

					)

			);

}



 ?>