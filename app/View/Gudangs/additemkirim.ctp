				<tr class=<?php echo $no; ?>>
					<td class=<?php echo $no; ?>><!-- <a class="edit">edit</a> --><a class="hapus"> hapus</a></td>					
					<?php echo $this->Form->input('Detildaftarkirim.'.$no.'.gudang_id', array('label' => '','class'=>'input_select','disabled'=>'disabled','value'=>$gudang_id,'type'=>'hidden')); ?>
					<td><?php echo $this->Form->input('Detildaftarkirim.'.$no.'.jumlah', array('label' => '','class'=>'input_select','value'=>$jumlah,'disabled'=>'disabled')); ?></td>
					<td><?php echo $this->Form->input('Detildaftarkirim.'.$no.'.kodebarang', array('label' => '','class'=>'input_select formatAngka','value'=>$kode,'disabled'=>'disabled')); ?></td>
					<td><?php echo $this->Form->input('Detildaftarkirim.'.$no.'.nama', array('label' => '','class'=>'input_select formatAngka','disabled'=>'disabled','value'=>$nama)); ?></td>	
					
				</tr>