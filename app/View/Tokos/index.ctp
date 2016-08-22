<?php  $this->Html->addCrumb('Toko',"#"); ?>

<div class="row">

	<div class="col-md-2">

		<div class="btn-group-vertical" role="group" aria-label="...">

			<?php //echo $this->Form->Button('Pembeli', array('onclick' => "location.href='Pembelis/'",'type'=>'button','class'=>'btn btn-default'));?>

			<?php echo $this->Form->Button('Transaksi', array('onclick' => "location.href='transjuals/'",'type'=>'button','class'=>'btn btn-default'));?>

			<?php echo $this->Form->Button('Daftar Transaksi', array('onclick' => "location.href='notajuals/'",'type'=>'button','class'=>'btn btn-default'));?>

			<div class="btn-group" role="group">

			    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">

			    	Item Toko

			      <span class="caret"></span>

			    </button>

			    <ul class="dropdown-menu" role="menu">

			     <li><?php echo $this->Html->link( "Siap Jual",   array('controller' => 'itemtokos', 'action' => 'index') ); ?></li>

			     <li><?php echo $this->Html->link( "Rusak",   array('controller' => 'itemtokorusaks', 'action' => 'index') ); ?></li>

			    </ul>

			  </div>
			<?php //echo $this->Form->Button('Item Toko', array('onclick' => "location.href='itemtokos/'",'type'=>'button','class'=>'btn btn-default'));?>

			<?php echo $this->Form->Button('Unit Item', array('onclick' => "location.href='units/'",'type'=>'button','class'=>'btn btn-default'));?>

			<?php echo $this->Form->Button('Daftar Toko', array('onclick' => "location.href='tokos/daftartoko'",'type'=>'button','class'=>'btn btn-default'));?>

			<?php echo $this->Form->Button('Daftar Kirim', array('onclick' => "location.href='daftarkirims/index'",'type'=>'button','class'=>'btn btn-default'));?>

			<?php echo $this->Form->Button('Retur Barang', array('onclick' => "location.href='returs/index'",'type'=>'button','class'=>'btn btn-default'));?>

			<div class="btn-group" role="group">

			    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">

			    	Laporan

			      <span class="caret"></span>

			    </button>

			    <ul class="dropdown-menu" role="menu">

			     <li><?php echo $this->Html->link( "Laporan Nota Jual",   array('controller' => 'notajuals', 'action' => 'laporan') ); ?></li>

			     <li><?php echo $this->Html->link( "Laporan Stok Item",   array('controller' => 'notajuals', 'action' => 'stokitem') ); ?></li>

			    </ul>

			  </div>





	<!-- 		<div class="btn-group" role="group">

			    <button type="button" class="btn btn-default" aria-expanded="false" class="btn btn-default">

			     	<?php //echo $this->Html->link('Pembeli', array('controller'=>'Pembelis', 'action' => 'index')//,array('class' => 'btn btn-primary')); ?>

			    </button>

			</div>  

			<div class="btn-group" role="group">

			    <button type="button" class="btn btn-default" aria-expanded="false">

			      <?php 

						// echo $this->Form->create('Transjual', array('controller'=>'Transjual','action'=>'index'));

						// echo $this->Form->end('Transaksi');

						//echo $this->Html->link('Transaksi',array('controller'=>'transjuals', 'action' => 'index')//,array('class' => 'btn btn-primary'));?>

			    </button>

			</div>  

			<div class="btn-group" role="group">

			    <button type="button" class="btn btn-default" aria-expanded="false">

			      	<?php 

						//echo $this->Html->link('Daftar Transaksi',array('controller'=>'notajuals', 'action' => 'index')//,array('class' => 'btn btn-primary'));

					?>

			    </button>

			</div>  

			<div class="btn-group" role="group">

			    <button type="button" class="btn btn-default" aria-expanded="false">

			     	 <?php 

						//echo $this->Html->link('Item Toko', array('controller'=>'itemtokos', 'action' => 'index')//,array('class' => 'btn btn-primary'));

					?>

			    </button>

			</div>  

			<div class="btn-group" role="group">

			    <button type="button" class="btn btn-default" aria-expanded="false">

			     	 <?php 

						//echo $this->Html->link('Unit item', array('controller'=>'units', 'action' => 'index')//,array('class' => 'btn btn-primary'));

					?>

			    </button>

			</div>  

			<div class="btn-group" role="group">

			    <button type="button" class="btn btn-default" aria-expanded="false">

			     	<?php 

						//echo $this->Html->link('Toko', array('controller'=>'tokos', 'action' => 'daftartoko')//,array('class' => 'btn btn-primary'));

					?>

			    </button>

			</div>  -->

		</div>



		<?php 		

		//echo $this->Html->getCrumbList($options = array(), string $startText = "haha" );

				

		?>

	</div>

</div>