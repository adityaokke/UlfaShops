
<div class="row">
	<div class="col-md-12">
		<?php  $this->Html->addCrumb('Kategori', array('controller' => 'Kategori', 'action' => 'index')); ?>
		
		<h3><?php echo $result;?></h3>
		<?php
		if($katkey == 'kategori_utama')
		{
		?>
			<table>	
			<thead>	
				<tr>	
				 	<th	style="width:	200px;">Nama</th>	
				</tr>	
			</thead>	
			<tbody>	
			<?php	
			foreach($datas	as	$data)	{?>	
				 <tr>
				 	<td>
				 		<?php echo $this->html->link($data['Kategori']['nama'],array('controller'=>'Kategori','action'=>'detail',$data['Kategori']['id'])) ?>
				 	</td>
				 </tr>	
			<?php		
			}		
			unset($datas);	
			?>	
			</tbody>	
			</table>
		<?php	
		}
		else
		{
		?>
			<table>	
			<thead>	
				 <tr>	
				 <th	style="width:	200px;">nama</th>	
				 <th	style="width:	400px;">kodebarang </th>	
				 
				 </tr>	
				 </thead>	
			<tbody>	
			<?php	foreach($datas	as	$data)	{?>	
				 <tr>
				 <td><?php echo $this->html->link($data['Item']['nama'],array('controller'=>'Item','action'=>'detil',$data['Item']['id'])) ?></td>	
				 <td><?php echo	$data['Item']['kodebarang'];	?></td>
				 
				 </tr>	
			<?php		
			}		
		}	
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
	</div>

</div>
