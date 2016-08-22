<?php
class KategoriController extends AppController{
	public $components = array('Paginator');
	public $uses = array('Kategori','Item');//tabel apa
	
	public function isAuthorized($user) {
		if(in_array($this->action, array('tambah', 'ubah', 'hapus'))) {
			if(isset($user['role']) && in_array($user['role'], array('owner', 'manager gudang', 'manager toko'))) {
				return true;
			}
		}
		else if(in_array($this->action, array('index', 'search', 'detail', 'subkategori', 'subitem', 'getByCategory'))) {
			if(isset($user['role'])) {
				return true;
			}
		}
		return false;
	}

	public function index()//jadi nama ctp untuk view
	{
		
		$this->Kategori->recursive = 0;
		$this->Paginator->settings = array(
			'conditions'=>array('Kategori.parent ' => 0),
			'limit' => 10,
			'order' => array(
				'Kategori.id' => 'asc')
			);
		try
		{
			$this->set('datas',$this->Paginator->paginate('Kategori'));//tabel
		}
		catch(NotFoundException $e){}
		
	}

	public function search()
	{	
		////debug($this->request->query['key']);
		$keyword='%'.$this->request->query['key'].'%';
		$this->paginate = array(
		'conditions' => array(
		    'OR' => array(
		        'Kategori.nama LIKE' => '%'. $keyword . '%'
		        )
		    ),'limit' => 10
		);
		$list = $this->paginate('Kategori');
		$this->set(compact('list'));


		
		
	}
	public function detail()
	{

		$kat_id = $this->request->params['pass'][0];
		$sub_kt = $this->Kategori->findByid($kat_id);
		if($sub_kt['Kategori']['parent']==0)
		{
			$this->Kategori->recursive = 0;
			$result = 'Ini adalah Kategori Utama';
			$this->Paginator->settings = array(
			'conditions'=>array('Kategori.parent ' => $kat_id),
			'limit' => 10,
			'order' => array(
				'Kategori.id' => 'asc')
			);
			try
			{
				$this->set('datas',$this->Paginator->paginate('Kategori'));//tabel
			}
			catch(NotFoundException $e){}
				
				$this->set('katkey','kategori_utama');
				
		}
		else
			{
				$kt = $this->Kategori->findByid($sub_kt['Kategori']['parent']);
				$result = 'Ini adalah sub kategori dari '.$kt['Kategori']['nama'];

				$this->Item->paginate = array(
				'conditions' => array(
				    'OR' => array(
				        'Item.kategori_id = ' => 63
				        )
				    ),'limit' => 10
				);
				$datas = $this->paginate('Item');
				$this->set(compact('datas'));

				
			}
			$data = $this->set('result',$result);
			$this->set('katkey','kategori_sub');
	}
	public function subkategori()
	{
		
		$temp = $this->request->params['pass'][0];
		//$tempKategori = $this->Kategori->findById($temp);
		$namaKategori = $this->Kategori->findById($temp);
		$namaKa = $namaKategori['nama'];	
		$this->paginate = array('conditions'=> array('Kategori.parent' => $temp),'recursive'=>1,'limit'=>5); 
		
		//find('all',array('conditions'=>array("Item.Kategori_id"=>9)));
		/*$this->paginate  = $this->Kategori->Item->query("SELECT * FROM `items` where Kategori_id = 9");
		$datadetail = $this->paginate('Item');
		$this->set(compact('datadetail'));
*/
		//$data = $this->paginate('Item',array('Item.Kategori_id !='=>0));
		$list_sub = $this->paginate('Kategori');
		$this->set(compact('list_sub'));
		$this->set('namaKategori',$namaKategori['Kategori']['nama']);
		$this->set('subkategori',$namaKa);
	}
	public function subitem()
	{
		$temp = $this->request->params['pass'][0];
		$tempKategori = $this->Kategori->findById($temp);
		$namaKategori = $this->Kategori->findById($tempKategori['Kategori']['parent']);
		$this->paginate = array('conditions'=> array('Item.Kategori_id' => $temp),'recursive'=>1,'limit'=>5); 
		
		$list_item = $this->paginate('Item');
		$this->set(compact('list_item'));
		$this->set('namaKategori',$namaKategori['Kategori']['nama']);
		$this->set('parent',$this->request->params['pass'][1]);
		
	}
	public function getByCategory() {
			
			$Kategori_id = $this->request->data['Item']['kategori_id'];
	 		$subcategories = $this->Kategori->find('all', array(
				'conditions' => array('Kategori.parent' => $Kategori_id),
				'recursive' => -1
				));
	 		
			$this->set('subcategories',$subcategories);
			$this->layout = 'ajax';
		}
	public function tambah()
	{
		
		$this->set('list_sub',$this->Kategori->find('list',array('fields'=>array('Kategori.nama'),'conditions'=>array('Kategori.parent !='=>0))));
        $this->set('list_kategori',$this->Kategori->find('list',array('fields'=>array('Kategori.nama'),'conditions'=>array('Kategori.parent '=>0))));
		if($this->request->is('post'))
		{
			
			//return	$this->redirect(array('action'	=>	'index'));	
			$this->Kategori->create();
			
			if	($this->Kategori->save($this->request->data['Kategori'])){	
	 	 	 $this->Session->setFlash(__('Berita	telah	tersimpan.'));	
	 	 	 return	$this->redirect(array('action'	=>	'index'));	
	 	 	}
	 	 	$this->Session->setFlash(__('Data	berita	tidak	dapat	tersimpan.')	
	 	 	);		
		}
	}

	public function ubah($id=null)
	{

		$this->Kategori->id=$id;
		if(!$this->Kategori->exists())
		{
			throw new Exception(__('kategori tidak valid'));
			
		}
		if($this->request->is('post'))
		{
			if($this->Kategori->save($this->request->data))
			{
				$this->Session->setFlash(__('Kategori telah di update'));
				return $this->redirect(array('action'=>'index'));
			}
			$this->Session->setFlash(__('Kategori tidak dapat di update'));
		}
		else
		{
			$Kategori_id = $this->request->params['pass'][0];
			
			$this->set('Kategori_id',$Kategori_id);
			
			$this->set('data',$this->Kategori->findById($Kategori_id));		
		}
		
	}
	public function hapus($id=null)
	{
		$this->request->onlyAllow('post');
		$this->Kategori->id = $id;
		
		if(!$this->Kategori->exists())
		{
			throw new NotFoundException(__('Kategori tidak valid'));
		}
		$finish = 0;

			if($this->request->params['pass'][1]=='delkat')
			{
				$delete_list = $this->Kategori->find('all',array('conditions'=>array('Kategori.parent'=>$id)));
				foreach ($delete_list as $itemlist) {
					$this->Kategori->Item->deleteAll(array('Item.Kategori_id'=>$itemlist['Kategori']['id']));
				}
				$this->Kategori->deleteAll(array('Kategori.parent'=>$id));
				$finish = 1;
			}
			else if($this->request->params['pass'][1]=='delsub')
			{
				$this->Kategori->Item->deleteAll(array('Item.Kategori_id'=>$id));
				$finish = 1;
			}
			$this->Kategori->delete($id);


		
		if($finish == 1)
		{
			$this->Session->setFlash(__('Kategori telah terhapus'));
			return $this->redirect(array('action'=>'index'));
		}//masih bug delete item
		else
		{
			$this->Session->setFlash(__('Kategori tidak dapat di hapus'));	
		}
		//
	}

}

?>