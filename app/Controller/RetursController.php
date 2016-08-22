<?php

class RetursController extends AppController

{	

	public $layout = "basic";

	public $theme = "tema1";

	public $components = array('Paginator');

	public $uses = array('Retur','Transjual','Notajual','Itemtoko');

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

		$this->set("title", 'Daftar Retur');

		

		$this->Paginator->settings = array(

					'limit' => 5,

					'order' => array('Retur.id' => 'desc')

				);

		$datas = $this->Paginator->paginate('Retur');

		////debug($datas);

		$this->set(compact('datas'));

	}



	

	public function add() {

		$this->set("title", 'Tambah Retur');

		if ($this->request->is('post')) {

			// lakukan operasi insert
			// debug($this->request->data);
			// $notajual=$this->Notajual->find('first',array(
			// 	'conditions'=>array('Notajual.id'=>$this->request->data['Retur']['notajual_id'],'Notajual.toko_id'=>
			// 						$this->Auth->user('toko_id'))
			// 	));
			// debug($notajual);
			// $itemtoko=$this->Itemtoko->find('first',array(
			// 	'conditions'=>array('Item.kodebarang'=>$this->request->data['Retur']['kodebarang'],'Itemtoko.toko_id'=>
			// 				$this->Auth->user('toko_id')),
			// 	'recursive'=>0
			// 	));
			// debug($itemtoko);
			// debug($this->Auth->user('toko_id'));

			// $transjual=$this->Transjual->find('first',array(
			// 	'recursive'=>2
			// 	));
			// debug($transjual);
			// foreach ($notajual['Transjual'] as $key => $value) {
			// 	if($value['itemtoko_id']===$itemtoko['Itemtoko']['id'])
			// 		$transjual=$value;
			// }
			// debug($transjual);

			// if ($transjual['quantity']) {
			// 	# code...
			// }
			$this->Retur->create();

			// $data = $this->Transjual->find('first');				


			//$this->Transjual->id = $id;

			// if ($this->Transjual->delete()) {

			// 	$this->Session->setFlash('Data sudah terhapus', 'default',

			// 							array('class'=>'success'));

			// }


			//$this->request->data['Hargaunit']['harga']=$this->request->data['Unit']['Harga'];

			if ($this->Retur->save($this->request->data)) {

				$this->Session->setFlash('Tambah Retur berhasil!', 'default', array('class'=>'success'));					

				$this->redirect(array('action' => 'index'));				

			} else {

				$this->Session->setFlash('Ada kesalahan INSERT data');

			}

		}

	}

//JSON -------------------------------------------------------
	public function getdataitem($notajual_id='',$kodebarang='')
	{
		$this->autoRender = false;
		if($this->request->is('ajax'))
		{
			$conditions['AND']=array();
			if ($kode!='tidak_ada') {
				array_push($conditions['AND'],
		                		array('Item.kodebarang LIKE' => '%'.$kode.'%')
		                	);			                	
			}
			if ($nama!='tidak_ada') {
				array_push($conditions['AND'],
		                		array('Item.nama LIKE' => '%'.$nama.'%')
		                	);			                	
			}
			//if($kode!="tidak_ada"){
			$this->Paginator->settings = array(
					'limit' => 5,
					'order' => array('Item.id' => 'asc'),
					'conditions' => $conditions,
					'page'=>$p
				);
			$datas = $this->Paginator->paginate('Item');
				// $datas=$this->Item->find('all',array(
				//  	'conditions' => $this->conditions,//array('Item.kodebarang like "%'.$kode.'%" AND Item.nama like "%'.$nama.'%"'), //array of conditions
				//     'recursive' => 1
				// ));
			// }
			// else{
			// 	$datas['Item']['nama']="";
			// }
			
			if($datas)
			{
				echo json_encode($datas);
			}
			else
			{
				echo json_encode(array());
			}
		}
		else
		{
			$this->redirect(array('action'=>'index'));
		}
	}
// -----------------------------------------------------------

	public function delete($id = null) {

		if ($this->request->is('post')) {

			if ($id) {

				$data = $this->Retur->findById($id);

				

				$this->Retur->id = $id;

				if ($this->Retur->delete()) {

					$this->Session->setFlash('Data sudah terhapus', 'default',

											array('class'=>'success'));

				}

			}

		}

		$this->redirect(array('action'=>'index'));

	}



	public function edit($id = null){

		$this->set('title', 'Edit Retur');

		if ($this->request->is('post')) {

			// lakukan operasi UPDATE				

			if ($this->request->data) {

				$this->Retur->id = $this->request->data['Retur']['id'];

				if ($this->Retur->save($this->request->data)) {

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

					$data = $this->Retur->read(null, $id);

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