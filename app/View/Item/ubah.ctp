<?php
	echo "</br><label>Kategori awal : ".$namaSK."</label><br>";
	echo "<label>subKategori awal   : ".$namak."</label><br>";
	echo $this->Form->create('Item',array('enctype'=>'multipart/form-data','url'=>array('controller'=>'Item','action'=>'ubah',$Item_id,'class'=>'form-group')));
	
	echo $this->Form->input('Item.id',array('id'=>'posttitle','label'=>'judul : ','style'=>'width:100%;','value'=>$data['Item']['id'],'class'=>'form-control'));
	echo $this->Form->input('Item.nama',array('id'=>'postcontent','label'=>'nama','value'=>$data['Item']['nama'],'class'=>'form-control'));
	echo $this->Form->input('Item.kodebarang',array('id'=>'postcontent','label'=>'kode_barang','value'=>$data['Item']['kodebarang'],'class'=>'form-control'));
	
	echo   $this->Form->input('Item.kategori_id',array('type'=>'select','label'=>'Kategori utama','options' => $namaKategori,'id'=>'PostCategoryId','class'=>'form-control'));
	 echo   $this->Form->input('Item.kategori_id',array('type'=>'select','label'=>'Kategori sub','options' => $namasubKategori,'id'=>'PostSubcategoryId','class'=>'form-control'));
	 echo $this->Form->input('photo', array(
						'label' => 'Foto Item:',
						'type' => 'file','class'=>'form-control'
	));	
	echo $this->Form->end(array('label'=>'edit item'));
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