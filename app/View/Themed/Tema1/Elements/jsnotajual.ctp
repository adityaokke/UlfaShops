<?php

if (strtolower($this->params['controller']) === 'notajuals') {

    ?>

<?php if (strtolower($this->params['action']) === 'index'||strtolower($this->params['action']) === 'detil') { ?>
    $(".cetaknota").on('click', function() {       
    
    findPrinter();
        var cetak='';
        $.ajax({

            dataType: 'json',

            url: '<?php echo $this->Html->url(array('controller'=>'transjuals','action'=>'cetak')); ?>'+'/'+$(this).attr('idnota')+'/'+0+'/'+0

        }).done(function(datas){       

            var tamp=datas['Notajual']['tanggal'].split('-');

            cetak+='Tanggal : '+tamp[2]+'-'+tamp[1]+'-'+tamp[0]+'\tNo.Nota : '+datas['Notajual']['id']+'\n';

            if(datas['Notajual']['pembeli']!='nn')

            cetak+='Kepada Yth. '+datas['Notajual']['pembeli']+'\n'

            cetak+='----------------------------------------\n';

            var no=1;

            datas['Trans'].forEach(function(data){

                cetak+=no+') '+data['kode']['Item']['kodebarang']+' '+data['kode']['Item']['nama'].substring(0,39-(2+data['kode']['Item']['kodebarang'].length+no.toString().length))+'\n';

                cetak+='   '+data['Transjual']['quantity']+' biji | '+data['Transjual']['jumlah_unit']+' x '+formatAngka(data['harga'][data['Transjual']['unit']])+'    '+formatAngka(data['Transjual']['total_harga_jual'])+'\n';

                no++;

            });  

            cetak+='----------------------------------------\n';

            cetak+='\t      Total\t'+formatAngka(datas['Notajual']['harga_total'])+'\n';

            if(datas['Notajual']['potong']!='0')

            cetak+='\t      Potong\t'+formatAngka(datas['Notajual']['potong'])+'\n';

            if(datas['Notajual']['hutang']!='0')

            cetak+='\t      Hutang\t'+formatAngka(datas['Notajual']['hutang'])+'\n';

            cetak+='\t      Bayar\t'+formatAngka(datas['bayar'])+'\n';

            if(datas['Notajual']['hutang']=='0')

            cetak+='\t      Kembali\t'+formatAngka(datas['kembali'])+'\n';

            var tamp=datas['Notajual']['jatuh_tempo'].split('-');

            if(datas['Notajual']['hutang']!='0')

            cetak+='      Jatuh Tempo : '+tamp[2]+'-'+tamp[1]+'-'+tamp[0]+'\n';

            //console.log(cetak);

            printEPL(cetak,2);

        });  
    });   
        
<?php } ?>


    $(".me-hide-index").hide();

    $.event.special.inputchange = {

        setup: function() {

            var self = this, val;

            $.data(this, 'timer', window.setInterval(function() {

                val = self.value;

                if ( $.data( self, 'cache') != val ) {

                    $.data( self, 'cache', val );

                    $( self ).trigger( 'inputchange' );

                }                

                $(".formatAngka").each(function(){

                    $(this).html(formatAngka($(this).html()));

                });

            }, 20));

        },

        teardown: function() {

            window.clearInterval( $.data(this, 'timer') );

        },

        add: function() {

            $.data(this, 'cache', this.value);

        }

    };

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

    function formatAngka(angkaInput) {

        var angka=replaceChars(angkaInput);

        if (typeof(angka) != 'string') angka = angka.toString();

            var reg = new RegExp('([0-9]+)([0-9]{3})');

        while(reg.test(angka)) angka = angka.replace(reg, '$1.$2');

        return angka;

    }
    <?php if (strtolower($this->params['action']) === 'edit_transjual'||strtolower($this->params['action']) === 'add_transjual') {    ?>
        
        var tampdata;
        var kodebarang=$(".input-tambah-kodebarang").val();
        $.ajax({

            dataType: 'json',

            url: '<?php echo $this->Html->url(array('controller'=>'transjuals','action'=>'getdatainput')); ?>/'+kodebarang

        }).done(function(datas){

            tampdata=datas;
            tampdata['Hargaunit'].forEach(function(data){

                if(data['unit_id']==$(".input-edit-unit").val()){

                    replaceChars($(".input-edit-harga-barang").val(

                    data['harga']

                    ));

                    replaceChars($(".input-edit-untung-barang").val(

                    data['untung']

                    ));

                }

            });
    

        });   
    
        $(".reset").on('click', function() {
            $(".input-tambah-kodebarang").val($(".input-tambah-kodebarang-asli").val());
        });

        $(".input-tambah-kodebarang").on('inputchange', function() {

            var kodebarang=$(".input-tambah-kodebarang").val();

            if(!kodebarang){

                kodebarang="tidak_ada";
                
            };

            $.ajax({

                dataType: 'json',

                url: '<?php echo $this->Html->url(array('controller'=>'transjuals','action'=>'getdatainput')); ?>/'+kodebarang

            }).done(function(datas){

                tampdata=datas

                $(".input-tambah-nama").val(datas['Item']['nama']);


                if(datas['Item']['nama'])
                {               
                    $(".input-tambah-item_id").val(datas['Itemtoko']['id']);
                    datas['Hargaunit'].forEach(function(data){
   
                        if(data['unit_id']==$(".input-edit-unit").val()){

                            $(".input-edit-untung-barang").val(

                            data['untung']

                            );

                            $(".input-edit-harga-barang").val(

                            data['harga']

                            );

                            if($('.input-edit-unit').val()!=null){

                                $(".input-total-barang").val(replaceChars(data['harga'])*replaceChars($(".input-edit-jumlah").val()));

                                $(".input-edit-keuntungan").val(replaceChars(data['untung'])*replaceChars($(".input-edit-jumlah").val()));

                            }

                                                



                        }

                    });                

                    $(".input-unit-barang").children().first().attr("selected","selected");

                    if(!$(".input-edit-jumlah").val()){
                        $(".input-edit-jumlah").val(1);
                    }

                }            

                else{          

                    



                }

            });   

        });


        $(".input-edit-jumlah").on('inputchange',function(){        

            if($(".input-edit-jumlah").val()){

                replaceChars($(".input-edit-hargatotal").val(

                    replaceChars($(".input-edit-harga-barang").val())*parseFloat($(".input-edit-jumlah").val())

                ));

                replaceChars($(".input-edit-keuntungan").val(

                    replaceChars($(".input-edit-untung-barang").val())*parseFloat($(".input-edit-jumlah").val())

                ));


                replaceChars($(".input-edit-isi").val(

                        replaceChars(tampdata['Unit'][$(".input-edit-unit").val()]*parseFloat($(".input-edit-jumlah").val())

                )));

                //console.log(tampdata['Unit'][$(".input-unit-barang").val()]);

            }            

        });


        $(".input-edit-harga-barang").on('inputchange',function(){        

            if($(".input-edit-harga-barang").val()){

                replaceChars($(".input-edit-hargatotal").val(
                    replaceChars($(".input-edit-harga-barang").val())*parseFloat($(".input-edit-jumlah").val())
                ));

                replaceChars($(".input-edit-keuntungan").val(
                    replaceChars($(".input-edit-untung-barang").val())*parseFloat($(".input-edit-jumlah").val())
                ));

                replaceChars($(".input-edit-isi").val(

                        replaceChars(tampdata['Unit'][$(".input-edit-unit").val()]*parseFloat($(".input-edit-jumlah").val())

                )));

                //console.log(tampdata['Unit'][$(".input-unit-barang").val()]);

            }            

        });

        $(".input-edit-unit").on('inputchange',function(){

            if($(".input-edit-unit").val()!=''){

                $(".input-edit-isi").val(Math.ceil(tampdata['Unit'][$(".input-edit-unit").val()]*parseFloat($(".input-edit-jumlah").val())));   

                tampdata['Hargaunit'].forEach(function(data){

                    if(data['unit_id']==$(".input-edit-unit").val()){

                        replaceChars($(".input-edit-harga-barang").val(

                        data['harga']

                        ));

                        replaceChars($(".input-edit-untung-barang").val(

                        data['untung']

                        ));

                    }

                });

                $(".input-edit-hargatotal").val(

                    replaceChars($(".input-edit-harga-barang").val())*parseFloat($(".input-edit-jumlah").val())

                );
                $(".input-edit-keuntungan").val(

                    replaceChars($(".input-edit-untung-barang").val())*parseFloat($(".input-edit-jumlah").val())

                );
            }            

            else

            {            

                $(".input-edit-hargatotal").val("");

                 $(".input-edit-keuntungan").val("");

            }

        });

    <?php } ?>

    <?php if (strtolower($this->params['action']) === 'laporan') {    ?>

        $(".mat").html(formatAngka($(".mat").html()));

        $(".mat1").html(formatAngka($(".mat1").html()));

        $(".mat2").html(formatAngka($(".mat2").html()));

        $(".mat3").html(formatAngka($(".mat3").html()));

        $(".mat4").html(formatAngka($(".mat4").html()));

    <?php } ?>



    <?php if (strtolower($this->params['action']) === 'stokitem') {    ?>

        $('#FilterKode').focus();

        var html = $("#FilterKode").val();

        $("#FilterKode").focus().val("").val(html);



        var SearchInput = $('#FilterKode');



        // Multiply by 2 to ensure the cursor always ends up at the end;

        // Opera sometimes sees a carriage return as 2 characters.

        if(SearchInput)

        var strLength= SearchInput.val().length * 2;



        SearchInput.focus();

    <?php } ?>

    <?php if (strtolower($this->params['action']) === 'index') {    ?>

        $('#FilterSearch').focus();

        var html = $("#FilterSearch").val();

        $("#FilterSearch").focus().val("").val(html);

        var SearchInput = $('#FilterSearch');

        // Multiply by 2 to ensure the cursor always ends up at the end;

        // Opera sometimes sees a carriage return as 2 characters.

        if(SearchInput)

        var strLength= SearchInput.val().length * 2;

        SearchInput.focus();

    <?php } ?>

    <?php if (!strtolower($this->params['action']) === 'laporan') {    ?>

        SearchInput[0].setSelectionRange(strLength, strLength);

    <?php } ?>


    $(".me-change-index").on("inputchange",function(){    

        $( "form:first" ).trigger( "submit" );

    });

    

    $(".me-change-tanggal-index").on("change",function(){    

        $( "form:first" ).trigger( "submit" );

    });

    

    if($(".status").val()=='2'){

        $('.hutang-option').show();

    }else{

        $('.hutang-option').hide();

    }

    if($(".order").val()=='0'){

        $('.tanggalindex').hide();

    }else{

        $('.tanggalindex').show();

    }

    $(".status").on("inputchange",function(){    

        if($(".status").val()=='2'){

            $('.hutang-option').show();

        }else{

            $('.hutang-option').hide();

        }

    });



    $(".order").on("change",function(){    

        if($(".order").val()=='0'){

            $('.tanggalindex').hide();

        }else{

            $('.tanggalindex').show();

        }

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

            $('.ajax-view').html('<table><thead><tr><td>Kode Barang</td><td>Nama</td></tr></thead><tbody></tbody></table>')

            var temp='';

            datas.forEach(function(data){

                temp+='<tr><td class="hide hasil-id">'+data['Itemtoko']['id']+'</td><td class="hasil-kodebarang">'+data['Item']['kodebarang']+'</td><td class="hasil-nama">'+data['Item']['nama']+'</td></tr>';

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


    <?php 
} 
?>