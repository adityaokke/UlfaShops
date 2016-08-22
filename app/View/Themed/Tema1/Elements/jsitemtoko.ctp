<?php
if (strtolower($this->params['controller']) === 'itemtokos') {    
?>

    $(".me-hide-index").hide();
    $('#FilterSearch').focus();

<?php if (strtolower($this->params['action']) === 'index') {    ?>
var html = $("#FilterSearch").val();
$("#FilterSearch").focus().val("").val(html);

var SearchInpu = $('#FilterSearch');

// Multiply by 2 to ensure the cursor always ends up at the end;
// Opera sometimes sees a carriage return as 2 characters.

var strLength= SearchInpu.val().length * 2;

SearchInpu.focus();
<?php } ?>

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


    $(".me-change-index").on("inputchange",function(){    
        $( "form:first" ).trigger( "submit" );
    });


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
                '<table><thead><tr><td>Kode Barang</td><td>Nama</td></tr></thead><tbody></tbody></table>'
            )
            var temp='';
            datas.forEach(function(data){
                temp+='<tr><td class="hide hasil-id">'+data['Item']['id']+'</td><td class="hasil-kodebarang">'+data['Item']['kodebarang']+'</td><td class="hasil-nama">'+data['Item']['nama']+'</td></tr>';
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

    $( document ).on( "click", "tr", function() {        
        $('.input-tambah-item_id').val($(this).children().html());
        $('.input-tambah-kodebarang').val($(this).children().next().html());
        $('.input-tambah-nama').val($(this).children().next().next().html());
    });
    $( document ).on( "inputchange", ".me-change", function() {        
        ajaxitem();
    });


<?php } ?>