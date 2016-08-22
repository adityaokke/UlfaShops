<?php

class UnitsController extends AppController

{	

	public $layout = "basic";

	public $theme = "tema1";

	public $components = array('Paginator');

	public $uses = array('Unit');

	public $helpers = array('Session');





	public function beforeFilter() {

	    parent::beforeFilter();

	    $this->Auth->allow('index','add','edit','delete');

	}

	

	public function isAuthorized($user) {

		if(isset($user['role']) && $user['role'] === 'manager toko') {

			return true;

		}

		return false;

	}

    

	public function index(){

		$this->set("title", 'Daftar Jenis Unit');

		

		$this->Paginator->settings = array(

					'limit' => 5,

					'order' => array('Unit.id' => 'desc')

				);

		$datas = $this->Paginator->paginate('Unit');

		////debug($datas);

		$this->set(compact('datas'));

	}



	

	public function add() {

		$this->set("title", 'Tambah Jenis Unit');

		if ($this->request->is('post')) {

			// lakukan operasi insert

			$this->Unit->create();

			//$this->request->data['Hargaunit']['harga']=$this->request->data['Unit']['Harga'];

			if ($this->Unit->save($this->request->data)) {

						$this->Session->setFlash('Tambah Unit berhasil!', 

										 'default',

										 array('class'=>'success'));					

				// jika insert berhasil

				$this->redirect(array('action' => 'index'));				

			} else {

				// jika insert gagal

				// tetap tampilkan form

				// flash default adalah 'bad'

				$this->Session->setFlash('Ada kesalahan INSERT data Unit.');

			}

		}

	}



	public function delete($id = null) {

		if ($this->request->is('post')) {

			if ($id) {

				$data = $this->Unit->findById($id);

				

				$this->Unit->id = $id;

				if ($this->Unit->delete()) {

					$this->Session->setFlash('Data sudah terhapus', 'default',

											array('class'=>'success'));

				}

			}

		}

		$this->redirect(array('action'=>'index'));

	}



	public function edit($id = null){

		$this->set('title', 'Edit Unit');

		if ($this->request->is('post')) {

			// lakukan operasi UPDATE				

			if ($this->request->data) {

				$this->Unit->id = $this->request->data['Unit']['id'];

				if ($this->Unit->save($this->request->data)) {

					$this->Session->setFlash('Sunting data telah tersimpan.',

											 'default',

											 array('class'=>'success'));

					$this->redirect(array('action'=>'index'));

				} else {

					$this->Session->setFlash('Maaf, sunting data gagal.');

				}

			} else {

				$this->Session->setFlash('Permintaan tidak valid.');

			}

			$this->redirect(array('action'=>'index'));

		} else {

			if ($id) {

				try {

					$data = $this->Unit->read(null, $id);

					//$this->set(compact('data'));

					$this->request->data = $data;

				} catch (NotFoundException $ex) {

					$this->Session->setFlash('Data tidak ditemukan.');

					$this->redirect(array('action'=>'index'));

				}

			} else {

				$this->Session->setFlash('Permintaan tidak valid.');

				$this->redirect(array('action'=>'index'));

			}

		}

	}



}

?>