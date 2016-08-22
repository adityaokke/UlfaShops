<?php 
App::uses('AppModel', 'Model');
class Notajual extends AppModel {	

	//public $useTable = 'notajuals';
	var $name='Notajual';
	public $hasMany = array(

				'Transjual' => array(

				'className' => 'Transjuals',

				'foreignKey' => 'notajual_id',

            	'dependent' => true

					)

			);
	
	public $belongsTo = array(
					
					'User' => array(
						'className'=>'Users',
						'foreignKey'=>'user_id'
					),

					'Toko' =>array(

						'className'=>'Tokos',

						'foreignKey'=>'toko_id'

					)

		);

	
	

}

?>