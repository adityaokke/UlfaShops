<?php

if (strtolower($this->params['controller']) === 'returs') {

?>

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

 
	$(".hutang-harga").on('inputchange', function() {

    }); 

<?php } ?>