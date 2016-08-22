<h4>hasil pencarian barang gudang dengan kode barang</h4>

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
		  				
		  				foreach ($list as $data) 
		  				{
		  					
		  			?>
		  					<tr>
							 <td><?php	echo	$data['Item']['nama'];	?></td>		
							 <td><?php	echo	$data['Gudangs']['kodebarang'];?></td>	
							 <td><?php	echo	$data['Gudangs']['quantity'];?></td>
							 <td><?php	echo	$data['Gudangs']['tanggal_masuk'];?></td>		
							 <td>
							 	<h5><?php echo $this->HTML->link('ubah',array('controller'=>'Gudangs','action'=>'ubah',$data['Gudangs']['id']));?></h5>
		  						<h5> <?php	echo $this->Form->postlink('Hapus',array('controller'=>'Gudangs','action'=>'hapus',$data['Gudangs']['id'],"delkat"),array('confirm'=>'Apakah anda akan menghapus kategori beserta sub kategori dan item di dalamnya ?'));?></h5>
		  					 </td>
						   </tr>
		  			<?php 	
		  					}
		  			?>
				</tbody>


		  	</table>