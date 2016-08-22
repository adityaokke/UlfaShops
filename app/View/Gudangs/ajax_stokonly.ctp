	<table class='table table-bordered'>
		  		<thead>
		  			<tr>
		  				<th style='width:10%;'>nama</th>
		  				<th style='width:10%;'>kode barang</th>
		  				<th style='width:5%;'>stok</th>
		  				<th style='width:12%;'>Harga</th>
		  				<th style='width:10%;'>tgl masuk</th>
		  				<th style='width:5%'>aksi</th>
		  			</tr>
		  		</thead>
		  		<tbody>
		  			<?php
		  					echo $hasil;
		  					foreach ($list as $data) 
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