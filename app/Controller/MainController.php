<?php
class MainController extends AppController{
	
	public function index()
	{

	}
	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index');
    }
    
}
?>