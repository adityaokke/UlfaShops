

<?php	

	 echo	$this->Form->create('Post',array('url'=>'/Item/tambah','enctype'=>'multipart/form-data','class'=>'form-group'));	

	 echo	$this->Form->input('Item.id',array('id'=>'posttitle','label'	=>'Judul:','style'=>'width:	100%;'));	

	 echo   $this->Form->input('Item.nama',array('id'=>'postcontent','label'=>'nama','class'=>'focusme form-control'));

	 echo	$this->Form->input('Item.kodebarang',array('id'=>'postcontent','label'=>'kode barang','class'=>'form-control'));

	 

	 echo   $this->Form->input('Item.kategori_id',array('type'=>'select','options' => $namaKategori,'id'=>'PostCategoryId','class'=>'form-control'));

	 echo   $this->Form->input('Item.kategori_id',array('type'=>'select','options' => $namasubKategori,'id'=>'PostSubcategoryId','class'=>'form-control'));

	 echo $this->Form->input('photo', array(

						'label' => 'Foto Item:',

						'type' => 'file','class'=>'form-control'

	));	

	echo $this->Form->end(	array('label'	=>	'Submit	Item')	);	



	/* echo $this->Form->create('Post',array('url'=>'/Kategori/getByCategory'));

	  echo   $this->Form->input('Item.kategori_id',array('type'=>'select','options' => $namaKategori,'id'=>'PostCategoryId'));

	 echo $this->Form->end(array('label'=>'coba'));*/



?>



<?php

$this->Js->get('#PostCategoryId')->event('change', 

	$this->Js->request(array(

		'controller'=>'Kategori',

		'action'=>'getByCategory'

		), array(

		'update'=>'#PostSubcategoryId',

		'async' => true,

		'method' => 'post',

		'dataExpression'=>true,

		'data'=> $this->Js->serializeForm(array(

			'isForm' => true,

			'inline' => true

			))

		))

	);



?>

