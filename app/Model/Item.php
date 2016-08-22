<?php

 class Item extends AppModel

 {

 	public $useTable = "items";

 	public $belongsTo = array(

 		'Kategori'=>array(

 		'className'=> 'Kategoris',

 		'foreignKey'=> 'kategori_id'

 		));

 	public $hasOne = array(

 		'Gudangs'=>array(

 		'dependent' => true,

 		'className'=> 'Gudangs',

 		'foreignKey'=> 'item_id'

 		 ));

 	public $hasMany=array(

 		'Itemtoko'

 		);


 }

?>