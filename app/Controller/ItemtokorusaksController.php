<?php

class ItemtokorusaksController extends AppController

{	

	public $layout = "basic";

	public $theme = "tema1";

	public $components = array('Paginator');

	public $uses = array('Toko','Itemtokorusak','Item','Hargaunit','Unit','Itemtoko');

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

			$this->order= array('Itemtokorusak.id' => 'desc');

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


					else {

	            		$this->conditions['Itemtokorusak.'.$param_name] = $value;

	            	}                                       

	            	$this->request->data['Filter'][$param_name] = $value;

	        	}

    		}



		}

			//debug($this->Session->read('kondisi'));



		$this->set("title", 'Daftar Item Toko');

		$dataunits=$this->Unit->find('all');

		
		$this->Itemtoko->unbindModel(array('hasMany'=>array('Transjual','Hargaunit')));
		$this->Paginator->settings = array(

					//'fields'=>'',

					'conditions'=>$this->conditions,

					'limit' => 5,

					'order' =>$this->order,

					'recursive'=>2

				);

		$datas = $this->Paginator->paginate('Itemtokorusak');
		
		$this->set(compact('datas','dataunits'));

		$this->set('search', isset($this->params['named']['search']) ? $this->params['named']['search'] : "");		

	}



	// public function index(){

	// 	$this->set("title", 'Daftar Item Toko');

	// 	$dataunits=$this->Unit->find('all');

		

	// 	$this->Paginator->settings = array(

	// 				'conditions'=>array('Itemtokorusak.toko_id ' => $this->Auth->user('toko_id')),

	// 				'limit' => 5,

	// 				'order' => array('Itemtokorusak.id' => 'desc')

	// 			);

	// 	$datas = $this->Paginator->paginate('Itemtokorusak');

		

	// 	$this->set(compact('datas','dataunits'));

	// }



