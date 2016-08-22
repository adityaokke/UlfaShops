<!-- <?php debug($subcategories); ?> -->
<!-- <select> <?php foreach ($subcategories as $key): ?>
<option value="<?php echo $key['Kategori']['id']; ?>"><?php echo $key['Kategori']['nama']; ?></option><?php endforeach; ?>
</select>-->



<?php foreach ($subcategories as $key): ?>
<option value="<?php echo $key['Kategori']['id']; ?>"><?php echo $key['Kategori']['nama']; ?></option>
<?php endforeach; ?>