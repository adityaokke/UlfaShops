<?php
class ItemtokosController extends AppController
{	
	public $layout = "basic";
	public $theme = "tema1";
	public $components = array('Paginator');
	public $uses = array('Toko','Itemtoko','Item','Hargaunit','Unit');
	public $helpers = array('Session');

	public function beforeFilter() {
	    parent::beforeFilter('');
	    $this->Auth->allow('index','add','edit','delete','getdataitem','detil');
	}
	
	public function isAuthorized($user) {
		if(isset($user['role']) && $user['role'] === 'manager toko') {
			return true;
		}
		return false;
	}
	
	public function index(){
        $this->conditions = array(); //Transform POST into GET 
		if(($this->request->is('post') || $this->request->is('put')) && isset($this->data['Filter'])){
	        $filter_url['controller'] = $this->request->params['controller'];
			$filter_url['action'] = $this->request->params['action'];
	        // We need to overwrite the page every time we change the parameters
	        $filter_url['page'] = 1;

			// for each filter we will add a GET parameter for the generated url
	        foreach($this->data['Filter'] as $name => $value){
	        	if($value){
	            	// You might want to sanitize the $value here
	                // or even do a urlencode to be sure
	                $filter_url[$name] = urlencode($value);
	            }
			}       
	        // now that we have generated an url with GET parameters, 
	        // we'll redirect to that page
	        return $this->redirect($filter_url);                
		}else{
		// Inspect all the named parameters to apply the filters
			$this->conditions['OR']=array();
			$this->conditions['AND']=array();
			$this->order= array('Itemtoko.id' => 'desc');
			array_push($this->conditions['AND'],
	                	array('Itemtoko.toko_id ' => $this->Auth->user('toko_id'))              
	        );
        	foreach($this->params['named'] as $param_name => $value){
	            // Don't apply the default named parameters used for pagination
	            ////debug($this->params['named']);
	            if(!in_array($param_name, array('page','sort','direction','limit'))){
	            	// You may use a switch here to make special filters
	            	// like "between dates", "greater than", etc	            	
	                if($param_name == "search"){
	                	array_push($this->conditions['OR'],
	                	array('Item.nama LIKE' => '%' . $value . '%'),	                    
	                    array('Item.kodebarang LIKE' => '%' . $value . '%')	                    
	                	);
					}
					elseif ($param_name == "kembar" ){						
						if($value=='1'){
							array_push($this->conditions['AND'], 
								array('`Itemtoko.item_id` in(SELECT `a.item_id` FROM `ulfa_shops`.`itemtokos` AS `a` group by `a.item_id`,`a.toko_id` having count(`a.item_id`) > 1)')
							);
							$this->order= array('Itemtoko.item_id'=>'asc','Itemtoko.tanggal_masuk'=>'asc','Itemtoko.id' => 'desc');
						}						
					}
					else {
	            		$this->conditions['Itemtoko.'.$param_name] = $value;
	            	}                                       
	            	$this->request->data['Filter'][$param_name] = $value;
	        	}
    		}

		}
			//debug($this->Session->read('kondisi'));

		$this->set("title", 'Daftar Item Toko');
		$dataunits=$this->Unit->find('all');
		
		$this->Paginator->settings = array(
					//'fields'=>'',
					'conditions'=>$this->conditions,
					'limit' => 5,
					'order' =>$this->order,
					'recursive'=>0
				);
		$datas = $this->Paginator->paginate('Itemtoko');
		
		$this->set(compact('datas','dataunits'));
		$this->set('search', isset($this->params['named']['search']) ? $this->params['named']['search'] : "");		
	}

	// public function index(){
	// 	$this->set("title", 'Daftar Item Toko');
	// 	$dataunits=$this->Unit->find('all');
		
	// 	$this->Paginator->settings = array(
	// 				'conditions'=>array('Itemtoko.toko_id ' => $this->Auth->user('toko_id')),
	// 				'limit' => 5,
	// 				'order' => array('Itemtoko.id' => 'desc')
	// 			);
	// 	$datas = $this->Paginator->paginate('Itemtoko');
		
