<?php 

class Transjual  extends AppModel {	

	public $useTable = "transjuals";

	public $belongsTo = array(

				'Notajual'=>array(

            'className' => 'Notajuals',

            'foreignKey' => 'notajual_id'

					),

				'Itemtoko'

			);
}



 ?>