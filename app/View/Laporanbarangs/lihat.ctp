
<div class="row">
	<div class="col-md-14">
		<div class="row">
		 <div class="col-md-2">
		  	
			<?php echo $this->element('vertikalmenu'); ?>
		  </div>
		  <div class="col-md-10">
		  	<div class='col-md-12 search-input'>
		  		<h2>Pencarian</h2>
		  		<?php
		  			 echo $this->Form->create("Search",array("default"=>false, 'id'=>'SearchForm','placeholder'=>'masukan kode barang'));
					 echo $this->Form->input('kode barang',array('type'=>'text','div'=>false,'id'=>'keyword','class'=>'form-control'));
					 
					 echo $this->Form->input('tanggal mulai', array(
			           'id'=>'datepicker',
			           'type'=>'text',
			           'class'=>'mulai form-control'
        			));
					 echo $this->Form->input('tanggal selesai', array(
			           'id'=>'datepicker2',
			           'type'=>'text',
			           'class'=>'akhir form-control'
        			));
					 echo $this->Form->submit('Search');
					 echo $this->Form->end();	

		  		?>
		  		
		  	</div>
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
				   data:{keyword:$("#keyword").val(),mulai:$('.mulai').val(),akhir:$('.akhir').val()},
				   url: "<?php echo $this->base;?>/Laporanbarangs/ajax_see/",
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
		  				
		  				<th style='width:10%;'>kode barang</th>
		  				<th style='width:5%;'>stok</th>
		  				<th style='width:12%;'>Harga barang</th>
		  				<th style='width:15%;'>tgl perubahan</th>
		  				<th style='width:15%;'>keterangan</th>
		  			</tr>
		  		</thead>
		  		<tbody>
		  			<?php

		  					foreach ($data_gudang as $data) 
		  					{
		  			?>
		  						<tr>
									
								 <td><?php	echo	$data['Laporanbarangs']['kodebarang'];?></td>	
								 <td><?php	echo	$data['Laporanbarangs']['quantity'];?></td>
								 <td><?php	echo	$data['Laporanbarangs']['harga_barang'];?></td>		
								
								 <td><?php	echo	$data['Laporanbarangs']['tanggal_aksi'];?></td>
								 <td><?php	echo	$data['Laporanbarangs']['keterangan'];?></td>
								 <td>			
								</tr>
		  			<?php 	
		  					}
		  			?>
				</tbody>


		  	</table>
		  	</div>
		  </div>
		  
		</div>

	</div>
</div>