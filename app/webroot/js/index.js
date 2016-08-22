$(document).ready(function(){
		$('.focusme').focus();
		$(document).bind('keydown', 'shift+n', function assets() {
                      $(".paging").focus();
		});
        $('body, input').bind('keydown', 'alt+n', function assets() {
        			  $(".searchnamai").focus(); 
		});
		$(document).bind('keydown', 'alt+k', function assets() {

                      $(".searchkodei").focus(); 
		});
		$('body, input').bind('keydown', 'alt+g', function assets() {
                      window.location.href = "http://"+ document.domain +"/cake-php/Gudangs";
		});
		$('body, input').bind('keydown', 'alt+q', function assets() {
                     $("#addtransaksi").focus();
		});
		$('body, input').bind('keydown', 'alt+i', function assets() {
                      window.location.href = "http://"+ document.domain +"/cake-php/Item";
		});
		$('body, input').bind('keydown', 'alt+K', function assets() {
                      window.location.href = "http://"+ document.domain +"/cake-php/Kategori";
		});
		$('body, input').bind('keydown', 'alt+n', function assets() {
                      window.location.href = "http://"+ document.domain +"/cake-php/Notabeli";
		});
		
		$('body, input').bind('keydown', 'alt+t', function assets() {
                      $("#tambah").focus();
		});
		
		$('body, input').bind('keydown', 'alt+c', function assets() {
                      $("#search").focus();
		});
		$(document).bind('keydown', 'alt+s', function assets() {
                      $("form").focus();
		});
    });