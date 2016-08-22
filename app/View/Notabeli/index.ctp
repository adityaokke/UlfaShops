

<div class="row">

	<div class="col-md-14">

		<div class="row">

			

		  <div class="col-md-2">

		  	<!-- <div class="btn-group-vertical" role="group" aria-label="...">

			 <?php echo $this->Form->Button('lihat laporan stok', array('onclick' => "location.href='Gudangs/lihatsemua'",'type'=>'button','class'=>'btn btn-default'));?>

			  <?php echo $this->Form->Button('lihat laporan stok', array('onclick' => "location.href='Gudangs/lihatsemua'",'type'=>'button','class'=>'btn btn-default'));?>

			  <div class="btn-group" role="group">

			    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">

			      Pembelian

			      <span class="caret"></span>

			    </button>

			    <ul class="dropdown-menu" role="menu">

			      <li><?php echo $this->Html->link( "Lihat hutang gudang",   array('controller' => 'Notabeli', 'action' => 'showhutang')); ?></li>

			      <li><?php echo $this->Html->link( "Lihat informasi Supplier",   array('controller' => 'Penyedia', 'action' => 'index')); ?></li>

			      <li><?php echo $this->Html->link( "Sistem Pembelian",   array('controller' => 'Notabeli', 'action' => 'index') ); ?></li>

			      <li><?php echo $this->Html->link( "Tambah informasi Supplier",   array('controller' => 'Penyedia', 'action' => 'tambah') ); ?></li>

			    </ul>

			  </div>

			  

			  <div class="btn-group" role="group">

			    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">

			      Stok Gudang

			      <span class="caret"></span>

			    </button>

			    <ul class="dropdown-menu" role="menu">

			      <li><?php echo $this->Html->link( "lihat stok barang terbaru",   array('controller' => 'Gudangs', 'action' => 'terbaru') ); ?></li>

			      <li><?php echo $this->Html->link( "lihat semua stok barang",   array('controller' => 'Gudangs', 'action' => 'lihatsemua') ); ?></li>

			      <li><?php echo $this->Html->link( "lihat barang tanpa harga",   array('controller' => 'Gudangs', 'action' => 'tanpaharga') ); ?></li>

			      <li><?php echo $this->Html->link( "tambah barang di gudang",   array('controller' => 'Gudangs', 'action' => 'update') ); ?></li>

			    </ul>

			  </div>



			  <div class="btn-group" role="group">

			    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">

			      laporan gudang

			      <span class="caret"></span>

			    </button>

			    <ul class="dropdown-menu" role="menu">

			     <li><?php echo $this->Html->link( "Laporan update stok",   array('controller' => 'Laporanbarangs', 'action' => 'lihat') ); ?></li>

			     <li><?php echo $this->Html->link( "Laporan stok bulanan",   array('controller' => 'Transbeli', 'action' => 'stokbulanan') ); ?></li>

			     <li><?php echo $this->Html->link( "Laporan total pembelian stok bulanan",   array('controller' => 'Transbeli', 'action' => 'stokbulanan') ); ?></li>

			     <li><a href="#">Dropdown link</a></li>

			    </ul>

			  </div>

			</div> -->

			<?php echo $this->element('vertikalmenu'); ?>

		  </div>

		  <div class="col-md-10">

		  	

		  </br>

		  	<div class='col-md-12 search-input'>

			<?php

				$options = array();

				foreach ($daftarpenyedia as $key) {

						

						$options[$key['Penyedia']['id']] = $key['Penyedia']['nama'];

						

				}

			?>

				

				<?php

						echo $this->Form->create('Post', array('url'=>array('controller' => 'Notabeli', 'action' => 'buatnota'),'type'=>'get'));

						echo $this->Form->input('Notabeli.penyedia_id',array('empty'=>array(0=>''),'type'=>'select','class'=>'opt','options' => $options,'label'=>'supplier'));

						echo   $this->Form->hidden('Notabeli.tanggal', array('value'=>date('Y-m-d H:i:s'),'class'=>'hidden_input'));

						echo $this->Form->submit('buat');

						echo $this->Form->end();

				?>

				<table class='table table-bordered'>	

				<thead>	

					 <tr>	

					 <th	style="width:	200px;">Nama supplier</th>

					 <th	style="width:	320px;">Tanggal</th>

					 <th	style="width:	150px;">Status</th>	

					 <th	style="width:	150px;">Hutang</th>

					 <th	style="width:	150px;">Total Pembayaran</th>

					 <th	style="width:	80px;">Jumlah Barang</th>

					 <th	style="width:	200px;">Keterangan</th>

					 <th	style="width:	200px;">Jatuh tempo</th>

					 <th	style="width:	400px;">Action </th>	

					 

					 </tr>	

					 </thead>	

				<tbody>	

				<?php

					

					foreach($datas	as	$data)	{?>	

					 <tr>

					 

					<td><?php echo $data['Penyedia']['nama']; ?></td>

					<td><?php echo $data['Notabeli']['tanggal']; ?></td>

					<td><?php echo $data['Notabeli']['status']; ?></td>

					<td><?php echo $data['Notabeli']['hutang']; ?></td>

					<td><?php echo $data['Notabeli']['total_bayar']; ?></td>

					<td><?php echo $data['Notabeli']['transbeli_count']; ?></td>

					<td><?php echo $data['Notabeli']['keterangan']; ?></td>

					<td><?php echo $data['Notabeli']['tanggal_tempo']; ?></td>

					 <td><?php

					 	if($data['Notabeli']['status']=='hutang')

					 	{

					 	echo $this->html->link('Lunaskan',array('controller'=>'Notabeli','action'=>'lunaskan',$data['Notabeli']['id']))."<br>";	

					 	}

					 	echo $this->html->link('ubah',array('controller'=>'Notabeli','action'=>'ubah',$data['Notabeli']['id']))."<br>";	

					 	echo $this->Form->postlink('Hapus',array('controller'=>'Notabeli','action'=>'hapus',$data['Notabeli']['id'],"delkat"),array('confirm'=>'Apakah anda akan menghapus kategori beserta sub kategori dan item di dalamnya ?'));

					 	echo "</br>".$this->html->link('lihat sub',array('controller'=>'Notabeli','action'=>'sistem',$data['Notabeli']['id']));

					 	



					 ?>

					 </tr>	

				<?php		

				}		

				unset($datas);	

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

				<script>

					$("#coba").hide();

					$("#add_supply").click(function(event) {

						$("#coba").slideToggle();

					});

					$("#add_item").click(function(event) {

						$("#coba").slideToggle();

					});

				    jQuery("#performAjaxLink").click(

				            function()

				            {    

					            	jQuery.ajax({

				                    type:'POST',

				                    async: true,

				                    cache: false,

				                    url: '<?php echo Router::Url(array('controller' => 'Penyedia', 'action' => 'helloAjax'), TRUE); ?>',

				                    success: function(response) {

				                       alert(response);

				                       $("#coba").slideUp();

				                       		jQuery.ajax({

						                    type:'POST',

						                    async: true,

						                    cache: false,

						                    url: '<?php echo Router::Url(array('controller' => 'Penyedia', 'action' => 'updateopt'), TRUE); ?>',

						                    success: function(response) {

						                    	alert(response);

						                      $(".opt").html(response);

						                },

						                data:""

						                });

						                return false;





				                },

				                data:jQuery('form').serialize()

				                });

				            }

				    );

					$("#getkode").click(function(event) {

						var nama = $("#penyedia-nama").val();

						window.open('/Item/cekkode?key='+nama, '_blank', 'toolbar=0,scrollbars=1,location=0,status=1,menubar=0,resizable=1,width=500,height=500');

						

					});



				</script>

		  		



		  	</div>

		  

		</div>



	</div>

</div>