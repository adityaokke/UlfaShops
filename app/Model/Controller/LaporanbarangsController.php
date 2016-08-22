<?php
class LaporanbarangsController extends AppController{
	public $components = array('Paginator');
	public $uses = array('Laporanbarangs','Gudangs');
	

	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('');
    }
    

	public function isAuthorized($user) {
		if(in_array($this->action, array('lihat', 'ajax_see', 'ajax_search'))) {
			if(isset($user['role']) && in_array($user['role'], array('owner', 'manager gudang', 'manager toko'))) {
				return true;
			}
		}
	}

	public function lihat()
	{
		$this->Laporanbarangs->recursive =0;
		$this->Paginator->settings= array(
			'limit'=>5,
			'order'=>array(
				'Laporanbarangs.tanggal_aksi'=>'asc'));
		try
		{
			$this->set('data_gudang',$this->Paginator->paginate('Laporanbarangs'));
		}
		catch(NotFoundException $se){}
	}
	public function ajax_see()
	{
		
		$this->layout='ajax';
		$hasil = $_POST['keyword'];
		if(!empty($_POST['mulai']) || !empty($_POST['akhir']))
		{
			
			$keyword='%'.$hasil.'%';
			$this->paginate = array(
			'conditions' => array(
			    'And' => array(
			    	array(
			        'Laporanbarangs.kodebarang LIKE' => '%'. $keyword . '%',
			        'Laporanbarangs.tanggal_aksi >'=> $_POST['mulai'] ,
			        'Laporanbarangs.tanggal_aksi <'=> $_POST['akhir'] 
			       	),
			       )
			    ),'limit' => 10
			);
			$list = $this->paginate('Laporanbarangs');
			$this->set('list',$list);
			$this->set('hasil','terisi semua tanggal');
		}
		else if(empty($_POST['mulai']) && empty($_POST['akhir']))
		{
			
			$keyword='%'.$hasil.'%';
			$this->paginate = array(
			'conditions' => array(
			    'OR' => array(
			        'Laporanbarangs.kodebarang LIKE' => '%'. $keyword . '%',
			        )
			    ),'limit' => 10
			);
			$list = $this->paginate('Laporanbarangs');
			$this->set('list',$list);
			$this->set('hasil', $_POST['keyword']);
		}
	}
	public function ajax_search()
	{
		
		

	}

}
?>