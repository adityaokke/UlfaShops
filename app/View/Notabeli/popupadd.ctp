<?php	
	
	 echo $this->Html->script('jquery',FALSE); 
	 echo	$this->Form->create('Post',array('url'=>'/Kategori/tambah'));
	
	 echo	$this->Form->input('Kategori.id',array('id'=>'posttitle','label'=>'Judul:','style'=>'width:	100%;'));	
	 echo	$this->Form->input('NotaBuyers',array('id'=>'postcontent','label'	=>	'Item'));
	 
	 echo   $this->Form->hidden('Kategori.parent', array('value' => 'x','class'=>'hidden_input'));

	 echo $this->Form->submit(__('Save'), array(
            'class' => 'submit'
        ));	
  ?>