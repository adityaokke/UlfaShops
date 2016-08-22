<?php
class GudangsController extends AppController{
	public $components = array('Paginator');
	public $uses = array('Gudangs','Item','Laporanbarangs','Transbeli','Toko');
	

	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('');
    }
    


	public function isAuthorized($user) {
		if(isset($user['role']) && $user['role'] === 'owner') {
			return true;
		}
		else if(in_array($this->action, array('tanpaharga', 'hapus', 'ubah', 'update2','getdataitem','kirimbarang'))) {
			if(isset($user['role']) && in_array($user['role'], array('owner', 'manager gudang'))) {
				return true;
			}
		}
		else if(in_array($this->action, array('lihatharga', 'cekstok', 'lihatsemua', 'search', 'ajax_search', 'ajax_update', 'ajax_stokonly', 'ajax_search_stok'))) {
			if(isset($user['role']) && in_array($user['role'], array('owner', 'manager gudang', 'manager toko'))) {
				return true;
			}
		}
		else if(in_array($this->action, array('index', 'terbaru'))) {
			if(isset($user['role'])) {
				return true;
			}
		}
		return false;
	}

	public function index()
	{
		
		$this->Gudangs->recursive =0;
		$this->Paginator->settings= array(
			'limit'=>5,
			'order'=>array(
				'Gudangs.tanggal_masuk' =>'desc'));
				
		try
		{
			$data_gudang = $this->paginate('Gudangs');

			$this->set(compact('data_gudang'));
			
		}
		catch(NotFoundException $se){}
	}
	
	public function lihatharga()
	{
		
	}
	public function cekharga()
	{
		$this->paginate = array(
			'conditions' => array(
			    'OR' => array(
			        'Gudangs.satuan_grosir =' => 0,
			        'Gudangs.lusin_grosir =' => 0,
			        'Gudangs.lusin6_grosir =' => 0,
			        'Gudangs.satuan_eceran =' => 0,
			        'Gudangs.pcs3_eceran =' => 0,
			        'Gudangs.lusin1_eceran =' => 0,
			        
			        )
			    ),'limit' => 10
			);
			$list = $this->paginate('Gudangs');
			$this->set('list',$list);
	}
	public function tanpaharga()
	{
			$this->paginate = array(
			'conditions' => array(
			    'OR' => array(
			        'Gudangs.satuan_grosir =' => 0,
			        'Gudangs.lusin_grosir =' => 0,
			        'Gudangs.lusin6_grosir =' => 0,
			        'Gudangs.satuan_eceran =' => 0,
			        'Gudangs.pcs3_eceran =' => 0,
			        'Gudangs.lusin1_eceran =' => 0,
			        
			        )
			    ),'limit' => 10
			);
			$list = $this->paginate('Gudangs');
			$this->set('list',$list);
			
	}
	public function cekstok()
	{
		$this->Gudangs->recursive =0;
		$this->Paginator->settings= array(
			'limit'=>5,
			'order'=>array(
				'Gudangs.tanggal_masuk' =>'asc'));
				
		try
		{
			$data_gudang = $this->paginate('Gudangs');
			$this->set(compact('data_gudang'));
		}
		catch(NotFoundException $se){}
	}
	
	public function lihatsemua()
	{
		$this->Gudangs->recursive =0;
		$this->Paginator->settings= array(
			'limit'=>10,
			'order'=>array(
				'Gudangs.tanggal_masuk' =>'asc'));
		try
		{
			$data_gudang = $this->paginate('Gudangs');
			$this->set(compact('data_gudang'));
		}
		catch(NotFoundException $se){}
	}
	public function search()
	{
		$item_id = $this->Item->findBykodebarang($this->request->data['Post']['kodebarang']);
		$keyword='%'.$item_id['Item']['id'].'%';
			$this->paginate = array(
			'conditions' => array(
			    'OR' => array(
			        'Gudangs.item_id LIKE' => '%'. $keyword . '%'
			        )
			    ),'limit' => 10
			);
			$list = $this->paginate('Gudangs');
			$this->set(compact('list'));
			
	}
	public function ajax_search()
	{
		$this->layout='ajax';
		$hasil = $_POST['keyword'];
		$keyword='%'.$hasil.'%';
			$this->paginate = array(
			'conditions' => array(
			    'OR' => array(
			        'Gudangs.kodebarang LIKE' => '%'. $keyword . '%'
			        )
			    ),'limit' => 10
			);
			$list = $this->paginate('Gudangs');
			$this->set('list',$list);
			$this->set('hasil',$_POST['keyword']);


	}
	public function terbaru()
	{
		$this->Gudangs->recursive =0;
		$this->Paginator->settings= array(
			'limit'=>15,
			'order'=>array(
				'Gudangs.tanggal_masuk' =>'desc'));
				
		try
		{
			$data_gudang = $this->paginate('Gudangs');
			$this->set(compact('data_gudang'));
			
		}
		catch(NotFoundException $se){}
	}
	public function hapus($id=null)
	{
		$this->request->onlyAllow('post');
			$this->Gudangs->id = $id;
			$datagudang = $this->Gudangs->findByid($id);
			if(!$this->Gudangs->exists())
			{
				throw new NotFoundException(__('Item tidak valid'));
			}
			if($this->Gudangs->delete())
			{
				
				$this->Session->setFlash(__('Barang di Gudang telah terhapus'));
				return $this->redirect(array('action'=>'index'));
			}
			$this->Session->setFlash(__('Berita tidak dapat di hapus'));
	}
	public function ajax_update()
	{
		$this->layout='ajax';
		$hasil = $_POST['keyword'];
		$keyword='%'.$hasil.'%';
			$this->paginate = array(
			'conditions' => array(
			    'OR' => array(
			        'Item.kodebarang LIKE' => '%'. $keyword . '%'
			        )
			    ),'limit' => 10
			);
			$list = $this->paginate('Item');
			$this->set('data_gudang',$list);
			$this->set('hasil',$_POST['keyword']);

	}
	public function ajax_stokonly()
	{
		$this->layout='ajax';
		$hasil = $_POST['keyword'];
		$keyword='%'.$hasil.'%';
			$this->paginate = array(
			'conditions' => array(
			    'OR' => array(
			        'Gudangs.kodebarang LIKE' => '%'. $keyword . '%'
			        )
			    ),'limit' => 10
			);
			$list = $this->paginate('Item');
			$this->set('list',$list);
			$this->set('hasil',$_POST['keyword']);

	}
	public function ajax_search_stok()
	{
		$this->layout='ajax';
		$hasil = $_POST['keyword'];

		if(!empty($_POST['mulai'])|| !empty($_POST['mulai']))
		{
			
			$keyword='%'.$hasil.'%';
			$this->paginate = array(
			'conditions' => array(
			    'And' => array(
			    	array(
			        'Gudangs.kodebarang LIKEs' => '%'. $keyword . '%',
			        'Gudangs.tanggal_masuk >'=> $_POST['mulai'] ,
			        'Gudangs.tanggal_masuk <'=> $_POST['akhir'] 
			       	),
			       )
			    ),'limit' => 10
			);
			$list = $this->paginate('Gudangs');
			$this->set('list',$list);
			$this->set('hasil','terisi semua tanggal');
		}
		else
		{
			
			$keyword='%'.$hasil.'%';
			$this->paginate = array(
			'conditions' => array(
			    'OR' => array(
			        'Gudangs.kodebarang LIKE' => '%'. $keyword . '%',
			        )
			    ),'limit' => 10
			);
			$list = $this->paginate('Gudangs');
			$this->set('list',$list);
			$this->set('hasil', $_POST['keyword']);
		}
		
		

	}
	public function ubah($id=null)
	{

			$this->Gudangs->id=$id;
			if(!$this->Gudangs->exists())
			{
				throw new Exception(__('item tidak valid'));
			}
			if($this->request->is('post'))
			{
				if($this->Gudangs->save($this->request->data['Laporanbarangs']))
				{
					$this->Session->setFlash(__('item telah di ubah'));
					$this->Laporanbarangs->create();
					if	($this->Laporanbarangs->save($this->request->data['Laporanbarangs'])){	
			 	 	 $this->Session->setFlash(__('Laporan barang sudah di update.'));	
			 	 	}
					return $this->redirect(array('action'=>'index'));
				}
				$this->Session->setFlash(__('item tidak bisa di rubah'));
			}
			else
			{
				$gudang_id = $this->request->params['pass'][0];
				////debug()
				$this->set('gudid',$gudang_id);	
				$data = $this->Gudangs->findById($gudang_id);
				$this->set('data',$data);	
				
			
			}
	}
	public function update($id=null)
	{
		
		
		if($this->request->is('post'))
		{

			$data = $this->Gudangs->findBykodebarang($this->request->data['Gudangs']['kodebarang']);
			if(isset($data) && !empty($data))
			{
				 $this->Session->setFlash(__('barang sudah ada di gudang.'));	
		 	 	 return	$this->redirect(array('action'	=>	'update'));	
			}
			else if(!$this->Item->findBykodebarang($this->request->data['Gudangs']['kodebarang']))
			{
				$this->Session->setFlash(__('kode barang tidak ditemukan.'));	
		 	 	return	$this->redirect(array('action'	=>	'index'));
		 	}
		 	else
		 	{

				$item_id = $this->Item->findBykodebarang($this->request->data['Gudangs']['kodebarang']);
				$this->Gudangs->id=$id;
				//debug($this->Gudangs->id);
				$data = $this->request->data['Gudangs'];
				$data['item_id'] = $item_id['Item']['id'];
				$data['kodebarang']=$item_id['Item']['kodebarang'];
				

				$this->Gudangs->create();
				if	($this->Gudangs->save($data)){	
		 	 	 $this->Session->setFlash(__('data gudang sudah di update.'));	
		 	 	 return	$this->redirect(array('action'	=>	'update'));	
		 	 	}
		 	 	$this->Session->setFlash(__('Data	berita	tidak	dapat	tersimpan.')	
		 	 	);		
		 	}
		}
	}
	public function update2($id=null)
	{
		
		
		if($this->request->is('post'))
		{

			$data = $this->Gudangs->findBykodebarang($this->request->data['Gudangs']['kodebarang']);
			if(isset($data) && !empty($data))
			{
				 $this->Session->setFlash(__('barang sudah ada di gudang.'));	
		 	 	 return	$this->redirect(array('action'	=>	'update'));	
			}
			else if(!$this->Item->findBykodebarang($this->request->data['Gudangs']['kodebarang']))
			{
				$this->Session->setFlash(__('kode barang tidak ditemukan.'));	
		 	 	return	$this->redirect(array('action'	=>	'index'));
		 	}
		 	else
		 	{

				$item_id = $this->Item->findBykodebarang($this->request->data['Gudangs']['kodebarang']);
				$this->Gudangs->id=$id;
				//debug($this->Gudangs->id);
				$data = $this->request->data['Gudangs'];
				$data['item_id'] = $item_id['Item']['id'];
				$data['kodebarang']=$item_id['Item']['kodebarang'];
				

				$this->Gudangs->create();
				if	($this->Gudangs->save($data)){	
		 	 	 $this->Session->setFlash(__('data gudang sudah di update.'));	
		 	 	return $this->redirect(array('controller'=>'Notabeli','action'=>'sistem',$this->request->params['pass'][0]));
		 	 	}
		 	 	$this->Session->setFlash(__('Data	berita	tidak	dapat	tersimpan.')	
		 	 	);		
		 	}
		}
	}

//okke

	public function kirimbarang($id='')
	{
		$this->set("title", 'Kirim barang');	
		$daftar_toko = $this->Toko->find('list',
			array('fields' => array('Toko.id','Toko.nama')
							));
		
		$this->set(compact('daftar_toko'));
	}
//JSON -------------------------------------------------------
	public function getdataitem($kode='',$nama='',$p='')
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
					'order' => array('Gudangs.id' => 'asc'),
					'recursive'=>0,
					'conditions' => $conditions,
					'page'=>$p
				);
			$datas = $this->Paginator->paginate('Gudangs');
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

//JSON -------------------------------------------------------
	public function additemkirim($kode='',$nama='',$p='')
	{
		$this->layout='ajax';
			$this->set('kode',$_POST['kode']);
			$this->set('nama',$_POST['nama']);
			$this->set('jumlah',$_POST['jumlah']);
			$this->set('gudang_id',$_POST['gudang_id']);
			$this->set('no',$_POST['no']);
			
	}
// -----------------------------------------------------------


}
?>