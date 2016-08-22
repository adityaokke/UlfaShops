<div class="daftar_barang" style="display:none;">
<?php foreach($datas as $data) { ?>
	<div class="data"><?php echo $data["Item"]["kodebarang"]; ?></div>
<?php }unset($datas); ?>
</div>
