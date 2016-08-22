
<div class="row">
	<div class="col-md-14">
		<div class="row">
			
		  <div class="col-md-2">
		  	<?php echo $this->element('vertikalmenu'); ?>
		  </div>
		  <div class="col-md-6">
		  	<h3>pencarian - update - hapus data gudang</h3>
		  	<button class='btn btn-primary' id='search'>search - kodebarang</button>
		  </br>
		  	<div class='col-md-12 search-input'>

		  		<?php
		  			 echo $this->Form->create("Search",array('default'=>false, 'id'=>'SearchForm'));
					 echo $this->Form->input('kode barang',array('type'=>'text','div'=>false,'id'=>'keyword','placeholder'=>'masukan kode barang','class'=>'searchgudang form-control'));
					 echo $this->Form->submit('Search');
					 echo $this->Form->end();	

		  		?>
		  		
				
		  	</div>
		  	
		  	<script type="text/javascript">
		  	 $(document).ready(function(){
		  	 	$(document).on('submit','#SearchForm',function(){
		  	 		
				 $.ajax({
				   type: "POST",
				   data:{keyword:$("#keyword").val()},
				   url: "<?php echo $this->base;?>/Gudangs/ajax_search/",
				   success:function(data) {
				   
				         $("#result").html(data);
				      }
				   });        
				 	      
				}); 
				
			 	/*$(".add-menu").hide();
		  		$("#add").click(function(event) {
		  			$(".add-menu").slideToggle();
		  			$(".search-input").slideUp();
		  			$(".search-input2").slideUp();
		  		});*/
		  		$(".search-input").hide();
		  		$("#search").click(function(event) {
		  			$(".search-input").slideToggle();
		  			$(".add-menu").slideUp();
		  			
		  		});
		  		
		  		
			 });
		  	</script>
		  	<div id="result"></div>
		  </div>
		  <div class="col-md-4">
		  	<h2>stok barang baru</h2>
		  	<table class='table table-bordered'>
		  		<thead>
		  			<tr>
		  				<th style='width:25%;'>nama</th>
		  				<th style='width:25%;'>kode barang</th>
		  				<th style='width:25%;'>stok</th>
		  				<th style='width:25%;'>tgl masuk</th>
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
								 <td><?php	echo	$data['Gudangs']['tanggal_masuk'];?></td>		
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