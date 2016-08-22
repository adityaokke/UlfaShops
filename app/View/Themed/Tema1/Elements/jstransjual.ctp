<?php

if (strtolower($this->params['controller']) === 'transjuals') {

?>

$(document).keypress(function(e){

    if(e.charCode==43){    

        if($(".input-kode-barang").val()!='' && tampdata['Itemtoko']){

            kodebarang=$(".input-kode-barang").val();

            unit=$(".input-unit-barang").val();

            $(".input-kode-barang").focus();
         
            var data='';
            data+='<tr class="'+no+'">';
            data+='<td>'+(no+1)+'<!-- <a class="edit">edit</a> --><a class="hapus">| hapus</a></td>';
            data+='<td><div class="input text"><label for="Transjual'+no+'Kode"></label><input name="data[Transjual]['+no+'][kode]" class="input_select" value="'+$(".input-kode-barang").val()+'" disabled="disabled" id="Transjual'+no+'Kode" type="text"></div></td>';
            data+='<td><div class="input text"><label for="Transjual'+no+'Nama"></label><input name="data[Transjual]['+no+'][nama]" class="input_select" disabled="disabled" value="'+$(".input-nama-barang").val()+'" id="Transjual'+no+'Nama" type="text"></div></td>';
            data+='<td><div class="input text"><label for="Transjual'+no+'Isi"></label><input name="data[Transjual]['+no+'][isi]" class="input_select formatAngka" disabled="disabled" value="'+$(".input-isi-barang").val()+'" id="Transjual'+no+'Isi" type="text"></div></td>';
            data+='<td><div class="input number"><label for="Transjual'+no+'Quantity"></label><input name="data[Transjual]['+no+'][quantity]" class="input_select" value="'+$(".input-jumlah-barang").val()+'" disabled="disabled" id="Transjual'+no+'Quantity" type="number"></div></td>';
            data+='<td><div class="input select"><label for="Transjual'+no+'Unit"></label><select name="data[Transjual]['+no+'][unit]" class="input_select me-disabled" value="'+$(".input-unit-barang").val()+'" default="'+$(".input-unit-barang").val()+'" disabled="disabled" id="Transjual'+no+'Unit">';
            data+=$('#unitdumb').html();
            data+='</select></div></td>';
            data+='<td><div class="input text"><label for="Transjual'+no+'Harga"></label><input name="data[Transjual]['+no+'][harga]" class="input_select formatAngka" disabled="disabled" value="'+$(".input-harga-barang").val()+'" id="Transjual'+no+'Harga" type="text"></div></td>';
            data+='<td><div class="input text"><label for="Transjual'+no+'Total"></label><input name="data[Transjual]['+no+'][total]" class="input_select formatAngka" disabled="disabled" value="'+$(".input-total-barang").val()+'" id="Transjual'+no+'Total" type="text"></div></td>';
            data+='<input name="data[Transjual]['+no+'][itemtoko_id]" class="input_select" disabled="disabled" value="'+tampdata['Itemtoko']['id']+'" id="Transjual'+no+'ItemtokoId" type="hidden"><input name="data[Transjual]['+no+'][keuntungan]" class="input_select" disabled="disabled" value="'+$(".input-untung-total-barang").val()+'" id="Transjual'+no+'Keuntungan" type="hidden"></tr>';                       
                                               
                    
            $(".last-row-nota-jual").after(data);
            

            untung_total+=parseInt(replaceChars($('#Transjual'+no+'Keuntungan').val()));

            $('.untung-harga').val(untung_total);



            $("#Transjual"+no+"Unit option[value='"+$(".input-unit-barang").val()+"']").attr('selected','selected');

            $('.view-total-harga-transaksi').html($(".input-nama-barang").val()+"<br>Rp. "+$(".input-total-barang").val()+",00");



            harga_total+=parseInt(replaceChars($("#Transjual"+no+"Total").val()));

            $('.total-harga').val(harga_total);

            $('.view-total-semua-harga-transaksi').html('Total Keseluruhan Item'+"<br>Rp. "+harga_total+",00");

            $('.show_total').html(harga_total);



            $(".input-kode-barang").val("");

            $(".input-nama-barang").val("");

            jumlah_total+=$(".input-jumlah-barang").val();

            $(".input-jumlah-barang").val("");





            $(".input-harga-barang").val("");

            $(".input-total-barang").val("");

            $(".input-unit-barang").val(0);

            no++;

            jmlh_item++;



              
        }            

    }

});

<?php if (strtolower($this->params['action']) === 'index') { ?>

$('.submit').hide();

var jmlh_item=0;

var daftar_kode=[];

<?php if($this->params['pass']){ ?>

    findPrinter();

    var url=$('.url').html().split('/');

        var cetak="";

        if(url.length!=0){

            setTimeout(function() {

                $.ajax({

                    dataType: 'json',

                    url: '<?php echo $this->Html->url(array('action'=>'cetak')); ?>'+'/'+url[0]+'/'+url[1]+'/'+url[2]

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

                    printEPL(cetak,1);
                    
                    

                });  

            }, 1000);

            

        }

<?php } ?>


$.ajax({

    type: "POST",

    data:{},

    url: "<?php echo $this->base;?>/transjuals/daftar_barang/",

    success:function(data) {  

        

        $(".tabel-nota-jual").before(data);                

        $( ".data" ).each(function( index ) {

          daftar_kode.push({ value: $(this).html(), data: $(this).html() });

        });

        $('.daftar_barang').remove();

        $('#autocomplete').autocomplete({

            lookup: daftar_kode,

            onSelect: function (suggestion) {

              var thehtml = '<strong>Currency Name:</strong> ' + suggestion.value + ' <br> <strong>Symbol:</strong> ' + suggestion.data;

              $('#outputcontent').html(thehtml);

                //console.log(daftar_kode);

            }

        });

    }

}); 



<?php } ?>

//variabel

    var kodebarang="";

    var jumlah;

    var unit;

    var harga_total=0;

    var jumlah_total=0;

    var untung_total=0;

    var hutang=0;

    var bayar=0;

    var autocomplete_data;

    var no=0;

    var okke=false;

////





    $('#ModalPembeli').modal('show');

    $(".ok_form_pembeli").on('click',function(){

        $('#ModalPembeli').modal('hide');         

    });     

    $(".no_form_pembeli").on('click',function(){

        $('#ModalPembeli').modal('hide');                    

    });



$(".input-unit-barang").val(0);

    $('.submit').hide();

    $('.hutang').hide();



    $('.cetak-nota-jual').on('click',function(){        

        $('#TransjualAddForm').submit();

    });

    

$('#TransjualAddForm').submit(function(event){

    $('.show_total').html($('.total-harga').val());    

    



    if(jmlh_item!=0)

    if(!okke)

    $('#myModal').modal('show');



    //return false;

    

    setTimeout(function() {

          $(".potong-dummy-harga").focus();

    }, 1000);

    



    $(".ok_form").on('click',function(){

        $('#myModal').modal('hide'); 

        $('.input_select').removeAttr("disabled");

            $(".formatAngka").each(function(){

                $(this).val(replaceChars($(this).val()));

            });

        okke=true;

        var untung_dummy=$('.untung-harga').val();

        untung_dummy=untung_dummy-parseInt(replaceChars($(".potong-dummy-harga").val()));

        if(untung_dummy<0) untung_dummy=0;

        $('.untung-harga').val(untung_dummy);

        $('.bayar-harga').val(parseInt(replaceChars($(".bayar-dummy-harga").val())));

        //$('.kembali-harga').val($(".show_kembali").html());

        //$( "#TransjualAddForm" ).unbind("submit");

        $( "#TransjualAddForm" ).submit();

    });     

    $(".no_form").on('click',function(){

        $('#myModal').modal('hide');                    

    });

    if(!okke)

    event.preventDefault();

});





    $('.bayar-nota-jual').on('click',function(){

        $(".potong-dummy-harga").focus();

    });

        

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

                    $(this).val(formatAngka($(this).val()));

                });                

                $('.show_kembali').html(formatAngka($(".kembali-harga").val()));

                $(".show_hutang").html(formatAngka($(".hutang-harga").val()));

            }, 20));

        },

        teardown: function() {

            window.clearInterval( $.data(this, 'timer') );

        },

        add: function() {

            $.data(this, 'cache', this.value);

        }

    };



    var tampdata;

    $(".jatuh-tempo").hide();

    $(".hutang-harga").on('inputchange', function() {

        if($(".hutang-harga").val()>0){

            $(".jatuh-tempo").show();

        }

        else $(".jatuh-tempo").hide();

    }); 



    $(".input-kode-barang").on('inputchange', function() {

        //$( "form:first" ).trigger( "submit" );

        



        var kodebarang=$(".input-kode-barang").val();

        if(!kodebarang){

            kodebarang="tidak_ada";

        };

        

        $.ajax({

            dataType: 'json',

            url: '<?php echo $this->Html->url(array('action'=>'getdatainput')); ?>/'+kodebarang

        }).done(function(datas){

            tampdata=datas

            //console.log(datas);

            if(datas['Item']['nama'])
            $(".input-nama-barang").val(datas['Item']['nama']);



            if(datas['Item']['nama'])

            {               

                //var objuntung=$(".input-unit-barang").children().first().next();

                $(".input-jumlah-barang").val("1");

                $(".input-unit-barang").val($(".input-unit-barang").children().first().val());

                $(".input-isi-barang").val(

                    datas['Unit'][$(".input-unit-barang").val()]

                    );   

                datas['Hargaunit'].forEach(function(data){

                    ////console.log(data['unit_id']);

                    /*

                    $(".input-unit-barang").children().each(function(){

                            if($(this).val()==data['unit_id'])

                                $(this).attr('untung',data['untung']);

                        });

                        */

                        //console.log(data);

                    if(data['unit_id']==$(".input-unit-barang").val()){

                        

                        $(".input-untung-barang").val(

                        data['untung']

                        );

                        $(".input-harga-barang").val(

                        data['harga']

                        );



                        //objuntung.attr('untung',data['untung']);



                        $(".input-total-barang").val('0');



                        if($('.input-unit-barang').val()!=null){

                            $(".input-total-barang").val(replaceChars(data['harga'])*replaceChars($(".input-jumlah-barang").val()));

                            $(".input-untung-total-barang").val(replaceChars(data['untung'])*replaceChars($(".input-jumlah-barang").val()));

                        }

                                            



                    }

                });                

                //$(".input-unit-barang").children().first().attr("selected","selected");

            }            

            else

            {            

                $(".input-jumlah-barang").val("");   

                $(".input-harga-barang").val("");

                $(".input-untung-barang").val("");

                $(".input-unit-barang").val("0");

                $(".input-isi-barang").val("");  

                $(".input-total-barang").val("");



            }

        });   

    });



    $(".input-jumlah-barang").on('inputchange',function(){        

        if($(".input-jumlah-barang").val()){

            replaceChars($(".input-total-barang").val(

                replaceChars($(".input-harga-barang").val())*parseFloat($(".input-jumlah-barang").val())

            ));

            replaceChars($(".input-untung-total-barang").val(

                replaceChars($(".input-untung-barang").val())*parseFloat($(".input-jumlah-barang").val())

            ));


            replaceChars($(".input-isi-barang").val(

                    replaceChars(tampdata['Unit'][$(".input-unit-barang").val()]*parseFloat($(".input-jumlah-barang").val())

            )));

            //console.log(tampdata['Unit'][$(".input-unit-barang").val()]);

        }            

    });



    $(".input-harga-barang").on('inputchange',function(){        

        if($(".input-harga-barang").val()){

            replaceChars($(".input-total-barang").val(
                replaceChars($(".input-harga-barang").val())*parseFloat($(".input-jumlah-barang").val())
            ));

            replaceChars($(".input-untung-total-barang").val(
                replaceChars($(".input-untung-barang").val())*parseFloat($(".input-jumlah-barang").val())
            ));

            replaceChars($(".input-isi-barang").val(

                    replaceChars(tampdata['Unit'][$(".input-unit-barang").val()]*parseFloat($(".input-jumlah-barang").val())

            )));

            //console.log(tampdata['Unit'][$(".input-unit-barang").val()]);

        }            

    });



    $(".potong-harga").val($(".potong-dummy-harga").val());        

    $("#jatuhtempoMonth").val($("#jatuhtempodummyMonth").val());

    $("#jatuhtempoDay").val($("#jatuhtempodummyDay").val());

    $("#jatuhtempoYear").val($("#jatuhtempodummyYear").val());

    $(".pembeli").val("nn");

    $(".pembeli-dummy").on('inputchange',function(){

        $(".pembeli").val($(".pembeli-dummy").val());

    });

    $(".potong-dummy-harga").on('inputchange',function(){

        $(".potong-harga").val($(".potong-dummy-harga").val());

    });

    $("#jatuhtempodummyMonth").on('inputchange',function(){        

        $("#jatuhtempoMonth").val($("#jatuhtempodummyMonth").val());

    });

    $("#jatuhtempodummyDay").on('inputchange',function(){

        $("#jatuhtempoDay").val($("#jatuhtempodummyDay").val());

    });

    $("#jatuhtempodummyYear").on('inputchange',function(){

        $("#jatuhtempoYear").val($("#jatuhtempodummyYear").val());

    });

    

    $(".input-unit-barang").on('inputchange',function(){

        ////console.log(tampdata);

        if($(".input-unit-barang").val()!=''){

            $(".input-isi-barang").val(Math.ceil(tampdata['Unit'][$(".input-unit-barang").val()]*parseFloat($(".input-jumlah-barang").val())));   

            tampdata['Hargaunit'].forEach(function(data){

                if(data['unit_id']==$(".input-unit-barang").val()){

                    replaceChars($(".input-harga-barang").val(

                    data['harga']

                    ));

                    replaceChars($(".input-untung-barang").val(

                    data['untung']

                    ));

                    ////console.log(data['untung']);

                }

            });

            $(".input-total-barang").val(

                replaceChars($(".input-harga-barang").val())*parseFloat($(".input-jumlah-barang").val())

            );
            $(".input-untung-total-barang").val(

                replaceChars($(".input-untung-barang").val())*parseFloat($(".input-jumlah-barang").val())

            );
        }            

        else

        {            

            $(".input-total-barang").val("");

             $(".input-untung-total-barang").val("");

        }

    });



    /* $(".tambah-nota-jual").on('click', function() {

    });*/ 

 

    var sisa=0;

    $(".bayar-dummy-harga").on('inputchange',function(){

        if($(".bayar-dummy-harga").val()!=''){

            sisa=parseInt(parseInt(replaceChars($(".bayar-dummy-harga").val()))+parseInt(replaceChars($(".potong-dummy-harga").val()))-parseInt(replaceChars($(".total-harga").val())));

            if(sisa<0){

                $(".kembali-harga").val('0');

                $(".hutang-harga").val(parseInt(replaceChars($(".total-harga").val()))-parseInt(replaceChars($(".potong-dummy-harga").val()))-parseInt(replaceChars($(".bayar-dummy-harga").val())));

                    $('.hutang').show();                

            }

            else{

                $(".hutang-harga").val(0);

                $(".kembali-harga").val(sisa);

                $('.hutang').hide();

            }

        }else{

                $(".hutang-harga").val(0);

                $('.hutang').hide();

                $(".kembali-harga").val(0);

        }

        

    });

    $(".potong-dummy-harga").on('inputchange',function(){

        if($(".bayar-dummy-harga").val()!=''){

            sisa=parseInt(parseInt(replaceChars($(".bayar-dummy-harga").val()))+parseInt(replaceChars($(".potong-dummy-harga").val()))-parseInt(replaceChars($(".total-harga").val())));

            if(sisa<0){

                $(".kembali-harga").val('0');

                $(".hutang-harga").val(parseInt(replaceChars($(".total-harga").val()))-parseInt(replaceChars($(".potong-dummy-harga").val()))-parseInt(replaceChars($(".bayar-dummy-harga").val())));

                    $('.hutang').show();                

            }

            else{

                $(".hutang-harga").val(0);

                $(".kembali-harga").val(sisa);

                $('.hutang').hide();

            }

        }else{

                $(".hutang-harga").val(0);

                $('.hutang').hide();

                $(".kembali-harga").val(0);

        }

        

    });

//edit    

    /*$( document ).on( "click", ".hapus", function() {        

        var id=$(this).parent().parent().attr("class");

        $('#Transjual'+id+'Kode').removeAttr("disabled");

        $('#Transjual'+id+'Quantity').removeAttr("disabled");

        $('#Transjual'+id+'Unit').removeAttr("disabled");

        //console.log();

    });*/

//



//hapus

    $( document ).on( "click", ".hapus", function() {        

        var tamp=$(this).parent().parent().attr("class");

        //console.log(tamp);

        harga_total-=parseInt(replaceChars($("#Transjual"+tamp+"Total").val()));

        $('.total-harga').val(harga_total);

        

        untung_total-=parseInt(replaceChars($('#Transjual'+tamp+'Keuntungan').val()));

        $('.untung-harga').val(untung_total);

        $(this).parent().parent().remove();

        jmlh_item--;



        $('.view-total-semua-harga-transaksi').html('Total Keseluruhan Item'+"<br>Rp. "+harga_total+",00");

        $('.show_total').html(harga_total);

    });

//



//formatAngka

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

//   

    

        

    

  



<?php } ?>

