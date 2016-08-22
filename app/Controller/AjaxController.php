<?php
class AjaxController extends AppController {
   var $name = 'Ajax';
   var $uses = NULL;

   public function helloAjax()
   {
       $this->layout='ajax';
       // result can be anything coming from $this->data
       $result =  'Hello Dolly!';
       $this->set("result", $result);
   }
}

?>