
<?php	
	 
	 echo	$this->Form->create('Post',array('url'=>'/Kategori/tambah','class'=>'form-group'));	
	 echo	$this->Form->input('Kategori.id',array('id'=>'posttitle','label'=>'Judul:','style'=>'width:	100%;','class'=>'form-control'));	
	 echo   $this->Form->input('kategori : ',array('empty'=>array(0=>''),'type'=>'select','options' => $list_kategori,'class'=>'ktg form-control'));
	 echo   $this->Form->input('sub kategori : ',array('empty'=>array(0=>''),'type'=>'select','options' =>$list_sub,'class'=>'sub_ktg form-control'));
	 
	 echo	$this->Form->input('Kategori.nama',array('id'=>'postcontent','label'	=>	'Kategori/Sub kategori baru','class'=>'form-control'));
	 echo   $this->Form->hidden('Kategori.parent', array('value' => 'x','class'=>'hidden_input'));

	 echo $this->Form->submit(__('Save'), array(
            'class' => 'submit'
        ));	
  ?> 
  <script type="text/javascript">
 $(document).ready(function(){
	$(".submit").click(function(event) {
 		if($(".ktg").val()=="0")
 			$(".hidden_input").val('0');
 		else
 			$(".hidden_input").val($('.ktg').val());
 	});
 });
  </script>
