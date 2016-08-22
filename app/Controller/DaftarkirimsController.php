<?php

//App::uses('CakePdf', 'CakePdf.Pdf');

class DaftarkirimsController extends AppController

{	

	public $layout = "basic";

	public $theme = "tema1";

	public $components = array('Paginator');

	public $uses = array('Daftarkirim','Gudang','Toko','Item','Detildaftarkirim','Itemtoko');

	public $helpers = array('Session');





    public function beforeFilter() {

        parent::beforeFilter('');

        $this->Auth->allow('index','add','edit','delete','detil','cetak');

    }

    

	public function index(){





		$this->set("title", 'Daftar Kirim');

		$conditions=array();

		

		if ($this->Auth->user('toko_id')!==null&&$this->Auth->user('toko_id')!=0) {

			$conditions=array('Daftarkirim.toko_id'=>$this->Auth->user('toko_id'));

		}

		

		$this->Paginator->settings = array(

					'limit' => 5,

					'order' => array('Daftarkirim.id' => 'asc'),

					'recursive'=>-1,

					'conditions'=>$conditions

					// 'group'=>array('Daftarkirim.tanggal_kirim','Daftarkirim.toko_id','Daftarkirim.status','Daftarkirim.tanggal_terima')

					

				);

		$datas = $this->Paginator->paginate('Daftarkirim');

		//debug($datas);



		$daftartoko=$this->Toko->find('list',

			array('fields' => array('Toko.id','Toko.nama'),

				'recursive'=>-1));



		$this->set(compact('datas','daftartoko'));

	}



	

	public function add() {

		$this->set("title", 'Tambah Daftar Kirim');

		if ($this->request->is('post')) {

			// lakukan operasi insert

			//debug($this->request->data);		

		

			$this->Daftarkirim->create();

			$this->request->data['Daftarkirim']['tanggal_kirim']=date("Y-m-d H:i:s");

			$this->request->data['Daftarkirim']['toko_id']=$this->request->data['Toko']['id'];

			$this->request->data['Daftarkirim']['tanggal_terima']='';

			$this->request->data['Daftarkirim']['status']='perjalanan';



			if($this->Daftarkirim->save($this->request->data)){

				//debug("berhasil di simpan");

			}



			$count=0;

			

			foreach ($this->request->data['Detildaftarkirim'] as $value) {		

			//debug($value)			

				$gudangtemp=$this->Gudang->find('first',array('conditions'=>array('Gudang.id'=>$value['gudang_id'])));

				$this->Detildaftarkirim->create();								

				$this->request->data['Detildaftarkirim']['daftarkirim_id']=$this->Daftarkirim->getLastInsertID();;

				$this->request->data['Detildaftarkirim']['item_id']=$gudangtemp['Gudang']['item_id'];

				$this->request->data['Detildaftarkirim']['jumlah']=$value['jumlah'];

				$this->request->data['Detildaftarkirim']['status']='';

				if ($this->Detildaftarkirim->save($this->request->data)) {

					$this->Gudang->id=$value['gudang_id'];					

					$gudangtemp['Gudang']['quantity']=$gudangtemp['Gudang']['quantity']-$value['jumlah'];

					$this->Gudang->save($gudangtemp['Gudang']);

				}

			}

			$this->Session->setFlash('Tambah Daftar Kirim berhasil!', 

										 'default',

										 array('class'=>'success'));

			$this->redirect(array('controller'=>'gudangs','action' => 'kirimbarang'));



			//$this->Pembeli->create();

			// if ($this->Pembeli->save($this->request->data)) {

			// 	// jika insert berhasil



			// 	$this->Session->setFlash('Tambah Pembeli berhasil!', 

			// 							 'default',

			// 							 array('class'=>'success'));

			// 	//$this->redirect(array('action' => 'index'));

			// } else {

			// 	// jika insert gagal

			// 	// tetap tampilkan form

			// 	// flash default adalah 'bad'

			// 	$this->Session->setFlash('Ada kesalahan INSERT data Pembeli.');

			// }

		}

	}



	public function delete($id = null) {

		$date=$this->Daftarkirim->find('first',array('conditions'=>array('Daftarkirim.id'=>$id)));

		if ($this->request->is('post')) {

			if ($id) {

				$data = $this->Daftarkirim->findById($id);

				$this->Daftarkirim->id = $id;

				if ($this->Daftarkirim->delete()) {

					$this->Session->setFlash('Data sudah terhapus', 'default',

											array('class'=>'success'));

				}

			}

		}

		// $this->redirect($this->referer());

		// $date2=$this->Daftarkirim->find('first',array('conditions'=>array('Daftarkirim.tanggal_kirim'=>$date['Daftarkirim']['tanggal_kirim'])));

		// if ($date2) {

		// 	$this->redirect(array('action'=>'detil',$date2['Daftarkirim']['id']));	

		// }

		$this->redirect(array('action'=>'index'));

	}



