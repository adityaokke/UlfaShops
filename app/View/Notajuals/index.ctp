<?php  $this->Html->addCrumb('Toko', array('controller' => 'Tokos', 'action' => 'index')); ?>

<?php  $this->Html->addCrumb('Daftar Transaksi Jual','#'); ?>

<div class="row">



		<div class="col-md-12">		

			<?php

			$base_url = array('controller' => 'notajuals', 'action' => 'index');

			echo $this->Form->create('Filter', array(

			'url' => $base_url,

			'class' => 'filter form-inline', 

			'role' => 'form',

			'inputDefaults' => array(

			    'format' => array('before', 'label', 'between', 'input', 'error', 'after'),

			    'div' => array('class' => 'form-group','label' => array('class' => 'sr-only')

			    ),'class' => array('form-control')))); ?>

			<fieldset class="pull-right ">

				<?php 

				echo $this->Form->input('status', array(

										'label' => array(

									        'class' => 'sr-only',

									        'text' => 'Status'

									    ),

										'type' => 'select',

										'options' => array("Status","lunas","hutang"),

										'class'=>'form-control me-change-tanggal-index status',

										'placeholder'=>'Status',

										'default' => ''

									));

				echo $this->Form->input('search', array(

										'label' => array(

									        'class' => 'sr-only',

									        'text' => 'Enter KeyWord'

									    ),

										'placeholder'=>'Enter KeyWord',

										'class'=>'form-control me-change-index'

					));		 ?>

			</fieldset>

			<fieldset class="pull-right hutang-option">    

		    <?php 			

		    	

				echo $this->Form->input('order', array(

										'label' => array(

									        'class' => 'sr-only',

									        'text' => 'Order'

									    ),

										'type' => 'select',

										'options' => array("all","=","<",">"),

										'class'=>'form-control me-change-tanggal-index order',

										'placeholder'=>'order',

										'default' => ''

									));

		    	echo $this->Form->input('tanggalindex', array(

										'label' => array(

									        'class' => 'sr-only',

									        'text' => 'Tanggal'

									    ),

										'type' => 'date',

										'class'=>'form-control me-change-tanggal-index tanggalindex',

										'placeholder'=>'Awal',

										'default' => '',

										'dateFormat' => 'DMY',

										'selected' =>$tanggalindex

									));

                echo "<div class='submit actions me-hide-index'>";

                echo $this->Form->submit("Search");

                echo $this->Html->link("Reset",$base_url);

                echo "</div>";

		    ?>



			</fieldset>

			<?php echo $this->Form->end();?>

		</div>

	<div class="col-md-12">

	<header>

		<h3>Daftar Transaksi Jual</h3>

		</header>

		

		<table>

			<thead>

				<tr>

					<td></td>

					<td>No</td>

					<td>Tanggal</td>

					<td>Nama Pembeli</td>

					<td>Total<br>Harga</td>

					<td>Potongan</td>

					<!-- <td>Pembayaran</td> -->

					<td>Status</td>

					<td>Total<br>Keuntungan</td>

					<td>Hutang</td>

					<td>Jatuh Tempo</td>

					<td>Nama Pelayan</td>

					

				</tr>

			</thead>

			<tbody>

			<?php

			foreach($datas as $data) {

			?>

				<tr>

					<td><?php 

					echo $this->Html->link('Sunting', array('action'=>'edit', $data['Notajual']['id']));

					echo $this->Form->postLink(' | Hapus', 

									array('action'=>'delete', $data['Notajual']['id']),

									array('confirm' => 'Apakah yakin akan menghapus data?'));

					echo $this->Html->link(' | Detil', 

					 				array('action'=>'detil', $data['Notajual']['id']));

					echo $this->Html->link(' | Cetak','#', array('class'=>'cetaknota','idNota'=>$data['Notajual']['id']));

					 ?></td>

					<!-- <td>

						 <?php //echo 

						// $this->Html->link($data['Pembeli']['id'], '#', 

						// 			array('class'=>'anim btn btn-warning', 'nim' => $data['Pembeli']['id'])); 

						?>

					</td> -->

					<td><?= $data['Notajual']['id']; ?></td>

					<td><?= date('d-m-Y', strtotime($data['Notajual']['tanggal'])); ?></td>

					<!-- <td><?= $data['Pembeli']['nama']; ?></td> -->

					<td><?= $data['Notajual']['pembeli']; ?></td>

					<td class="formatAngka"><?= $data['Notajual']['harga_total']; ?></td>

					<td class="formatAngka"><?= $data['Notajual']['potong']; ?></td>

					<!-- <td><?= $data['Notajual']['dibayar']; ?></td> -->

					<td><?= $data['Notajual']['status']; ?></td>

					<td class="formatAngka"><?= $data['Notajual']['keuntungan_total']; ?></td>

					<td class="formatAngka"><?= $data['Notajual']['hutang']; ?></td>

					<?php if ($data['Notajual']['jatuh_tempo']!=="0000-00-00"): ?>

						<td><?= date('d-m-Y', strtotime($data['Notajual']['jatuh_tempo'])); ?></td>	

					<?php else: ?>

						<td>__</td>	

					<?php endif ?>

					<td><?= $data['User']['username']; ?></td>



				</tr>

			<?php

			}
unset($datas);
			?>

			</tbody>

		</table>

		<div class="paging">

			<?php

			echo $this->Paginator->prev(). ' ' . 

			     $this->Paginator->numbers(array('before'=>false, 'after'=>false,'separator'=>false)) . ' ' .

				 $this->Paginator->next();

			?>

		</div>



<!-- 		<div id="infodetil" style="margin: 40px auto; padding: 60px 20px; background-color: #31B0D5;">

		[Detil Siswa]

		</div>

 -->	</div>

</div>