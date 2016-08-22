<?php
class TransjualsController extends AppController
{	
	public $layout = "basic";
	public $theme = "tema1";
	public $components = array('Paginator');
	public $uses = array('Notajual','Transjual','Item','Itemtoko','Unit','Hargaunit');
	public $helpers = array('Session');


	public function beforeFilter() {
	    parent::beforeFilter();
	    $this->Auth->allow('index','daftartransaksi','getdatainput','getdata','add','addAll','getdataitemtoko',"daftar_barang","jzebra","cetak");
	}
	
	public function isAuthorized($user) {
		if(isset($user['role']) && in_array($user['role'], array('owner', 'manager toko', 'kasir'))) {
			return true;
		}
		return false;
	}

	public function jzebra($filename=null){
		$fullpath = $_SERVER['DOCUMENT_ROOT'] . $this->request->base . DS  . 'applet' . DS;
		$file = new File($fullpath . $filename, false, 0777); //0777 permission default linux
		if($file->exists())
		{
			//kirim file ke browser
			$this->response->file($fullpath . $filename, array('download'=>true, 'name'=>$filename));
			return $this->response;
		}
	}


	public function index(){
		$this->set("title", 'Transaksi');	
		$jenis_unit = $this->Unit->find('list',
			array('fields' => array('Unit.id','Unit.nama')
							));
		// debug($this->Itemtoko->find('all',array(
		// 	'recursive' => 2
		// )));
		$this->set(compact('jenis_unit'));
	}

//JSON -------------------------------------------------------
	public function cetak($id,$bayar,$kembali)
	{
		$this->autoRender = false;
		if($this->request->is('ajax'))
		{			
			$datas=$this->Notajual->find('all',array(
				 	'conditions' => array('Notajual.id like "'.$id.'"'), //array of conditions
				    'recursive' => 2
				));
			$datas['Trans']=$this->Transjual->find('all',array(
				 	'conditions' => array('Transjual.notajual_id like "'.$id.'"'), //array of conditions
				    'recursive' => 1
				));
			$a=0;
			foreach ($datas['Trans'] as $value){
				$datas['Trans'][$a]['kode']=$this->Itemtoko->find('first',array(
				 	'conditions' => array('Itemtoko.id like "'.$value['Transjual']['itemtoko_id'].'"'), //array of conditions
				    'recursive' => 0
				));
				$datas['Trans'][$a]['unit']=$this->Unit->find('first',array(
				 	'conditions' => array('Unit.id like "'.$value['Transjual']['unit'].'"'), //array of conditions
				    'recursive' => 0
				));
				$datas['Trans'][$a]['harga']=$this->Hargaunit->find('list',array(
					'fields'=>array('Hargaunit.unit_id','Hargaunit.harga'),
				 	'conditions' => array('Hargaunit.itemtoko_id like "'.$value['Transjual']['itemtoko_id'].'"','Hargaunit.unit_id like "'.$value['Transjual']['unit'].'"'), //array of conditions
				    'recursive' => 0
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

//JSON -------------------------------------------------------
	// public function getdata($kode,$no)
	// {
	// 	$this->autoRender = false;
	// 	if($this->request->is('ajax'))
	// 	{
	// 		$datas=$this->Itemtoko->find('first',array(
	// 			 	'conditions' => array('Item.kodebarang' => $kode), //array of conditions
	// 			    'recursive' => 1
	// 			));
	// 		$datas['no']=$no;
	// 		if($datas)
	// 		{
	// 			echo json_encode($datas);
	// 		}
	// 		else
	// 		{
	// 			echo json_encode(array());
	// 		}
	// 	}
	// 	else
	// 	{
	// 		$this->redirect(array('action'=>'index'));
	// 	}
	// }
// -----------------------------------------------------------

//HTML -------------------------------------------------------
	public function daftar_barang()
	{
		$this->layout='ajax';
		$datas=$this->Itemtoko->find('all',array(
			'recursive' => 0,
			'conditions' => array('Toko.id like '.$this->Session->read('Auth.User.toko_id'))
		));
		$this->set(compact('datas'));
			
	}
// -----------------------------------------------------------

//HTML -------------------------------------------------------
	public function add()
	{
		$this->layout='ajax';
		//$hasil = $_POST['keyword'];
		//$keyword='%'.$hasil.'%';		
			// $this->paginate = array(
			// 'conditions' => array(
			//     'OR' => array(
			//         'Gudangs.kodebarang LIKE' => '%'. $keyword . '%'
			//         )
			//     ),'limit' => 10
			// );
			// $list = $this->paginate('Gudangs');
			// $this->set('list',$list);
			//$this->set('hasil',$_POST['keyword']);
			$this->set('kode',$_POST['kode']);
			$this->set('nama',$_POST['nama']);
			$this->set('jumlah',$_POST['jumlah']);
			$this->set('unit',$_POST['unit']);
			$this->set('isi',$_POST['isi']);
			$this->set('harga',$_POST['harga']);
			$this->set('total',$_POST['total']);
			$this->set('itemtoko_id',$_POST['itemtoko_id']);
			$this->set('no',$_POST['no']);
			$jenis_unit = $this->Unit->find('list',array('fields' => array('Unit.nama')));		
			$this->set(compact('jenis_unit'));
			
	}
// -----------------------------------------------------------


public function addAll(){
		if ($this->request->is('post')) {
			// lakukan operasi insert
			$this->Notajual->create();	
			//debug($this->request->data);	
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
			//$this->request->data['Notajual']['dibayar'] = $this->request->data['bayarharga'];
			$this->request->data['Notajual']['hutang']=$this->request->data['hutangharga'];
			if(!empty($this->request->data['jatuhtempo'])&&$this->request->data['Notajual']['hutang'])
			$this->request->data['Notajual']['jatuh_tempo']=$this->request->data['jatuhtempo'];
			if($this->request->data['hutangharga'])
			$this->request->data['Notajual']['status']="hutang";			
			else
				$this->request->data['Notajual']['status']="lunas";
			$this->request->data['Notajual']['toko_id']=$this->Session->read('Auth.User.toko_id');
			//debug($this->request->data);
			if ($this->Notajual->save($this->request->data)) {
				
				$count=0;
				foreach ($this->request->data['Transjual'] as $value) {		
				//debug($value)			;
					$this->Transjual->create();
					$this->request->data['Transjual']['notajual_id']=$this->Notajual->getLastInsertID();
					$this->request->data['Transjual']['itemtoko_id']=$value['itemtoko_id'];
					$this->request->data['Transjual']['quantity']=$value['isi'];
					$this->request->data['Transjual']['unit']=$value['unit'];
					$this->request->data['Transjual']['total_harga_jual']=$value['total'];
					$this->request->data['Transjual']['keuntungan']=$value['keuntungan'];
					$this->request->data['Transjual']['jumlah_unit']=$value['quantity'];
					
					$itemtoko=$this->Itemtoko->find('first',array('conditions'=>array('Itemtoko.id'=>$value['itemtoko_id'])));
					if ($this->Transjual->save($this->request->data)) {
						$this->Itemtoko->id=$value['itemtoko_id'];
						$itemtoko['Itemtoko']['quantity']=$itemtoko['Itemtoko']['quantity']-$value['isi'];
						$this->Itemtoko->save($itemtoko['Itemtoko']);
					}

				}
				// jika insert berhasil
				//debug($this->request->data);
				$this->redirect(array('action' => 'index',$this->Notajual->getLastInsertID(),$this->request->data['bayarharga'],$this->request->data['kembaliharga']));

			} else {
				$this->Session->setFlash('Ada kesalahan INSERT data Transjual.');
			}
		}
}

//JSON -------------------------------------------------------
	public function getdatainput($kode)
	{
		$this->autoRender = false;
		if($this->request->is('ajax'))
		{			
			if($kode!="tidak_ada"){
				$datas=$this->Itemtoko->find('first',array(
				 	'conditions' => array('Item.kodebarang like "'.$kode.'"'), //array of conditions
				    'recursive' => 2
				));
				if (empty($datas['Item']['nama'])||is_null($datas['Item']['nama'])) {
					$datas['Item']['nama']="";	
				}else {
					$datas['Unit']=$this->Unit->find('list',array(
						'fields'=>array('Unit.id','Unit.isi_unit'),
					 	  'recursive' => 0
					));
				}
				
				// $datas['harga_unit']=$this->Unit->find('list',
				// 	array('fields' => array('Unit.isi')
				// 	));
				// $datas['kode_barang']=$this->Itemtoko->find('list',array(
				// 		'conditions' => array('Item.kodebarang like "%'.$kode.'%"'), //array of conditions
				// 		'recursive'=>0,
				// 		'fields'=>array('Item.kodebarang')
				// 	));
				// $datas['test']=array();
				// foreach ($datas['kode_barang'] as $tamp  ) {					
				// 	array_push($datas['test'],
  		//                 		array('data'=>$tamp,'value'=>$tamp)
   	// 	                	);	
				// }
				
				
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
// -----------------------------------------------------------


//JSON -------------------------------------------------------
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
// -----------------------------------------------------------


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
			// lakukan operasi UPDATE				
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

