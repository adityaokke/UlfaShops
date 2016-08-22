<?php echo $this->Html->script('jquery'); ?>
<?php echo $this->Html->script('bootstrap.min.js'); ?>
<div class="row">
	<div class="col-md-14">
		<div class="row">
			
		<div class="col-md-2">
		  	<?php echo $this->element('vertikalmenu'); ?>
		  </div>
		  <div class="col-md-3">
		  	<button class='btn btn-primary' id='add'>Tambah data</button>

		  	<div class='col-md-12 add-menu'>
		  		<?php
		  			 echo	$this->Form->create('Post',array('url'=>'/Gudangs/update'));	
		  						 /*echo	$this->Form->input('Gudangs.item_id',array('id'=>'posttitle','label'=>'Judul:'));	*/
		  						 echo   $this->Form->input('Gudangs.kodebarang',array('id'=>'postcontent','label'=>'kodebarang'));
		  						 echo   $this->Form->input('Gudangs.quantity',array('id'=>'postcontent','label'=>'jumlah barang'));
		  						 echo	$this->Form->input('Gudangs.harga_barang',array('id'=>'postcontent','label'=>'harga barang'));
		  						
		  						 echo	$this->Form->input('Gudangs.tanggal_masuk',array('id'=>'postcontent','label'=>'','value'=>date('Y-m-d H:i:s')));
		  						 echo $this->Form->end(	array('label'	=>	'Submit	Item')	);		
		  		?>
		  	
		  	</div>
			
		  	<button class='btn btn-primary' id='search'>Cari barang</button>
		  				  
		  				  	<div class='col-md-12 search-input'>
		  				  		<?php
		  				  			 echo $this->Form->create("Search",array("default"=>false, "id"=>"SearchForm"));
		  							 echo $this->Form->input('kode barang',array('type'=>'text','div'=>false,'class'=>'keyword','placeholder'=>'tuliskan kode barang'));
		  							 echo $this->Form->submit('Search');
		  							 echo $this->Form->end();	
		  	
		  				  		?>
		  				  		
		  						
		  				  	</div>
		  				  	<br><br>
	
		  	<button class='btn btn-primary' id='search2'>Cek barang di stok Gudang</button>
			  
			  	<div class='col-md-12 search-input2'>
			  		<?php
			  			 echo $this->Form->create("Search",array("default"=>false, "id"=>"SearchFormstok"));
						 echo $this->Form->input('kode barang',array('type'=>'text','div'=>false,'class'=>'keyword2','placeholder'=>'tuliskan kode barang'));
						 echo $this->Form->submit('Search');
						 echo $this->Form->end();	

			  		?>
			  		
					
			  	</div>
		  	<script type="text/javascript">
		  	 $(document).ready(function(){
		  	 	$(".submit").css('display', 'inline');
		  	 	$(document).on('submit','#SearchForm',function(){
		  	 		 $("#result").html('');
				 $.ajax({
				   type: "POST",
				   data:{keyword:$(".keyword").val()},
				   url: "<?php echo $this->base;?>/Gudangs/ajax_update/",
				   success:function(data) {
				
				         $("#result").html(data);
				      }
				   });        
				 	      
				}); 
				$(document).on('submit','#SearchFormstok',function(){
		  	 		 $("#result").html('');
		  	 		 var get = $(".keyword2").val();
		  	 		 
				 $.ajax({
				   type: "POST",
				   data:{keyword:get},
				   url: "<?php echo $this->base;?>/Gudangs/ajax_stokonly",
				   success:function(data) {
				
				         $("#result").html(data);
				      }
				   });        
				 	      
				}); 
				
				

			 	$(".add-menu").hide();
		  		$("#add").click(function(event) {
		  			$(".add-menu").slideToggle();
		  			$(".search-input").slideUp();
		  			$(".search-input2").slideUp();
		  		});
		  		$(".search-input").hide();
		  		$("#search").click(function(event) {
		  			$(".search-input").slideToggle();
		  			$(".add-menu").slideUp();
		  			$(".search-input2").slideUp();
		  		});
		  		$(".search-input2").hide();
		  		$("#search2").click(function(event) {
		  			$(".search-input2").slideToggle();
		  			$(".add-menu").slideUp();
		  			$(".search-input").slideUp();
		  		});
		  		
		  		
			 });
		  	</script>
		  </div>
		  <div class='wall col-md-7'>
		  		<div id="result"></div>

		  </div>
		 
		</div>

	</div>
</div>