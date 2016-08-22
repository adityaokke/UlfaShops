<?php
	App::uses('File', 'Utility');
	class ItemController extends AppController
	{
		
		public $components = array('Paginator');
		public $uses = array('Item','Kategori','Gudangs');
		
		public function isAuthorized($user) {
			if(in_array($this->action,
				    array('hapus', 'tambah', 'tambah2', 'tambah3', '__upload', 'photos', 'ubah'))) {
				if(isset($user['role']) && in_array($user['role'], array('owner', 'manager gudang'))) {
					return true;
				}
			}
			else if(in_array($this->action, array('index', 'search', 'detil', 'cekkode'))) {
				if(isset($user['role'])) {
					return true;
				}
			}
			return false;
		}
		
		public function index()
		{

			/*//debug($this->Kategori->find('all'));*/
			
			$this->Item->recursive =0;
			$this->Paginator->settings = array(
				'limit' => 15,
				'order' => array('Item.kodebarang' => 'asc')
				);
			try
			{
				$this->set('Item',$this->Paginator->paginate('Item'));
			}
			catch(NotFouncException $e){}
		}

		public function search()
		{
			if($this->request->query['key'] && $this->request->query['key2'])
			{
				$keyword='%'.$this->request->query['key'].'%';
				$keyword2='%'.$this->request->query['key2'].'%';
				$this->paginate = array(
				'conditions' => array(
				    'And' => array(
				       
				        'Item.nama LIKE' => '%'. $keyword . '%',
				        'Item.kodebarang LIKE' => '%'. $keyword2 . '%'
				        )
				    ),'limit' => 10
				);

			}
			else if($this->request->query['key'] && !$this->request->query['key2'])
			{
				$keyword='%'.$this->request->query['key'].'%';
				$this->paginate = array(
				'conditions' => array(
				    'OR' => array(
				       
				        'Item.nama LIKE' => '%'. $keyword . '%'
				        )
				    ),'limit' => 10
				);
			}
			else if($this->request->query['key2'] && !$this->request->query['key'])
			{
				$keyword='%'.$this->request->query['key2'].'%';
				$this->paginate = array(
				'conditions' => array(
				    'OR' => array(
				       
				        'Item.kodebarang LIKE' => '%'. $keyword . '%'
				        )
				    ),'limit' => 10
				);
			}
			$list = $this->paginate('Item');
			$this->set(compact('list'));
		}
		/*public function searchbycode()
		{
			$keyword='%'.$this->request->query['key'].'%';
			$this->paginate = array(
			'conditions' => array(
			    'OR' => array(
			        'Item.kodebarang LIKE' => '%'. $keyword . '%'
			        )
			    ),'limit' => 10
			);
			$list = $this->paginate('Item');
			$this->set(compact('list'));
		}*/
		public function cek()
		{
			if ($this->request->isAjax())
			{
				$this->layout = null;
		        $this->view = 'view_ajax'; //Other view that doesn't needs layout, only if necessary 
			}
		}
		public function detil($id=null)
		{
			if($id){
				$this->set('data',$this->Item->findById($id));
			}
			else
			{
				$this->Session->setFlash('permintaan tidak valid');
				$this->redirect(array('action'=>'index'));
			}

		}

		public function hapus($id=null)
		{
			$this->request->onlyAllow('post');
			$this->Item->id = $id;
			if(!$this->Item->exists())
			{
				throw new NotFoundException(__('Item tidak valid'));
			}
				$data = $this->Item->findById($id);
				$imgName = $data['Item']['nama_gambar'];
			    $itemId = $data['Item']['id'];
			    $file = new File(APP . DS . 'files' . DS . 'photos' . DS . 'Items' . DS.$imgName);
				$file->delete();	
			if($this->Item->delete($id))
			{
				
				$this->Session->setFlash(__('Item telah terhapus'));
				return $this->redirect(array('action'=>'index'));
			}
			$this->Session->setFlash(__('Berita tidak dapat di hapus'));
			
		}

		public function tambah()
		{
			$this->set('namaKategori',$this->Item->Kategori->find('list', array('fields' => array('Kategori.nama'),'conditions'=>array('Kategori.parent '=>0))));
			$this->set('namasubKategori',$this->Item->Kategori->find('list', array('fields' => array('Kategori.nama'),'conditions'=>array('Kategori.parent !='=>0))));

			if($this->request->is('post'))
			{

				if($this->request->data['Post']['photo']['tmp_name'])
				{

					$file=$this->request->data['Post']['photo'];
					$upload =  $this->__upload($file);
					if($upload)
					{
						$this->request->data['Item']['nama_gambar']=$file['name'];
						$this->request->data['Item']['file_path'] = APP . DS . 'files' . DS . 'photos' . DS . 'Items' . DS;
						$this->request->data['Item']['mime_type'] = $file['type'];

					}
				}
				
				$this->Item->create();
				
				if($this->Item->save($this->request->data))
				{
/*					$this->Gudang->create()*/;
					/*$datagudang['item_id'] = $this->Item->getLastInsertId();
					$datagudang['quantity'] = $this->request->data['Gudang']['quantity'];*/
					/*$this->set('datagudang',$datagudang);
					
					$this->Gudang->save($datagudang);
*/
					$this->Session->setFlash(__('Item telah tersimpan'));
					return $this->redirect(array('action'=>'index'));
				}
				$this->Session->setFlash(__('data item tidak dapat tersimpan.'));
			}
		}
		
		public function tambah3()
		{
			$this->set('namaKategori',$this->Item->Kategori->find('list', array('fields' => array('Kategori.nama'),'conditions'=>array('Kategori.parent '=>0))));
			$this->set('namasubKategori',$this->Item->Kategori->find('list', array('fields' => array('Kategori.nama'),'conditions'=>array('Kategori.parent !='=>0))));

			if($this->request->is('post'))
			{

				if($this->request->data['Post']['photo']['tmp_name'])
				{

					$file=$this->request->data['Post']['photo'];
					$upload =  $this->__upload($file);
					if($upload)
					{
						$this->request->data['Item']['nama_gambar']=$file['name'];
						$this->request->data['Item']['file_path'] = APP . DS . 'files' . DS . 'photos' . DS . 'Items' . DS;
						$this->request->data['Item']['mime_type'] = $file['type'];

					}
				}
				
				$this->Item->create();
				
				if($this->Item->save($this->request->data))
				{

/*					$this->Gudang->create()*/;
					/*$datagudang['item_id'] = $this->Item->getLastInsertId();
					$datagudang['quantity'] = $this->request->data['Gudang']['quantity'];*/
					/*$this->set('datagudang',$datagudang);
					
					$this->Gudang->save($datagudang);
*/	
					$this->Session->setFlash(__('Item telah tersimpan'));
					return $this->redirect('/Notabeli/sistem/'.$this->request->params['pass'][0]);	
					
				}
				$this->Session->setFlash(__('data item tidak dapat tersimpan.'));
			}
		}
		private function __upload($file)
		{
			$ext = substr(strrchr(strtolower($file['name']),'.'),1);
			if(in_array($ext, array('jpg','jpeg','png','gif')))
			{
				$fullpath = APP . DS . 'files' . DS . 'photos' . DS . 'Items' . DS;
				move_uploaded_file($file['tmp_name'], $fullpath.$file['name']);
				return true;
			}
			else
			{
				return false;
			}
		}

		public function photos($id=null)
		{
			if($id)
			{
				$data = $this->Item->findById($id);
				if($data)
				{
					$filename = $data['Item']['nama_gambar'];
					if(!$filename)
					{
						$filename = 'anonim.jpg';
					}
				}
			}
			$fullpath = APP . DS . 'files' . DS . 'photos' . DS . 'Items' . DS;
			$file = new File($fullpath.$filename,false,0777);
			if($file->exists())
				$this->response->file($fullpath.$filename,array('download'=>true,'name'=>$filename));
			return $this->response;
			
		}
		public function cekkode()
		{
			$keyword='%'.$this->request->query['key'].'%';
			$this->paginate = array(
			'conditions' => array(
			    'OR' => array(
			        'Item.nama LIKE' => '%'. $keyword . '%'
			        )
			    ),'limit' => 10
			);
			$list = $this->paginate('Item');
			$this->set(compact('list'));
		}
		
		public function ubah($id=null)
		{
			//$this->Item->recursive =2;
			$this->Item->id=$id;
			if(!$this->Item->exists())
			{
				throw new Exception(__('item tidak valid'));
			}
			if($this->request->is('post'))
			{
				$data = $this->Item->findById($id);
				$imgName = $data['Item']['nama_gambar'];
			    $itemId = $data['Item']['id'];
			    $file = new File(APP . DS . 'files' . DS . 'photos' . DS . 'Items' . DS.$imgName);
				$file->delete();	
				if($this->request->data['Item']['photo']['tmp_name'])
				{

					$file=$this->request->data['Item']['photo'];
					$upload =  $this->__upload($file);
					if($upload)
					{
						$this->request->data['Item']['nama_gambar']=$file['name'];
						$this->request->data['Item']['file_path'] = APP . DS . 'files' . DS . 'photos' . DS . 'Items' . DS;
						$this->request->data['Item']['mime_type'] = $file['type'];
						

					}
					
				}
				
				if($this->Item->save($this->request->data))
				{
					$this->Session->setFlash(__('item telah di ubah'));
					return $this->redirect(array('action'=>'index'));
				}
				$this->Session->setFlash(__('item tidak bisa di rubah'));
			}
			else
			{
				$Item_id = $this->request->params['pass'][0];
				$this->set('Item_id',$Item_id);	
				$data = $this->Item->findById($Item_id);
				$this->set('data',$data);	
				$namak = $this->Item->findById($id);
				$namaSK = $this->Item->Kategori->findById($namak['Kategori']['parent']);
				$namak = $namak['Kategori']['nama'];
				$namaSK = $namaSK['Kategori']['nama'];
				$this->set('namak',$namak);
				$this->set('namaSK',$namaSK);

			$this->set('prev',$data['Kategori']['nama']);			
			$this->set('namaKategori',$this->Item->Kategori->find('list', array('fields' => array('Kategori.nama'),'conditions'=>array('Kategori.parent '=>0))));
			$this->set('namasubKategori',$this->Item->Kategori->find('list', array('fields' => array('Kategori.nama'),'conditions'=>array('Kategori.parent !='=>0))));	
			}
		}
		
	}
?>

