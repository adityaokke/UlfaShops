<?php
if (strtolower($this->params['controller']) === 'gudangs') {
?>

	$('.me-hide-submit').hide();


    $.event.special.inputchange = {
        setup: function() {
            var self = this, val;
            $.data(this, 'timer', window.setInterval(function() {
                val = self.value;
                if ( $.data( self, 'cache') != val ) {
                    $.data( self, 'cache', val );
                    $( self ).trigger( 'inputchange' );
                }
            }, 20));
        },
        teardown: function() {
            window.clearInterval( $.data(this, 'timer') );
        },
        add: function() {
            $.data(this, 'cache', this.value);
        }
    };
    
    var no=0;
    var kodebarang="kl";
    var nama="tidak_ada";
    var page=1;
    function ajaxitem(){ 
        kodebarang=$('.search_kodebarang').val();
        nama=$('.search_nama').val();
        if($('.search_kodebarang').val()==''){
            kodebarang='tidak_ada';
        }
        if($('.search_nama').val()==''){
            nama='tidak_ada';
        }
        $.ajax({
            dataType: 'json',
            url: '<?php echo $this->Html->url(array('action'=>'getdataitem')); ?>/'+kodebarang+'/'+nama+'/'+page
        }).done(function(datas){            

            $('.ajax-view').html(                        
                '<table><thead><tr><td>Kode Barang</td><td>Nama</td><td>Jumlah</td></tr></thead><tbody></tbody></table>'
            )
            var temp='';
            datas.forEach(function(data){
                temp+='<tr><td class="hide hasil-id">'+data['Gudangs']['id']+'</td><td class="hasil-kodebarang">'+data['Gudangs']['kodebarang']+'</td><td class="hasil-nama">'+data['Gudangs']['nama']+'</td><td class="hasil-jumlah">'+data['Gudangs']['quantity']+'</td></tr>';
            });
            $('.ajax-view tbody').html(                        
                temp
            );
        }); 
    
    }
    $(".me-change").on('inputchange',function(){        
        page=1;
        ajaxitem();        
    });



    $(".lihat-daftar-item").on('click',function(){        
        page=1;
        ajaxitem();        
    });

    $( document ).on( "click", ".next", function() {        
        page++;
        ajaxitem();
    });

    $( document ).on( "click", ".prev", function() {        
        page--;
        ajaxitem();
    });


    $(".lihat-daftar-item").on('click',function(){        
        $(".me-change").val("");
        ajaxitem();
    });

    $( '.ajax-view' ).on( "click","tr", function() {        
        $('.input-gudang_id').val($(this).children().html());
        $('.input-kodebarang').val($(this).children().next().html());
        $('.input-nama').val($(this).children().next().next().html());
    });
    $( document ).on( "inputchange", ".me-change", function() {        
        ajaxitem();
    });

    $(".tambah-item-kirim").on('click', function() {
        if($(".input-jumlah").val()!=''||$(".input-jumlah").val()!='0'){

            kodebarang=$(".input-kodebarang").val();
            no++;
            console.log(no);
            $(".input-jumlah").focus();
            $.ajax({
                type: "POST",
                data:{gudang_id:$('.input-gudang_id').val(),kode:$(".input-kodebarang").val(),nama:$(".input-nama").val(),jumlah:$(".input-jumlah").val(),no:no},
                url: "<?php echo $this->base;?>/gudangs/additemkirim/",
                success:function(data) {           
                    $(".last-row-kirim").after(data);                    
                    $('.input-gudang_id').val('');
			        $('.input-kodebarang').val('');
			        $('.input-nama').val('');
			        $('.input-jumlah').val('');
                }
            }); 
        }            
    });

//hapus
    $( document ).on( "click", ".hapus", function() {        
        var tamp=$(this).parent().parent().attr("class");
        $(this).parent().parent().remove();
    });
//
    $('.kirim-item-kirim').on('click',function(){     
        if($('.input-toko').val()!=''){
            $('.daftarkirimform').submit();
        }
    });
    
    $('.daftarkirimform').on('submit',function(){
       $('.input_select').removeAttr("disabled");
       /*$(".formatAngka").each(function(){
                    $(this).val(replaceChars($(this).val()));
        });*/
    });


<?php
}
?>