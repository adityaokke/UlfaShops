<?php

class HargaunitsController extends AppController
{	
	

	public $layout = "basic";

	public $theme = "tema1";

	public $components = array('Paginator');

	public $uses = array('Itemtoko','Unit','Hargaunit');

	public $helpers = array('Session');
	



	public function beforeFilter() {

	    parent::beforeFilter('');

	    $this->Auth->allow('index','add','edit','delete');

	}

	

	public function isAuthorized($user) {

		if(isset($user['role']) && $user['role'] === 'manager toko') {

			return true;

		}

		return false;

	}

    

	public function index(){

		$this->set("title", 'Daftar Harga');

		

		$this->Paginator->settings = array(

					'limit' => 5,

					'order' => array('Hargaunit.id' => 'asc'),

					'recursive'=>-1

				);

		$datas = $this->Paginator->paginate('Hargaunit');

		debug($datas);

		$this->set(compact('datas'));

	}



	

	public function add() {

		$this->set("title", 'Tambah Hargaunit');

		if ($this->request->is('post')) {

			// lakukan operasi insert

			$this->Hargaunit->create();

			if ($this->Hargaunit->save($this->request->data)) {

				// jika insert berhasil

				$this->Session->setFlash('Tambah Hargaunit berhasil!', 

										 'default',

										 array('class'=>'success'));

				$this->redirect(array('action' => 'index'));

			} else {

				// jika insert gagal

				// tetap tampilkan form

				// flash default adalah 'bad'

				$this->Session->setFlash('Ada kesalahan INSERT data Hargaunit.');

			}

		}

	}



	public function delete($id = null) {

		if ($this->request->is('post')) {

			if ($id) {

				$data = $this->Pembeli->findById($id);

				

				$this->Pembeli->id = $id;

				if ($this->Pembeli->delete()) {

					$this->Session->setFlash('Data sudah terhapus', 'default',

											array('class'=>'success'));

				}

			}

		}

		$this->redirect(array('action'=>'index'));

	}



	public function edit($id = null){

		$this->set('title', 'Edit Pembeli');

		if ($this->request->is('post')) {

			// lakukan operasi UPDATE				

			if ($this->request->data) {

				$this->Pembeli->id = $this->request->data['Pembeli']['id'];

				if ($this->Pembeli->save($this->request->data)) {

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

					$data = $this->Pembeli->read(null, $id);

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