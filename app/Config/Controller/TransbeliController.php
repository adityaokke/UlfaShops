<?php
class TransbeliController extends AppController
{
	public $components = array('Paginator');
	public $uses = array('Transbeli','Notabeli','Gudangs');
	
	public function isAuthorized($user) {
		if(isset($user['role']) && in_array($user['role'], array('owner', 'manager gudang'))) {
			return true;
		}
		return false;
	}
	
	public function index()
	{
		return $this->redirect(array('controller'=>'Notabeli','action'=>'sistem',$this->request->params['pass'][0]));	
	}
	public function comit()
	{
		$this->layout = 'ajax';
		$query = $this->Transbeli->query("select SUM(`total`) from `transbelis` where `notabeli_id` = '".$this->request->params['pass'][0]."'");
		$total = $query[0][0]['SUM(`total`)'];
		$this->set('id',$this->request->params['pass'][0]);

		$this->set('total',$total);

	}
	public function lihatharga()
	{
		$this->Notabeli->Transbeli->recursive = 4;
		$data = $this->Transbeli->findBygudangs_id(1);
		//debug($data);
	}
	public function ajax_harga_beli()
	{

		$this->layout='ajax';
		$kb = $this->request->data['keyword'];
		$idgudang = $this->Gudangs->findBykodebarang($kb);
		$this->Transbeli->recursive =0;
		////debug($idgudang['Gudangs']['id']);
		
		$list = $this->Transbeli->find('all');
		////debug($list);
		$this->set('list',$list);

	}
	public function stokbulanan()
	{
		
		if(!$this->request->data['Post']['bulan'])
		{
		$month = 1;
		$year = 2015;
		}
		else
		{
		$year = $this->request->data['Post']['tahun']+2011	;
		$month = $this->request->data['Post']['bulan'];
		}
		

		
		$this->Transbeli->recursive = 1;
		$this->Transbeli->test();
		$sum = $this->Transbeli->find('all', array(
		    'fields'     =>  array(
		    	"total",
		    	"SUM((Transbeli.quantity)) as 'total_beli'",
		    	"Gudangs.kodebarang",
		    	"tanggal_beli", 
		    	"Gudangs.quantity",
		    	"nama"),
		    'conditions' => array(
			    'And' => array(
			    	array(
			        'Year(Transbeli.tanggal_beli) ' => $year,
			        'Month(Transbeli.tanggal_beli) ' => $month
			        ),
			       )
			    ),
		    'group'      =>  "Transbeli.gudangs_id",

		));
		
		$this->set('datas',$sum);
		$this->set('bln',$month);
		$this->set('thn',$year);
	}

	public function finish($id=null)
	{
		$this->Transbeli->Notabeli->id = $id;
		if(!$this->Transbeli->exists())
		{
			////debug('eror');
		}	
		if($this->request->is('post'))
		{
			////debug($this->request->data);
		}
	}
	public function ubah($id=null)
	{
		$this->Transbeli->id = $id;
		if(!$this->Transbeli->exists())
		{
			////debug('eror');
		}	
		if($this->request->is('post'))
		{
			
			$data = $this->request->data;
			$temp = $this->Gudangs->findBykodebarang($data['Transbeli']['kodebarang']);
			$data['Transbeli']['gudangs_id'] = $temp['Gudangs']['id'];
			$data['Transbeli']['total'] = $data['Transbeli']['harga'] * $data['Transbeli']['quantity'];
			if($this->Transbeli->save($data['Transbeli']))
			{
				 $this->Session->setFlash(__('nota telah di ubah.'));	
			}
			else
			{
				$this->Session->setFlash(__('nota gagal di ubah.'));	
			}
			return $this->redirect(array('controller'=>'Notabeli','action'=>'sistem',$this->request->params['pass'][0]));	
		}
		else
		{
			$id_trans = $this->request->params['pass'][0];
			$data = $this->Transbeli->findByid($id_trans);
			$kodebarang = $this->Transbeli->Gudangs->findByid($data['Transbeli']['gudangs_id']);
			$this->set('kodebarang',$kodebarang['Item']['kodebarang']);
			$this->set('id_trans',$id_trans);
			$this->set('data',$data);
		}
	}
	
	public function tambah()
	{
		$this->layout = 'ajax';
		
		if($this->request->is('post'))
		{
			$data = $this->request->data;
			
			$data['Transbeli']['total'] = $data['Transbeli']['quantity'] * $data['Transbeli']['harga'];
			$temp = $this->Gudangs->findBykodebarang($data['Post']['kodebarang']);
			if(!empty($temp))
			{
				$con = $this->Transbeli->find('first',array(
				'conditions'=>array(
					'Transbeli.gudangs_id' =>$temp['Gudangs']['id'],
					'Transbeli.notabeli_id' => $data['Transbeli']['notabeli_id']
					)
				));
				if(isset($con) && !empty($con))
				{
					////debug('data ada yang sama');	
				}
				else
				{
					$data['Transbeli']['gudangs_id'] = $temp['Gudangs']['id'];
					$this->Transbeli->create();
					if($this->Transbeli->save($data['Transbeli']))
					{
						$this->paginate = array(
						'conditions' => array(
						    'OR' => array(
						        'Transbeli.notabeli_id =' => $data['Transbeli']['notabeli_id']
						        )
						    ),'limit' => 10
						);
						$daftaritem = $this->paginate('Transbeli');
						$ok = 0;
						$this->set('status',$ok);

						$this->set('data_beli',$daftaritem);
					}	
				}
				
			}
			else
				{
					
					$ok = 1;
						$this->set('status',$ok);
				}
		}
				
		
	}
	
	/*public function info()
	{
		$this->TransBuyers->recursive = 0;
		$this->Paginator->settings = array(
			'limit'=>5,
			'order'=>array('TransBuyers.id' => 'asc'));
		try
		{
			$this->set('TransBuyers',$this->Paginator->paginate('TransBuyers'));
		}
		catch(NotFoundException $e){}
	}

	public function tambah()
	{
		if($this->request->is('post'))
		{
			$this->TransBuyers->create();
			if($this->TransBuyers->save($this->request->data))
			{
				$this->Session->$this->session->set_flash(__('nota telah disimpan'));
				return $this->redirect(array('action'=>'index'));
			}
			$this->Session->setFlash(__('nota tidak dapat ditambahkan'));
		}
	}
	public function hapus($id=null)
	{

	}*/
}

?>