//JSON -------------------------------------------------------

	public function getdataitem($kode='',$nama='',$p='')

	{

		$this->autoRender = false;

		if($this->request->is('ajax'))

		{

			$conditions['AND']=array();
			array_push($conditions['AND'],

	                		array('Itemtoko.toko_id LIKE' => '%'.$this->Session->read('Auth.User.toko_id').'%')

	                	);			                	
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
			$this->Itemtoko->unbindModel(array('hasMany'=>array('Transjual','Hargaunit')));
			$this->Paginator->settings = array(

					'limit' => 5,

					'order' => array('Item.id' => 'asc'),

					'conditions' => $conditions,

					'page'=>$p,
					'recursive'=>1

				);

			$datas = $this->Paginator->paginate('Itemtoko');

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

		$this->set("title", 'Tambah Itemtokorusak');

		if ($this->request->is('post')) {

			// lakukan operasi insert

			$temp_item=$this->Itemtokorusak->find('first',array('recursive'=>-1,'conditions'=>array('Itemtokorusak.itemtoko_id'=>$this->request->data['Itemtokorusak']['itemtoko_id'])));
			debug($temp_item);
			if (!$temp_item) {			

				$this->Itemtokorusak->create();
				
				if ($this->Itemtokorusak->save($this->request->data)) {

					// jika insert berhasil

					$Itemtoko=$this->Itemtoko->find('first',array('recursive'=>-1,'conditions'=>array('Itemtoko.id'=>$this->request->data['Itemtokorusak']['itemtoko_id'])));

					$this->Itemtoko->id=$this->request->data['Itemtokorusak']['itemtoko_id'];

					$Itemtoko['Itemtoko']['quantity']=$Itemtoko['Itemtoko']['quantity']-$this->request->data['Itemtokorusak']['jumlah'];

					$this->Itemtoko->save($Itemtoko);

					$this->Session->setFlash('Tambah Itemtokorusak berhasil!', 

											 'default',

											 array('class'=>'success'));

					$this->redirect(array('action' => 'index'));

				} else {

					// jika insert gagal

					// tetap tampilkan form

					// flash default adalah 'bad'

					$this->Session->setFlash('Ada kesalahan INSERT data Itemtokorusak.');

				}			

			}else{						

					$this->Itemtokorusak->id=$temp_item['Itemtokorusak']['id'];

					$temp_item['Itemtokorusak']['jumlah']=$temp_item['Itemtokorusak']['jumlah']+$this->request->data['Itemtokorusak']['jumlah'];
					
					if ($this->Itemtokorusak->save($temp_item['Itemtokorusak'])) {

						// jika insert berhasil

						$Itemtoko=$this->Itemtoko->find('first',array('recursive'=>-1,'conditions'=>array('Itemtoko.id'=>$this->request->data['Itemtokorusak']['itemtoko_id'])));

						$this->Itemtoko->id=$this->request->data['Itemtokorusak']['itemtoko_id'];

						$Itemtoko['Itemtoko']['quantity']=$Itemtoko['Itemtoko']['quantity']-$this->request->data['Itemtokorusak']['jumlah'];

						$this->Itemtoko->save($Itemtoko);

						$this->Session->setFlash('Tambah Itemtokorusak berhasil!', 

												 'default',

												 array('class'=>'success'));

						$this->redirect(array('action' => 'index'));

					} else {

						// jika insert gagal

						// tetap tampilkan form

						// flash default adalah 'bad'

						$this->Session->setFlash('Ada kesalahan INSERT data Itemtokorusak.');

					}			

			}



		}

	}



	public function delete($id = null) {

		if ($this->request->is('post')) {

			if ($id) {

				$data = $this->Itemtokorusak->findById($id);

				$this->Itemtokorusak->id = $id;

				$Itemtokorusak=$this->Itemtokorusak->read(null, $id);

				$Itemtoko=$this->Itemtoko->find('first',array('recursive'=>-1,'conditions'=>array('Itemtoko.id'=>$Itemtokorusak['Itemtokorusak']['itemtoko_id'])));

				$this->Itemtoko->id=$Itemtokorusak['Itemtokorusak']['itemtoko_id'];

				$Itemtoko['Itemtoko']['quantity']=$Itemtoko['Itemtoko']['quantity']+$Itemtokorusak['Itemtokorusak']['jumlah'];

				$this->Itemtoko->save($Itemtoko);


				if ($this->Itemtokorusak->delete()) {

					$this->Session->setFlash('Data sudah terhapus', 'default',

											array('class'=>'success'));

				}

			}

		}

		$this->redirect(array('action'=>'index'));

	}



	public function edit2($id = null){

		$this->set('title', 'Edit Item Toko');

		if ($this->request->is('post')) {

			// lakukan operasi UPDATE							

			if ($this->request->data) {				

				

				$Itemtokorusak=$this->Itemtokorusak->read(null, $id);
								
				$Itemtoko=$this->Itemtoko->find('first',array('recursive'=>-1,'conditions'=>array('Itemtoko.id'=>$Itemtokorusak['Itemtokorusak']['itemtoko_id'])));

				$this->Itemtoko->id=$Itemtokorusak['Itemtokorusak']['itemtoko_id'];

				$Itemtoko['Itemtoko']['quantity']=$Itemtoko['Itemtoko']['quantity']+$Itemtokorusak['Itemtokorusak']['jumlah'];

				$this->Itemtoko->save($Itemtoko);

				$Itemtoko=$this->Itemtoko->find('first',array('recursive'=>-1,'conditions'=>array('Itemtoko.id'=>$this->request->data['Itemtokorusak']['itemtoko_id'])));

				$this->Itemtoko->id=$this->request->data['Itemtokorusak']['itemtoko_id'];

				$Itemtoko['Itemtoko']['quantity']=$Itemtoko['Itemtoko']['quantity']-$this->request->data['Itemtokorusak']['jumlah'];

				$this->Itemtoko->save($Itemtoko);

				$Itemtokorusak=$this->Itemtokorusak->read(null, $id);
				$temp_item=$this->Itemtokorusak->find('first',array('recursive'=>-1,'conditions'=>array('Itemtokorusak.itemtoko_id'=>$this->request->data['Itemtokorusak']['itemtoko_id'])));
				if ($temp_item) {
					if ($Itemtokorusak['Itemtokorusak']['id']===$temp_item['Itemtokorusak']['id']) {
						$this->Itemtokorusak->id = $this->request->data['Itemtokorusak']['id'];	
						if ($this->Itemtokorusak->save($this->request->data)) {					

							$this->Session->setFlash('Sunting data telah tersimpan.',

													 'default',

													 array('class'=>'success'));

							$this->redirect(array('action'=>'index'));

						} else {

							$this->Session->setFlash('Maaf, sunting data gagal.');

						}
					}else{					

						$this->Itemtokorusak->id = $id;

						if ($this->Itemtokorusak->delete()) {
							if ($temp_item) {
								$this->Itemtokorusak->id = $id;
								$temp_item['Itemtokorusak']['jumlah']=$temp_item['Itemtokorusak']['jumlah']+$this->request->data['Itemtokorusak']['jumlah'];
								$this->Itemtokorusak->save($temp_item);
							}
							else{
								$this->Itemtokorusak->create();
				
								$this->Itemtokorusak->save($this->request->data);

							}
						}						
					}					
				}


				$this->redirect(array('action'=>'index'));

			} else {

				$this->Session->setFlash('Permintaan tidak valid.');

			}

			

		} else {

			if ($id) {

				try {

					$data = $this->Itemtokorusak->read(null, $id);
					$Itemtokorusak=$this->Item->find('first',array('conditions'=>array('Item.id'=>$data['Itemtoko']['item_id']),'recursive'=>-1));
					$data['Item']=$Itemtokorusak['Item'];
					
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

	public function edit($id = null){

		$this->set('title', 'Edit Item Toko');

		if ($this->request->is('post')) {

			// lakukan operasi UPDATE				

			if ($this->request->data) {				

				$this->Itemtokorusak->id = $this->request->data['Itemtokorusak']['id'];

				$Itemtokorusak=$this->Itemtokorusak->read(null, $id);

				$Itemtoko=$this->Itemtoko->find('first',array('recursive'=>-1,'conditions'=>array('Itemtoko.id'=>$Itemtokorusak['Itemtokorusak']['itemtoko_id'])));

				$this->Itemtoko->id=$Itemtokorusak['Itemtokorusak']['itemtoko_id'];

				$Itemtoko['Itemtoko']['quantity']=$Itemtoko['Itemtoko']['quantity']+$Itemtokorusak['Itemtokorusak']['jumlah'];

				$Itemtoko['Itemtoko']['quantity']=$Itemtoko['Itemtoko']['quantity']-$this->request->data['Itemtokorusak']['jumlah'];

				$this->Itemtoko->save($Itemtoko);
				
				if ($this->Itemtokorusak->save($this->request->data)) {					

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

					$data = $this->Itemtokorusak->read(null, $id);
					$Itemtokorusak=$this->Item->find('first',array('conditions'=>array('Item.id'=>$data['Itemtoko']['item_id']),'recursive'=>-1));
					$data['Item']=$Itemtokorusak['Item'];
					
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

	public function detil($id=null)

	{



		if ($id) {

				try {

					$data = $this->Itemtokorusak->read(null, $id);

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