<?php  $this->Html->addCrumb('Toko', array('controller' => 'Tokos', 'action' => 'index')); ?>
<?php  $this->Html->addCrumb('Daftar Item Toko Rusak','#'); ?>
<div class="row">
	<div class="col-md-12">		
			<?php
			
			$base_url = array('controller' => 'itemtokorusaks', 'action' => 'index');
			echo $this->Form->create('Filter', array(
			'url' => $base_url,
			'class' => 'filter form-inline', 
			'role' => 'form',
			'inputDefaults' => array(
			    'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
			    'div' => array('class' => 'form-group','label' => array('class' => 'sr-only')
			    ),'class' => array('form-control')))); ?>
			
			<fieldset class="pull-right">    
		    <?php 			
		    	echo $this->Form->input('search', array(
										'label' => array(
									        'class' => 'sr-only',
									        'text' => 'Enter KeyWord'
									    ),
										'placeholder'=>'Enter KeyWord',
										'class'=>'form-control me-change-index'
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
		<h3>Daftar Item Rusak di Toko</h3>
		</header>
		<?php 
		echo $this->Html->link(
					'Tambah Item Toko Rusak', 
					array('controller'=>'Itemtokorusaks', 'action' => 'add'),
					array('class' => 'btn btn-primary')
				);
		?>
		<table>
			<thead>
				<tr>
					<td></td>
					<td>Kode Barang</td>
					<td>Nama</td>
					<td>Jumlah</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</thead>
			<tbody>
			<?php
			foreach($datas as $data) {
			?>
				<tr>
					<td><?php 
					 echo $this->Html->link('Sunting', array('action'=>'edit', $data['Itemtokorusak']['id']));
					 echo $this->Form->postLink(' | Hapus', 
									array('action'=>'delete', $data['Itemtokorusak']['id']),
									array('confirm' => 'Apakah yakin akan menghapus data ' . 
										  $data['Itemtoko']['Item']['kodebarang']));
					//echo $this->Html->link(' | Detil', 
					 //				array('action'=>'detil', $data['Itemtokorusak']['id']));
					 ?></td>
					<!-- <td>
						 <?php //echo 
						// $this->Html->link($data['Pembeli']['id'], '#', 
						// 			array('class'=>'anim btn btn-warning', 'nim' => $data['Pembeli']['id'])); 
						?>
					</td> -->
					<?php //debug($data) ?>
					<td><?= $data['Itemtoko']['Item']['kodebarang']; ?></td>
					<td><?= $data['Itemtoko']['Item']['nama']; ?></td>
					<td><?= $data['Itemtokorusak']['jumlah']; ?></td>
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