<?php
class MainController extends AppController{
	public function beforeFilter() {
	    parent::beforeFilter();
	    $this->Auth->allow('index','add','edit','delete');
	}
	public function index()
	{

	}
}
?>