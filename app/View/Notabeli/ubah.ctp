<h4>Pembayaran</h4>
<?php
	
	echo $this->Form->create('Transbeli',array('url'=>array('controller'=>'Notabeli','action'=>'updatenota')));
	echo $this->Form->hidden('Notabeli.id',array('id'=>'postcontent','value'=>$data['id']));
	echo $this->Form->hidden('Notabeli.total_bayar',array('id'=>'postcontent','value'=>$data['total_bayar'],'class'=>'t'));
	echo $this->Form->hidden('Notabeli.hutang',array('id'=>'postcontent','value'=>$data['hutang'],'class'=>'h'));
	echo $this->Form->hidden('Notabeli.bayar',array('id'=>'postcontent','value'=>$data['bayar'],'class'=>'b'));
	echo $this->Form->hidden('Notabeli.status',array('id'=>'postcontent','value'=>$data['status'],'class'=>'s'));
	echo $this->Form->input('total',array('id'=>'postcontent','label'=>'total harga','value'=>$data['total_bayar'],'class'=>'total','readonly' => 'readonly'));
	echo $this->Form->input('bayar',array('id'=>'postcontent','label'=>'dibayar','class'=>'bayar','value'=>$data['bayar']));
	echo $this->Form->input('hutang',array('id'=>'postcontent','label'=>'hutang','class'=>'hutang','value'=>$data['hutang']));
	echo $this->Form->input('Notabeli.tanggal_tempo',array('id'=>'postcontent','label'=>'tanggal jatuh tempo','value'=>$data['tanggal_tempo']));
	echo $this->Form->input('Notabeli.keterangan',array('id'=>'postcontent','label'=>'keterangan','value'=>$data['keterangan']));

	echo $this->Form->input('kembalian',array('id'=>'postcontent','label'=>'kembalian','class'=>'kembalian'));
	echo $this->Form->end(array('label'=>'akhiri transaksi'));


?>
<script type="text/javascript">
				$(document).ready(function(){
					function replaceChars(entry) {
						out = "."; // replace this
						add = ""; // with this
						temp = "" + entry; // temporary holder

						while (temp.indexOf(out)>-1) {
						pos= temp.indexOf(out);
						temp = "" + (temp.substring(0, pos) + add + 
						temp.substring((pos + out.length), temp.length));
						}
						return temp;
					}

					function trimNumber(s) {
					  while (s.substr(0,1) == '0' && s.length>1) { s = s.substr(1,9999); }
					  while (s.substr(0,1) == '.' && s.length>1) { s = s.substr(1,9999); }
					  return s;
					}

					function formatangka(objek) {
						

					a = objek.value;
					b = a.replace(/[^\d]/g,"");
					c = "";
					panjang = b.length;
					j = 0;
					for (i = panjang; i > 0; i--) {
					j = j + 1;
					if (((j % 3) == 1) && (j != 1)) {
					c = b.substr(i-1,1) + "." + c;
					} else {
					c = b.substr(i-1,1) + c;
					}
					}
					objek.value = trimNumber(c);
					}

					function formatAngka2(angka) {
					 if (typeof(angka) != 'string') angka = angka.toString();
					 var reg = new RegExp('([0-9]+)([0-9]{3})');
					 while(reg.test(angka)) angka = angka.replace(reg, '$1.$2');
					 return angka;
					}
					var hutang = 0;
					var angka = $('.total').val();
					$('.total').val((angka/1000).toFixed(3));
					$('.t').val(angka);
					
					//angka = total
					//bayar = dibayar
					//jika bayar < total 
					//hutang
					// jika bayar > total
					$(".bayar").keyup(function(event) {
						formatangka(this);
						var bayar = replaceChars($(this).val());
						var kembalian = bayar - angka;
						//
						$('.b').val(bayar);
						if(kembalian < 0)
						{
							$('.h').val(kembalian*-1);
							$('.kembalian').val(0);	
							$('.hutang').val(formatAngka2(kembalian));
							$('.s').val('hutang');
						}
						else
						{
							$('.hutang').val(0);
							$('.h').val(0);	
							$('.kembalian').val(formatAngka2(kembalian));
							$('.s').val('lunas');	
						}
						
						

						


						/*var sisa = $('.total').val();
						var kembalian = sisa - $(this).val();
						var convert = replaceChars(kembalian);
						$(".kembalian").val(convert);*/
						/*var kembalian = replaceChars($('.total').val()) - replaceChars(this.val());
						$('kembalian').val(bayar);*/

					});
					$(".terima").keyup(function(event) {
						formatangka(this);
						var total = replaceChars($(this).val());
						var terima = replaceChars($('.bayar').val());
						var kembalian = total - terima;
						$('.kembalian').val(formatAngka2(kembalian));
					});
				})

			</script>