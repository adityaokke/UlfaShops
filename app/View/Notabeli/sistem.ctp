

<div class="row">

	<div class="col-md-14">

		<div class="row">

			

		  <div class="col-md-2">

		  
			<?php echo $this->element('vertikalmenu'); ?>

			<br><br>

			<div class="panel panel-info">

			  <div class="panel-body">

			   	<button class='btn btn-primary' class='searchkb' id='tambah'>cari kodebarang</button><br><br>  

			  	<button class='btn btn-primary' id='addnew'>+ Item</button><br><br>

			  	<button class='btn btn-primary' id='additemgudang'>+ Item gudang</button><br><br>

			  </div>

			</div>

		  </div>

		  <?php 

			if($status=='')

		  	{





		  ?>

		  <div class="col-md-4">

		  	<div class='col-md-12 search-input'>



		  		<?php

		  			 echo $this->Form->create("Search",array('default'=>false, 'id'=>'SearchForm'));

					 echo $this->Form->input('kode barang',array('type'=>'text','div'=>false,'id'=>'keyword','placeholder'=>'masukan kode barang','class'=>'form-control'));

					 echo $this->Form->submit('Search');

					 echo $this->Form->end();	



		  		?>

		  		
				

		  	</div>

		  	

		  	<div class='col-md-12 addnew-input'>

		  		<?php



		  		 echo	$this->Form->create('Post',array('url'=>'/Item/tambah3/'.$this->params['pass'][0],'enctype'=>'multipart/form-data'));	

				 echo	$this->Form->input('Item.id',array('id'=>'posttitle','label'	=>'Judul:','style'=>'width:	100%;','class'=>'form-control'));	

				 echo   $this->Form->input('Item.nama',array('id'=>'postcontent','label'=>'nama','class'=>'form-control'));

				 echo	$this->Form->input('Item.kodebarang',array('id'=>'postcontent','label'=>'kode barang'));

				 echo   $this->Form->input('Item.kategori_id',array('type'=>'select','options' => $namaKategori,'id'=>'PostCategoryId','class'=>'form-control'));

				 echo   $this->Form->input('Item.kategori_id',array('type'=>'select','options' => $namasubKategori,'id'=>'PostSubcategoryId','class'=>'form-control'));

				 echo $this->Form->input('photo', array(

									'label' => 'Foto Item:',

									'type' => 'file'

				));	

				echo $this->Form->end(	array('label'	=>	'Submit	Item')	);	



		  		?>

		  		---------------------------------------------------------------

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



		  	</div>

		  	<div class='col-md-12 addgudang'>

		  		<?php

		  			 echo	$this->Form->create('Post',array('url'=>'/Gudangs/update2/'.$this->params['pass'][0]));	

		  						 /*echo	$this->Form->input('Gudangs.item_id',array('id'=>'posttitle','label'=>'Judul:'));	*/

		  						 echo   $this->Form->input('Gudangs.kodebarang',array('id'=>'postcontent','label'=>'kodebarang','class'=>'form-control'));

		  						 echo   $this->Form->input('Gudangs.quantity',array('id'=>'postcontent','label'=>'jumlah barang','class'=>'form-control'));

		  						 echo	$this->Form->input('Gudangs.satuan_grosir',array('id'=>'postcontent','label'=>'satuan grosir','class'=>'form-control'));

		  						 echo	$this->Form->input('Gudangs.lusin_grosir',array('id'=>'postcontent','label'=>'lusin grosir','class'=>'form-control'));

		  						 echo	$this->Form->input('Gudangs.lusin6_grosir',array('id'=>'postcontent','label'=>'lebih dari 6 lusin grosir','class'=>'form-control'));;

		  						 echo	$this->Form->input('Gudangs.satuan_eceran',array('id'=>'postcontent','label'=>'satuan eceran','class'=>'form-control'));

		  						 echo	$this->Form->input('Gudangs.pcs3_eceran',array('id'=>'postcontent','label'=>'lebih dari 3 pcs eceran','class'=>'form-control'));

		  						 echo	$this->Form->input('Gudangs.lusin1_eceran',array('id'=>'postcontent','label'=>'lebih dari 1 lusin eceran','class'=>'form-control'));;

		  						 echo	$this->Form->input('Gudangs.tanggal_masuk',array('id'=>'postcontent','label'=>'','value'=>date('Y-m-d H:i:s')));

		  						 echo $this->Form->end(array('label'=>'Submit	Item'));	

		  		?>



		  	</div>

		  	<div class='col-md-12'>

		  		<h3>Tambah transaksi</h3>

		  		<?php

		  			echo	$this->Form->create('Post', array('default'=>false,'id'=>'addform'));

					echo	$this->Form->input('kodebarang',array('id'=>'kodebarang','label'=>'kode barang','class'=>'kb form-control','id'=>'addtransaksi'));

					echo 	$this->Form->input('Transbeli.harga',array('id'=>'harga','label'=>'Harga beli barang','class'=>'hb form-control'));

					echo 	$this->Form->input('Transbeli.quantity',array('id'=>'quantity','label'=>'Jumlah barang','class'=>'jb form-control'));

					//echo $this->Form->input('Transbeli.quantity',array('id'=>'quantity','label'=>'Jumlah barang'));

					echo   $this->Form->hidden('Transbeli.notabeli_id', array('value'=>$this->params['pass'][0]));



					echo 	$this->Form->input('Transbeli.tanggal_beli', array(

			           'id'=>'datepicker',

			           'type'=>'text',

			           'class'=>'mulai form-control',

			           'placeholder' => 'tanggal mulai'

        			));



					echo 	$this->Form->submit(('Tambah barang beli'), array('class' => 'submit'));

		  		?>

			</div>

			<script>

			$(function() {

			       $("#datepicker").datepicker({

			       	dateFormat: 'yy-mm-dd'

			       });

			       

			});

			</script>

		  	<script type="text/javascript">

		  	 $(document).ready(function(){
		  	 	
		  	 	$(document).on('submit','#SearchForm',function(){

		  	 	$.ajax({

				   type: "POST",

				   data:{keyword:$("#keyword").val()},

				   url: "<?php echo $this->base;?>/Gudangs/ajax_search/",

				   success:function(data) {

				   

				         $("#result2").html(data);

				      }

				   });        

				 	      

				}); 

				$(document).on('submit','#addform',function(){

		  	 	$.ajax({

				   type: "POST",

				   data:$('#addform').serialize(),

				   url: "<?php echo $this->base;?>/Transbeli/tambah/",

				   success:function(data) {

				   

				         $("#result").html(data);

				         alert('data sudah di tambahkan');

				         $('#addform .kb').val('');

				         $('#addform .hb').val('');

				         $('#addform .jb').val('');

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

		  		$(".search").click(function(event) {

		  			$(".search-input").slideToggle();

		  			$(".add-menu").slideUp();

		  			$(".addnew-input").slideUp();

		  			$(".addgudang").slideUp();

		  			

		  		});

		  		$(".addnew-input").hide();

		  		$(".addgudang").hide();



		  		$("#addnew").click(function(event) {

		  			$(".addnew-input").slideToggle();

		  			$(".add-menu").slideUp();

		  			$(".search-input").slideUp();

		  			$(".addgudang").slideUp();

		  			

		  		});

		  		$("#additemgudang").click(function(event) {

		  			$(".addgudang").slideToggle();

		  			$(".add-menu").slideUp();

		  			$(".search-input").slideUp();

		  			$(".addnew-input").slideUp();

		  			

		  		});

		  		$("#acc").click(function(event) {

		  			$.ajax({

					   type: "POST",

					   url: "<?php echo $this->base;?>/Transbeli/comit/<?php echo $this->params['pass'][0]; ?>",

					   success:function(data) {

					   		$("#result2").html(data);

					      }

					   });    

		  		});

		  		

			 });

		  	</script>

		  	

		  </div>

		  

		   <div class="col-md-4"></div>

		  <div class="col-md-6">

		  	<div id="result">

		  		<h5>daftar pembelian barang</h5>

		  		<table>

				<thead>

					<tr>

						<th >NO</th>		

						<th >NAMA</th>

						

						<th >jumlah</th>

						<th >Harga beli</th>

						<th >Total</th>

						<th >Action</th>

						

						

						

				

					</tr>		

				</thead>

				<tbody>

					<?php 

					$i = 1;

					foreach($data_beli as $Item)

					{?>

						<tr >

							<td><?php echo $i++;?></td>

							<td><?php echo $Item['Gudangs']['kodebarang'];?></td>

							<td><?php echo $Item['Transbeli']['quantity'];?></td>

							<td><?php echo $Item['Transbeli']['harga'];?></td>

							<td><?php echo $Item['Transbeli']['total'];?></td>

							<td>

								<?php

								echo $this->HTML->link('ubah',array('controller'=>'Transbeli','action'=>'ubah',$Item['Transbeli']['id'],$this->params['pass'][0]));

								

								?>

								<?php

								echo $this->Form->postlink('hapus',array('controller'=>'Transbeli','action'=>'hapus'),array('confirm'=>'anda yakin ingin menghapus'));

								?>

							</td>

						</tr>

					<?php

					}

					unset($Item)

					?>



				</tbody>

				</table>





		  	</div>

		  	<button type="button" class="btn btn-default" id='acc'>acc pembelian</button>

		  	<div id='result2'>

		  	

		  	</div>

			

		  </div>

		  <?php 

			} 

			else 

			{

		  ?>

			<div class="col-md-6">

		  		

				<table>

				<thead>

					<tr>

						<th >NO</th>		

						<th >NAMA</th>

						<th >jumlah</th>

						<th >Harga beli</th>

						<th >Total</th>

						

					</tr>		

				</thead>

				<tbody>

					<?php 

					$i = 1;

					foreach($data_beli as $Item)

					{?>



						<tr >

							<td><?php echo $i++;?></td>

							<td><?php echo $Item['Gudangs']['kodebarang'];?></td>

							<td><?php echo $Item['Transbeli']['quantity'];?></td>

							<td><?php echo $Item['Transbeli']['harga'];?></td>

							<td><?php echo $Item['Transbeli']['total'];?></td>

							<td>

								

							</td>

						</tr>

					<?php

					}

					unset($Item)

					?>



				</tbody>

				</table>

		  	

		  	</div>

		  

		  

		  <?php }?>

		</div>



	</div>

</div>