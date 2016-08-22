<?php
class PenyediaController  extends AppController{
	public $components = array('Paginator');
	public $uses = array('Penyedia','Notabeli');//tabel apa
	
	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('');
    }
    

	public function isAuthorized($user) {
		if(isset($user['role']) && in_array($user['role'], array('owner', 'manager gudang'))) {
			return true;
		}
		else if($this->action === 'index') {
			if(isset($user['role']) && in_array($user['role'], array('owner', 'manager gudang', 'manager toko'))) {
				return true;
			}
		}
		return false;
	}

	public function index()//jadi nama ctp untuk view
	{
		
		$this->Penyedia->recursive = -1;
		$this->Paginator->settings = array(
			'limit' => 5,
			'order' => array(
				'Penyedia.nama' => 'asc')
			);
		try
		{
			$this->set('Penyedia',$this->Paginator->paginate('Penyedia'));//tabel
		}
		catch(NotFoundException $e){}
	}
	public function tambah()
	{
		if($this->request->is('post'))
		{
			$this->Penyedia->save($this->data);
			$this->Session->setFlash(__('supllier telah di tambah'));
   			return $this->redirect(array('action'=>'index'));	
		}
	}
	
	public function helloAjax()
    {
       $this->layout='ajax';

       // result can be anything coming from $this->data
	      if($this->Penyedia->save($this->data))
	      	{
	      		$result =  "sukses";
	       		$this->set("result", $result);
	      	}
	     else
	     {
	     	$result =  "gagal";
	       $this->set("result", $result);
	     }
       
   }
   public function ubah($id=null)
   {
 
	
		$this->Penyedia->id=$id;
		if(!$this->Penyedia->exists())
		{
			throw new Exception(__('item tidak valid'));
		}
   		if($this->request->is('post'))
   		{
   			if($this->Penyedia->save($this->request->data))
   			{
   				$this->Session->setFlash(__('supllier telah di ubah'));
   				return $this->redirect(array('action'=>'index'));
   			}
   			$this->Session->setFlash(__('supplier tidak bisa di rubah'));
   		}
   		else
   		{
   			$Item_id = $this->request->params['pass'][0];
   			$this->set('Supplier_id',$Item_id);
   			$data = $this->Penyedia->findById($Item_id);
   			$this->set('data',$data);
   		}
   }
   public function hapus($id=null)
	{
			$this->request->onlyAllow('post');
			$this->Penyedia->id = $id;
			if($this->Penyedia->delete($id))
			{
				//$user = $this->Gudangs->findByitem_id($id);
				
				$this->Session->setFlash(__('Item telah terhapus'));
				return $this->redirect(array('action'=>'index'));
			}
			$this->Session->setFlash(__('Berita tidak dapat di hapus'));
			
	}
   public function updateopt()
   {
   		$this->layout='ajax';
   		$data = $this->Penyedia->find('all');
   		$this->set("list",$data);
   }
   public function ajax_search()
   {
   		$this->layout='ajax';
   		if(!empty($_POST['keyword']))
   		{
   			$hasil = '%'.$_POST['keyword'].'%';
   			$this->paginate = array(
			'conditions' => array(
			    'OR' => array(
			        'Penyedia.nama LIKE' => '%'. $hasil . '%',
			        )
			    ),'limit' => 10
			);
   		}
		else if(!empty($_POST['alamat']))
		{
			$hasil = '%'.$_POST['alamat'].'%';
   			$this->paginate = array(
			'conditions' => array(
			    'OR' => array(
			        'Penyedia.alamat LIKE' => '%'. $hasil . '%',
			        )
			    ),'limit' => 10
			);
		}
		else if(!empty($_POST['notelp']))
		{
			$hasil = '%'.$_POST['notelp'].'%';
   			$this->paginate = array(
			'conditions' => array(
			    'OR' => array(
			        'Penyedia.telepon LIKE' => '%'. $hasil . '%',
			        )
			    ),'limit' => 10
			);
		}
		else if(!empty($_POST['notelp']) && !empty($_POST['alamat']) && !empty($_POST['keyword']))
		{
			$keyword='%'.$hasil.'%';
			$this->paginate = array(
			'conditions' => array(
			    'And' => array(
			    	array(
			        'Penyedia.nama LIKE' => '%'. $hasil1 . '%',
			        'Penyedia.alamat LIKE' => '%'. $hasil2 . '%',
			        'Penyedia.telepon LIKE' => '%'. $hasil3 . '%'
			       	),
			       )
			    ),'limit' => 10
			);
		}

		$list = $this->paginate('Penyedia');
		$this->set('Penyedia',$list);
		$this->set('hasil',$_POST['keyword']);

   		
   }
	



}

?>