<?php
if (strtolower($this->params['controller']) === 'daftarkirims') {
?>
	$(document).on('click','.edit',function(){
		$(this).html('Simpan');
		$(this).attr("class","save");
		$('.input_select'+$(this).parent().parent().attr('class')).removeAttr("disabled");
		$('.input_select'+$(this).parent().parent().attr('class')).css("background-color","rgb(255,255,255)");
		

	});

	$(document).on('click','.save',function(){
		$(this).html('Edit');
		$(this).attr("class","edit");
		$('.input_select'+$(this).parent().parent().attr('class')).attr("disabled","disabled");
		$('.input_select'+$(this).parent().parent().attr('class')).css("background-color","rgb(235, 235, 228)");
	});

	$('.submit').hide();
	if($("#status").html()=="sampai")
	$('.save-edit-daftar').hide();
	
    $('.save-edit-daftar').on('click',function(){        	
        $('.editdaftarkirimform').submit();
    });
    
    $('.editdaftarkirimform').on('submit',function(event){
    	if($("#status").html()=="sampai")    	
    		event.preventDefault();    	
    	else{
			$('input').removeAttr("disabled");
	       	$('select').removeAttr("disabled");
    	}       	
    });


    //hapus
    $( document ).on( "click", ".hapus", function() {        
        alert("a");
        var tamp=$(this).parent().parent().attr("class");
        $(this).parent().parent().remove();
    });
//

<?php
}
?>