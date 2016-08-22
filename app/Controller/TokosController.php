<?php
	class TokosController extends AppController
	{	

		public $layout = "basic";

		public $theme = "tema1";

		public $components = array('Paginator','RequestHandler');

		public $uses = array('Toko','Itemtoko','Item');

		public $helpers = array('Session');





		public function beforeFilter() {

		    parent::beforeFilter();
		    $this->Auth->allow('');

		}

		

		public function isAuthorized($user) {

			if(isset($user['role']) && $user['role'] === 'owner') {

				return true;

			}

			else if(in_array($this->action, array('index'))) {

				if(isset($user['role']) && $user['role'] === 'manager toko') {

					return true;

				}
	            return parent::isAuthorized($user);
			}

			return false;

		}



		public function index(){

			

		}

		public function daftartoko($value='')

		{

			$this->set("title", 'Daftar Toko');

			

			$this->Paginator->settings = array(

						'limit' => 5,

						'order' => array('Toko.id' => 'asc'),
						'recursive'=>-1

					);

			$datas = $this->Paginator->paginate('Toko');

			//debug($datas);

			$this->set(compact('datas'));

		}



		public function add() {

			$this->set("title", 'Tambah Toko');

			if ($this->request->is('post')) {

				// lakukan operasi insert

				$this->Toko->create();

				if ($this->Toko->save($this->request->data)) {

					// jika insert berhasil

					$this->Session->setFlash('Tambah Toko berhasil!', 

											 'default',

											 array('class'=>'success'));

					$this->redirect(array('action' => 'daftartoko'));

				} else {

					// jika insert gagal

					// tetap tampilkan form

					// flash default adalah 'bad'

					$this->Session->setFlash('Ada kesalahan INSERT data Toko.');

				}

			}

		}



		public function delete($id = null) {

			if ($this->request->is('post')) {

				if ($id) {

					$data = $this->Toko->findById($id);

					

					$this->Toko->id = $id;

					if ($this->Toko->delete()) {

						$this->Session->setFlash('Data sudah terhapus', 'default',

												array('class'=>'success'));

					}

				}

			}

			$this->redirect(array('action'=>'daftartoko'));

		}



		public function edit($id = null){

			$this->set('title', 'Edit Toko');

			if ($this->request->is('post')) {

				// lakukan operasi UPDATE				

				if ($this->request->data) {

					$this->Toko->id = $this->request->data['Toko']['id'];

					if ($this->Toko->save($this->request->data)) {

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

				$this->redirect(array('action'=>'daftartoko'));

			} else {

				if ($id) {

					try {

						$data = $this->Toko->read(null, $id);

						//$this->set(compact('data'));

						$this->request->data = $data;

					} catch (NotFoundException $ex) {

						$this->Session->setFlash('Data tidak ditemukan.');

						$this->redirect(array('action'=>'daftartoko'));

					}

				} else {

					$this->Session->setFlash('Permintaan tidak valid.');

					$this->redirect(array('action'=>'daftartoko'));

				}

			}

		}
	}
?>