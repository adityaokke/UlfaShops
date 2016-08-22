<?php
class Transbeli extends AppModel
{
	
	

	public $belongsTo = array(
 		'Notabeli'=>array(
 		'className'=> 'Notabeli',
 		'foreignKey'=> 'notabeli_id',
 		'counterCache' => true
 		),'Gudangs');

	

	public function test()
	{
		$this->virtualFields['nama'] = $this->Gudangs->virtualFields['nama'];
	}
	public function __construct($id = false, $table = null, $ds = null) {
    parent::__construct($id, $table, $ds);
    
	}
	//public $hasOne = array('Gudangs');
}


?>