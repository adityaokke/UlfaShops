		<?php
	Class NotabeliController extends AppController
	{
		public $components  = array('Paginator');
		public $uses = array('Penyedia','Notabeli','Transbeli','Item');
		public $helpers = array('html', 'form');
		
		public function isAuthorized($user) {
			if(isset($user['role']) && in_array($user['role'], array('owner', 'manager gudang'))) {
				return true;
			}
			return false;
		}
		
		public function index()
		{

			$this->set('daftarpenyedia',$this->Notabeli->Penyedia->find('all'));
			if($this->request->is('post'))
			{
				$this->Notabeli->create();
				$this->request->data['Notabeli']['tanggal']=DboSource::expression('NOW()');
				$this->Notabeli->save($this->request->data['Notabeli']);
				return	$this->redirect(array('action'	=>	'sistem',$this->Notabeli->getLastInsertID()));	
				
			}
			
			$this->Notabeli->recursive =0;
			$this->Paginator->settings = array(
				'limit' => 5,
				'order' => array('Notabeli.id' => 'asc')
				);
			try
			{
				$this->set('datas',$this->Paginator->paginate('Notabeli'));
			}
			catch(NotFouncException $e){}
			
		}
		
		public function showhutang()
		{
			$this->paginate = array(
			'conditions' => array(
			    'And' => array(
			    	array(
			        'Notabeli.status LIKE' => '%hutang%'
			        ),
			       )
			    ),'limit' => 10
			);
			$list = $this->paginate('Notabeli');
			$this->set('list',$list);
			
		}
		public function searchnota()
		{
			$this->layout='ajax';
			$hasil = $_POST['keyword'];
			$keyword='%'.$hasil.'%';
			$this->paginate = array(
			'conditions' => array(
			    'And' => array(
			    	array(
			        'Penyedia.nama LIKE' => '%'.$keyword.'%',
			        'Notabeli.status LIKE' => '%hutang%'
			        ),
			       )
			    ),'limit' => 10
			);
			$list = $this->paginate('Notabeli');
			$this->set('list',$list);
			
		}
		public function searchpenyedia()
		{
			
				
				$this->paginate = array(
				'conditions' => array(
				    'OR' => array(
				        'Notabeli.penyedia_id =' => $this->request->params['pass'][0]
				        )
				    ),'limit' => 10
				);
				$data_beli = $this->paginate('Notabeli');
				$this->set('data_beli',$data_beli);
		}

		public function selesai($id = null)
		{
			$this->Notabeli->id = $id;
			$this->Notabeli->Transbeli->recursive=-2;
			$data = $this->request->data['Notabeli'];
			$update = $this->Transbeli->find('all',array('conditions',array('notabeli_id'=>$id)));
			$this->loadModel('Gudangs');
				
			foreach($update as $up)
			{
				
				$up['Gudangs']['quantity'] = $up['Gudangs']['quantity'] + $up['Transbeli']['quantity'];
				$this->Gudangs->save($up['Gudangs']);
				
			}
			
			if($this->Notabeli->save($this->request->data))
			{
				
				$this->Session->setFlash(__('Nota selesai di ACC'));
				return $this->redirect(array('action'=>'index'));
			}
			$this->Session->setFlash(__('nota tidak dapat di ACC terjadi kesalahan sistem'));

		}
		public function updatenota($id = null)
		{
			$this->Notabeli->id = $id;
			$this->Notabeli->Transbeli->recursive=-2;
			$data = $this->request->data['Notabeli'];
			$update = $this->Transbeli->find('all',array('conditions',array('notabeli_id'=>$id)));
			
			
			if($this->Notabeli->save($this->request->data))
			{
				
				$this->Session->setFlash(__('Nota selesai di ACC'));
				return $this->redirect(array('action'=>'index'));
			}
			$this->Session->setFlash(__('nota tidak dapat di ACC terjadi kesalahan sistem'));

		}
		public function lunaskan()
		{
			$this->Notabeli->id = $id;
			$id = $this->request->params['pass'][0];
			$data = $this->Notabeli->findById($id);
			$data = $data['Notabeli'];
			$data['hutang'] = 0;
			$data['bayar'] = $data['total_bayar'];
			$data['status']='lunas';
			if($this->Notabeli->save($data))
			{
				
				$this->Session->setFlash(__('status menjadi lunas'));
				return $this->redirect(array('action'=>'index'));
			}
			$this->Session->setFlash(__('perubahan status gagal'));


		}
		public function hapus($id=null)
		{
			$this->request->onlyAllow('post');
			$this->Notabeli->id = $id;
			
			if(!$this->Notabeli->exists())
			{
				throw new NotFoundException(__('Notabeli tidak ditemukan : kesalahan sistem'));
			}
			if($this->Notabeli->delete($id,true))
			{
				$this->Session->setFlash(__('Notabeli sudah dihapus'));
				return $this->redirect(array('action'=>'index'));
			}
			$this->Session->setFlash(__('Berita tidak dapat di hapus'));
		}
		public function ubah($id=null)
		{
			$data = $this->Notabeli->findById($this->request->params['pass'][0]);
			$this->set('data',$data['Notabeli']);
		}
		public function sistem()
		{
			if($this->request->params['pass'][0])
			{

				$this->Paginator->settings = array(
					'conditions'=>array('Transbeli.notabeli_id ' => $this->request->params['pass'][0]),
					'limit' => 10,
					'order' => array(
						'Transbeli.id' => 'asc')
					);
				try
				{
					$this->set('data_beli',$this->Paginator->paginate('Transbeli'));//tabel
				}
				catch(NotFoundException $e){}
				
				
				
					
					$status = $this->Notabeli->findById($this->request->params['pass'][0]);
					$this->set('status',$status['Notabeli']['status']);
					$this->set('namaKategori',$this->Item->Kategori->find('list', array('fields' => array('Kategori.nama'),'conditions'=>array('Kategori.parent '=>0))));
					$this->set('namasubKategori',$this->Item->Kategori->find('list', array('fields' => array('Kategori.nama'),'conditions'=>array('Kategori.parent !='=>0))));

			}
			else
			{
				return $this->redirect(array('controller'=>'Gudangs','action'=>'sistem',$this->request->query['penyedia_id']));
			}
				

			

		}
		public function buatnota()
		{
			$this->Notabeli->create();
			if($this->request->is('get'))
			{
				$this->Notabeli->save($this->request->query);
				$this->Session->setFlash(__('nota telah di buat.'));
				


			}

				return $this->redirect(array('action'=>'sistem',$this->Notabeli->getLastInsertId()));

			
		}
		public function tambah()
		{

			//mengambil id barang dari item dengan kodebarang
				$idbarang = $this->Item->findByKodebarang($this->request->data['Post']['kodebarang']);
				$iditem = $idbarang['Item']['id'];
				$idkategori = $idbarang['Item']['kategori_id'];
				$item = $this->request->data;
				
				//menambahkan item id ke array item supaya bisa di save
				
				$item['Transbeli']['kategori_id']=$idkategori;
				$item['Transbeli']['item_id']=$iditem;
				$item['Transbeli']['total']=$item['Transbeli']['quantity']*$item['Transbeli']['harga'];
				
				//menyimpan item ke tabel transbeli
				$this->Transbeli->create();
				$this->Transbeli->save($item);

				
				return	$this->redirect(array('action'=>'sistem',$this->request->data['Transbeli']['notabeli_id']));	
		}
		public function comit()
		{
				$query = $this->Post->query("select SUM(`total`) from `transbelis` where `notabeli_id` = '17'");
				
		}
		


	}

?>