	public function edit($id = null){

		$this->set('title', 'Edit Daftarkirim');

		if ($this->request->is('post')) {

			

			$this->Daftarkirim->id=$this->request->data['Daftarkirim']['id'];

			if ($this->request->data['Daftarkirim']['status']!='sampai') {

				$this->request->data['Daftarkirim']['status']='sampai';

				$this->Daftarkirim->save($this->request->data['Daftarkirim']);

			}

			

			//$this->request->data['Daftarkirim']['tanggal_terima']=date("Y-m-d H:i:s");

			//debug($this->request->data);

			

			$count=0;

			foreach ($this->request->data['Detildaftarkirim'] as $value) {		

				//debug($value);

				$this->Detildaftarkirim->id=$value['id'];

				$this->Detildaftarkirim->save($value);

				

				if($value['status']=="sampai"){

					$temp_item=$this->Itemtoko->find('first',array('conditions'=>array('Itemtoko.item_id'=>$value['item_id'])));



					if (!$temp_item) {

						$this->Itemtoko->create();

						$temp_item['quantity']=$value['jumlah'];												
						$tamp=$this->Gudang->find('first',array('recursive'=>-1,'conditions'=>array('Gudang.item_id'=>$value['item_id'])));
						$temp_item['hargabeli']=$tamp['Gudang']['harga_barang'];

						$temp_item['tanggal_masuk']=date("Y-m-d H:i:s");

						$temp_item['item_id']=$value['item_id'];

						$temp_item['toko_id']=$this->request->data['Toko']['toko_id'];

						$this->Itemtoko->save($temp_item);

					}else{						

						$this->Itemtoko->id=$temp_item['Itemtoko']['id'];

						$temp_item['Itemtoko']['quantity']=$temp_item['Itemtoko']['quantity']+$value['jumlah'];

						$this->Itemtoko->save($temp_item['Itemtoko']);

					}

					

				}

					

				

				

				

			}

			$this->Session->setFlash('Tambah Daftar Kirim berhasil!', 

										 'default',

										 array('class'=>'success'));

			$this->redirect(array('controller'=>'gudangs','action' => 'kirimbarang'));

		} else {

			if ($id) {

				try {

					$data = $this->Daftarkirim->read(null, $id);

					$this->set(compact('data'));

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



	public function detil($id='')

	{

		$daftar=$this->Daftarkirim->find('first',array('conditions'=>array('Daftarkirim.id'=>$id)));		

		$this->Paginator->settings = array(

					'order' => array('Daftarkirim.id' => 'asc'),

					'recursive'=>2,

					'conditions'=>array('Detildaftarkirim.daftarkirim_id'=>$id)

				);

		$datas = $this->Paginator->paginate('Detildaftarkirim');

		//debug($datas);



		$daftartoko=$this->Toko->find('list',

			array('fields' => array('Toko.id','Toko.nama'),

				'recursive'=>-1));

		$no=0;

		foreach($datas as $data) {

			$temp=$this->Item->find('first',

				array('conditions'=>array('Item.id'=>$data['Detildaftarkirim']['item_id']),

					'recursive'=>-1

					)

				);

			
			$datas[$no]['Detildaftarkirim']['kodebarang']=$temp['Item']['kodebarang'];

			$datas[$no]['Detildaftarkirim']['nama']=$temp['Item']['nama'];			

			$no=$no+1;

		}

		$this->set(compact('datas','daftartoko','id','daftar'));

		$this->set('status',$daftar['Daftarkirim']['status']);

	}

	public function cetak($id='') {

		

		$this->layout = "cetak_nota";

		$this->theme = NULL;

		

		$date=$this->Daftarkirim->find('first',array('conditions'=>array('Daftarkirim.id'=>$id)));

		$this->Paginator->settings = array(

					'order' => array('Daftarkirim.id' => 'asc'),

					'conditions'=>array('Daftarkirim.tanggal_kirim'=>$date['Daftarkirim']['tanggal_kirim'],'Daftarkirim.toko_id'=>$date['Daftarkirim']['toko_id'])

				);

		$datas = $this->Paginator->paginate('Daftarkirim');

		



		$daftartoko=$this->Toko->find('list',

			array('fields' => array('Toko.id','Toko.nama'),

				'recursive'=>0));

		$no=0;

		foreach($datas as $data) {

			$temp=$this->Item->find('first',

				array('conditions'=>array('Gudangs.id'=>$data['Daftarkirim']['gudang_id']),

					'recursive'=>1

					)

				);

			////debug($temp);

			$datas[$no]['Daftarkirim']['kodebarang']=$temp['Item']['kodebarang'];

			$datas[$no]['Daftarkirim']['nama']=$temp['Item']['nama'];			

			$no=$no+1;

		}

		$this->set(compact('datas','daftartoko','date'));

	}



}

?>