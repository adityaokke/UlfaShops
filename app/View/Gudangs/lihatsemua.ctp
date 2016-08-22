
<div class="row">
	<div class="col-md-14">
		<div class="row">
		<div class="col-md-2">
		  	
			<?php echo $this->element('vertikalmenu'); ?>
		  </div>
		  <div class="col-md-10" style="float: left;">
		  	
		  	<h5>Pencarian</h5>
		  		<?php echo $this->Form->create('BoostCake', array(
					'inputDefaults' => array(
						'div' => 'form-group',
						'label'=>false,
						'wrapInput' => false,
						'class' => 'form-control'
					),
					'class' => 'well form-inline','id'=>'SearchForm','default'=>false
				)); ?>
		  		<?php
		  			 
					 echo $this->Form->input('kode barang',array('type'=>'text','id'=>'keyword','placeholder' => 'kode barang'));
					 echo $this->Form->input('tanggal mulai', array(
			           'id'=>'datepicker',
			           'type'=>'text',
			           'class'=>'mulai',
			           'placeholder' => 'tanggal mulai'
        			));
					 echo $this->Form->input('tanggal selesai', array(
			           'id'=>'datepicker2',
			           'type'=>'text',
			           'class'=>'akhir',
			           'placeholder' => 'tanggal akhir'
        			));
					 echo $this->Form->submit('Search');
					 echo $this->Form->end();	

		  		?>
			
			<script>
			$(function() {
			       $("#datepicker").datepicker({
			       	dateFormat: 'yy-mm-dd'
			       });
			       $("#datepicker2").datepicker({
			       	dateFormat: 'yy-mm-dd'
			       });
			});
			</script>
			<script type="text/javascript">
		  	$(document).ready(function(){
		  	 	$(document).on('submit','#SearchForm',function(){

				 $.ajax({
				   type: "POST",
				   data:{keyword:$("#keyword").val(),kode:'kb',mulai:$('.mulai').val(),akhir:$('.akhir').val()},
				   url: "<?php echo $this->base;?>/Gudangs/ajax_search_stok/",
				   success:function(data) {
				   	
				   		
				   		$("#result").html(data);
				      }
				   });        
				 	      
				});

				
			});
		  	</script>
		  	<div id='result'>
		  	<table class='table table-bordered'>
		  		<thead>
		  			<tr>
		  				<th style='width:10%;'>nama</th>
		  				<th style='width:10%;'>kode barang</th>
		  				<th style='width:5%;'>stok</th>
		  				
		  				<th style='width:10%;'>harga</th>
		  				<th style='width:5%'>tanggal</th>
		  			</tr>
		  		</thead>
		  		<tbody>
		  			<?php

		  					foreach ($data_gudang as $data) 
		  					{
		  			?>
		  						<tr>
								 <td><?php	echo	$data['Item']['nama'];	?></td>		
								 <td><?php	echo	$data['Gudangs']['kodebarang'];?></td>	
								 <td><?php	echo	$data['Gudangs']['quantity'];?></td>
								 <td><?php	echo	$data['Gudangs']['harga_barang'];?></td>
								 <td><?php	echo	$data['Gudangs']['tanggal_masuk'];?></td>
								 <td><?php
								 	echo $this->html->link('ubah',array('controller'=>'Gudangs','action'=>'ubah',$data['Gudangs']['id']));

								 ?> <?php	echo $this->Form->postlink('Hapus',array('controller'=>'Gudangs','action'=>'hapus',$data['Gudangs']['id'],"delkat"),array('confirm'=>'Apakah anda akan menghapus kategori beserta sub kategori dan item di dalamnya ?'));
								 ?>
								
								</td>
								 		
								</tr>
		  			<?php 	
		  					}
		  			?>
				</tbody>


		  	</table>
		  	<div	class="paging">	
			<?php	
				 echo	$this->Paginator->prev('	<<	',	array('escape'	=>	false),	
																				 null,	array('escape'	=>	false,	'class'=>'prev	disabled'))	.	
				 					$this->Paginator->numbers(array('before'	=>	false,	
																				 'after'	=>	false,	'separator'	=>	false))	.	
				 					$this->Paginator->next('	>>	',	array('escape'	=>	false),	
																				 null,	array('escape'	=>	false,	'class'	=>	'next	disabled'))		
			?>	
			</div>
		  	</div>
		  </div>
		  
		</div>

	</div>
</div>