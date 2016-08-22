	<table class='table table-bordered'>
		  		<thead>
		  			<tr>
		  				<th style='width:10%;'>nama</th>
		  				<th style='width:10%;'>kode barang</th>
		  				
		  				
		  			</tr>
		  		</thead>
		  		<tbody>
		  			<?php
		  					echo $hasil;
		  					foreach ($data_gudang as $data) 
		  					{
		  			?>
		  						<tr>
								 <td><?php	echo	$data['Item']['nama'];	?></td>		
								 <td><?php	echo	$data['Item']['kodebarang'];?></td>	
								 
								</tr>
		  			<?php 	
		  					}
		  			?>
				</tbody>


		  	</table>