<?php

class TransjualsController extends AppController

{	

	public $layout = "basic";

	public $theme = "tema1";

	public $components = array('Paginator');

	public $uses = array('Notajual','Transjual','Item','Itemtoko','Unit','Hargaunit');





	public function beforeFilter() {

	    parent::beforeFilter();

	    $this->Auth->allow('daftartransaksi','getdatainput','getdata','addAll','getdataitemtoko',"daftar_barang","jzebra","cetak");

	}

    public function isAuthorized($user) {

        if (in_array($this->action, array( 'index'))) {

            return true;

        }

        if (in_array($this->action, array('add', 'delete'))) {

            if (isset($user['role']) && $user['role'] === 'owner') {

                return true;

            }

            return false;

        } else if (in_array($this->action, array('edit'))) {

            if (isset($user['role']) &&

                in_array($user['role'], array('owner', 'manager toko', 'manager gudang', 'kasir'))) {

                return true;

            }

            return parent::isAuthorized($user);

        }

        return false;

    }

	public function cetak($id,$bayar,$kembali)

	{

		$this->autoRender = false;

		if($this->request->is('ajax'))

		{			
			$this->Notajual->unbindModel(array('hasMany'=>array('Transjual')));
			$datas=$this->Notajual->find('first',array(

				 	'conditions' => array('Notajual.id like "'.$id.'"'), 
				    'recursive' => 0

				));

			$datas['Trans']=$this->Transjual->find('all',array(

				 	'conditions' => array('Transjual.notajual_id like "'.$id.'"'),

				    'recursive' => 0,

					'order' => array('Transjual.id' => 'desc'),
				));

			$a=0;

			foreach ($datas['Trans'] as $value){

				$datas['Trans'][$a]['kode']=$this->Itemtoko->find('first',array(

				 	'conditions' => array('Itemtoko.id like "'.$value['Transjual']['itemtoko_id'].'"'), 

				    'recursive' => 0

				));

				$datas['Trans'][$a]['unit']=$this->Unit->find('first',array(

				 	'conditions' => array('Unit.id like "'.$value['Transjual']['unit'].'"'),

				    'recursive' => -1

				));

				$datas['Trans'][$a]['harga']=$this->Hargaunit->find('list',array(

					'fields'=>array('Hargaunit.unit_id','Hargaunit.harga'),

				 	'conditions' => array('Hargaunit.itemtoko_id like "'.$value['Transjual']['itemtoko_id'].'"','Hargaunit.unit_id like "'.$value['Transjual']['unit'].'"'), 

				    'recursive' => -1

				));

				$a=$a+1;

			}

			$datas['bayar']=$bayar;

			$datas['kembali']=$kembali;

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
	

	public function jzebra($filename=null){

		$fullpath = $_SERVER['DOCUMENT_ROOT'] . $this->request->base . DS  . 'applet' . DS;

		$file = new File($fullpath . $filename, false, 0777); //0777 permission default linux

		if($file->exists())

		{

			$this->response->file($fullpath . $filename, array('download'=>true, 'name'=>$filename));

			return $this->response;

		}

	}





	public function index(){
		$this->set("title", 'Transaksi');	

		$jenis_unit = $this->Unit->find('list',

			array('fields' => array('Unit.id','Unit.nama'),'recursive'=>-1

							));

		$this->set(compact('jenis_unit'));

	}





	public function daftar_barang()

	{

		$this->layout='ajax';
		$this->Itemtoko->unbindModel(array('hasMany'=>array('Transjual','Hargaunit')));
		$datas=$this->Itemtoko->find('all',array(

			'recursive' => 0,

			'conditions' => array('Toko.id like '.$this->Session->read('Auth.User.toko_id'))

		));

		

		$jenis_unit = $this->Unit->find('list',array('fields' => array('Unit.nama'),'recursive'=>-1));		

		$this->set(compact('datas','jenis_unit'));

	}

public function addAll(){

		if ($this->request->is('post')) {

			$this->Notajual->create();	

			$this->request->data['Notajual']['user_id'] = $this->Session->read('Auth.User.id');

			if(!$this->request->data['pembeli'])

				$this->request->data['pembeli']="nn";

			$this->request->data['Notajual']['pembeli'] = $this->request->data['pembeli'] ;

			$this->request->data['Notajual']['keterangan'] = $this->request->data['keterangan'] ;

			$this->request->data['Notajual']['tanggal'] = $this->request->data['tanggal'] ;

			//$this->request->data['Notajual']['tanggal'] = date("Y-m-d H:i:s");

			$this->request->data['Notajual']['harga_total'] =$this->request->data['totalharga'] ;

			if(!$this->request->data['potongharga'])

				$this->request->data['potongharga']=0;

			$this->request->data['Notajual']['potong']=$this->request->data['potongharga'];

			$this->request->data['Notajual']['keuntungan_total'] = $this->request->data['untungharga'];

			$this->request->data['Notajual']['bayar'] = $this->request->data['bayarharga'];

			$this->request->data['Notajual']['hutang']=$this->request->data['hutangharga'];

			if(!empty($this->request->data['jatuhtempo'])&&$this->request->data['Notajual']['hutang'])

			$this->request->data['Notajual']['jatuh_tempo']=$this->request->data['jatuhtempo'];

			if($this->request->data['hutangharga'])

			$this->request->data['Notajual']['status']="hutang";			

			else

				$this->request->data['Notajual']['status']="lunas";

			$this->request->data['Notajual']['toko_id']=$this->Session->read('Auth.User.toko_id');

			if ($this->Notajual->save($this->request->data)) {

				

				$count=0;

				foreach ($this->request->data['Transjual'] as $value) {		


					$this->Transjual->create();

					$this->request->data['Transjual']['notajual_id']=$this->Notajual->getLastInsertID();

					$this->request->data['Transjual']['itemtoko_id']=$value['itemtoko_id'];

					$this->request->data['Transjual']['quantity']=$value['isi'];

					$this->request->data['Transjual']['unit']=$value['unit'];

					$this->request->data['Transjual']['total_harga_jual']=$value['total'];

					$this->request->data['Transjual']['keuntungan']=$value['keuntungan'];

					$this->request->data['Transjual']['jumlah_unit']=$value['quantity'];

					

					$itemtoko=$this->Itemtoko->find('first',array('recursive'=>-1,'conditions'=>array('Itemtoko.id'=>$value['itemtoko_id'])));

					if ($this->Transjual->save($this->request->data)) {

						$this->Itemtoko->id=$value['itemtoko_id'];

						$itemtoko['Itemtoko']['quantity']=$itemtoko['Itemtoko']['quantity']-$value['isi'];

						$this->Itemtoko->save($itemtoko['Itemtoko']);

					}



				}


				$this->redirect(array('action' => 'index',$this->Notajual->getLastInsertID(),$this->request->data['bayarharga'],$this->request->data['kembaliharga']));



			} else {

				$this->Session->setFlash('Ada kesalahan INSERT data Transjual.');

			}

		}

}


	public function getdatainput($kode)

	{

		$this->autoRender = false;

		if($this->request->is('ajax'))
		{			

			if($kode!="tidak_ada"){
				$this->Itemtoko->unbindModel(array('hasMany'=>array('Transjual')));
				$datas=$this->Itemtoko->find('first',array(

				 	'conditions' => array('Item.kodebarang like "'.$kode.'"'), 

				    'recursive' => 1

				));

				if (empty($datas['Item']['nama'])||is_null($datas['Item']['nama'])) {

					$datas['Item']['nama']="";	

				}else {

					$datas['Unit']=$this->Unit->find('list',array(

						'fields'=>array('Unit.id','Unit.isi_unit'),

					 	  'recursive' => -1

					));

				}

			}

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

	public function getdataitemtoko()

	{

		$this->autoRender = false;

		if($this->request->is('ajax'))

		{

			$datas['Item']['nama']="";

			$datas['kode_barang']=$this->Itemtoko->find('list',array(						

						'recursive'=>0,

						'fields'=>array('Item.kodebarang')

					));

				$datas['test']=array();

				foreach ($datas['kode_barang'] as $tamp  ) {					

					array_push($datas['test'],

  		                		array('data'=>$tamp,'value'=>$tamp)

   		                	);	

				}

			

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

	public function delete($id = null) {

		if ($this->request->is('post')) {

			if ($id) {

				$data = $this->Transjual->findById($id);

				

				$this->Transjual->id = $id;

				if ($this->Transjual->delete()) {

					$this->Session->setFlash('Data sudah terhapus', 'default',

											array('class'=>'success'));

				}

			}

		}

		$this->redirect(array('action'=>'index'));

	}



	public function edit($id = null){

		$this->set('title', 'Edit Transjual');

		if ($this->request->is('post')) {

			if ($this->request->data) {

				$this->Transjual->id = $this->request->data['Transjual']['id'];

				if ($this->Transjual->save($this->request->data)) {

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

					$data = $this->Transjual->read(null, $id);

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