
<?php 
echo "<select name='data[Notabeli][Penyedia_id]' id=opt>";
foreach ($list as $key): ?>
<option value="<?php echo $key['Penyedia']['id']; ?>"><?php echo $key['Penyedia']['nama']; ?></option>
<?php 

endforeach; echo "</select>";?>