	// 	$this->set(compact('datas','dataunits'));
	// }

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
					'order' => array('Item.id' => 'asc'),
					'conditions' => $conditions,
					'page'=>$p
				);
			$datas = $this->Paginator->paginate('Item');
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


	public function add() {
		$this->set("title", 'Tambah Itemtoko');
		$datas=$this->Unit->find('all');
		$this->set(compact('datas'));
		////debug($datas);
		if ($this->request->is('post')) {
			// lakukan operasi insert
			$temp_item=$this->Itemtoko->find('first',array('conditions'=>array('Item.kodebarang'=>$this->request->data['Itemtoko']['kodebarang'])));

			if (!$temp_item) {
			
				$this->Itemtoko->create();
				$this->request->data['Itemtoko']['tanggal_masuk']=date("Y-m-d H:i:s");
				if ($this->Itemtoko->save($this->request->data)) {
					// jika insert berhasil
					$id=$this->Itemtoko->getLastInsertID();
					//debug($this->request->data);
					foreach ($this->request->data['Hargaunit'] as $data) {
						//debug($data);
						$this->Hargaunit->create();
						$this->request->data['Hargaunit']['itemtoko_id']=$id;
						$this->request->data['Hargaunit']['unit_id']=$data['unit_id'];
						$this->request->data['Hargaunit']['untung']=$data['untung'];
						$this->request->data['Hargaunit']['harga']=$data['harga'];
						if ($data['harga']=='') {
							$this->request->data['Hargaunit']['harga']='0';
						}
						if ($data['untung']=='') {
							$this->request->data['Hargaunit']['untung']='0';
						}					
							$this->Hargaunit->save($this->request->data);					
					}

					$this->Session->setFlash('Tambah Itemtoko berhasil!', 
											 'default',
											 array('class'=>'success'));
					$this->redirect(array('action' => 'index'));
				} else {
					// jika insert gagal
					// tetap tampilkan form
					// flash default adalah 'bad'
					$this->Session->setFlash('Ada kesalahan INSERT data Itemtoko.');
				}			
			}else{						
					$this->Itemtoko->id=$temp_item['Itemtoko']['id'];
					$temp_item['Itemtoko']['quantity']=$temp_item['Itemtoko']['quantity']+$this->request->data['Itemtoko']['quantity'];
					$this->Itemtoko->save($temp_item['Itemtoko']);
			}

		}
	}

	public function delete($id = null) {
		if ($this->request->is('post')) {
			if ($id) {
				$data = $this->Itemtoko->findById($id);
				$this->Itemtoko->id = $id;
				if ($this->Itemtoko->delete()) {
					$this->Session->setFlash('Data sudah terhapus', 'default',
											array('class'=>'success'));
				}
			}
		}
		$this->redirect(array('action'=>'index'));
	}

	public function edit($id = null){
		$this->set('title', 'Edit Item Toko');
		if ($this->request->is('post')) {
			// lakukan operasi UPDATE				
			if ($this->request->data) {				
				$this->Itemtoko->id = $this->request->data['Itemtoko']['id'];
				if ($this->Itemtoko->save($this->request->data)) {					
					foreach ($this->request->data['Hargaunit'] as $data) {
						if(!$data['id']){
							$this->Hargaunit->create();
						}
						$this->Hargaunit->id=$data['id'];
						if($data['harga']==''){
							$data['harga']='0';
						}						
						$data['itemtoko_id']=$this->Itemtoko->id;
						$this->Hargaunit->save($data);
					}
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
			
		} else {
			if ($id) {
				try {
					$data = $this->Itemtoko->read(null, $id);
					//$this->set(compact('data'));
					$this->request->data = $data;
					$datas=$this->Unit->find('all');
					$this->set(compact('datas'));		
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
	
	public function detil($id=null)
	{

		if ($id) {
				try {
					$data = $this->Itemtoko->read(null, $id);
					$this->set(compact('data'));
					$this->request->data = $data;
					$datas=$this->Unit->find('all');
					$this->set(compact('datas'));	
					
				} catch (NotFoundException $ex) {
					$this->Session->setFlash('Data tidak ditemukan.');
					//$this->redirect(array('action'=>'index'));
				}
			} else {
				$this->Session->setFlash('Permintaan tidak valid.');
				//$this->redirect(array('action'=>'index'));
			}
	}
}
?>

