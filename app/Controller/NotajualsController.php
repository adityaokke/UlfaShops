<?php
//App::uses('Notajual', 'Model');
class NotajualsController extends AppController

{	


	public $layout = "basic";

	public $theme = "tema1";

	public $components = array('Paginator');

	public $uses = array('Notajual','Transjual','Item','Itemtoko','User','Unit','Hargaunit','Toko');

	public $helpers = array('Session');

	



	public function beforeFilter() {
//		$Notajual = new Notajual();
	    parent::beforeFilter();

	    $this->Auth->allow('index','detil','edit','delete','edit_transjual','add_transjual','edit_notajual','getdataitem');

	}

	

	public function isAuthorized($user) {

		if(isset($user['role']) && in_array($user['role'], array('owner', 'manager toko'))) {

			return true;

		}

		return false;

	}

    

	public function index(){
        $this->conditions = array(); //Transform POST into GET 

        $order="";

        $tanggalindex= date('Y-m-d');
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

	                

	                if($name=="tanggalindex"){

	                	$filter_url[$name] = urlencode($value['year'].'-'.$value['month'].'-'.$value['day']);

	                	$tanggalindex=$value['year'].'-'.$value['month'].'-'.$value['day'];

	                }else{	                	

	                	$filter_url[$name] = urlencode($value);

	                }

	            }

			}    

	        // now that we have generated an url with GET parameters, 

	        // we'll redirect to that page

	        return $this->redirect($filter_url);                

		}else{

		// Inspect all the named parameters to apply the filters

			$this->conditions['OR']=array();

			$this->conditions['AND']=array();

        	foreach($this->params['named'] as $param_name => $value){

	            // Don't apply the default named parameters used for pagination

	            ////debug($this->params['named']);

	            if(!in_array($param_name, array('page','sort','direction','limit'))){

	            	// You may use a switch here to make special filters

	            	// like "between dates", "greater than", etc

	            	$order='';

	                if($param_name == "search"){

	                	array_push($this->conditions['OR'],

	                	array('Notajual.pembeli LIKE' => '%' . $value . '%'),	                    

	                    array('User.username LIKE' => '%' . $value . '%'),

	                    array('Notajual.id LIKE' => $value)

	                	);

					}elseif ($param_name == "status") {

						if ($value=='1') {

							array_push($this->conditions['AND'],

		                		array('Notajual.status LIKE' => '%lunas%')

		                	);			                	

						}elseif ($value=='2') {

							array_push($this->conditions['AND'],

		                		array('Notajual.status LIKE' => '%hutang%')

		                	);	

						}

					}elseif ($param_name == "tanggalindex") {

							if($this->params['named']['order']){

								if($this->params['named']['order']=='1')

								$order='=';

								elseif($this->params['named']['order']=='2'){

								$order='<';

								}

								elseif($this->params['named']['order']=='3')

								$order='>';

								array_push($this->conditions['AND'],

			                		array('Notajual.jatuh_tempo '.$order."'".$value."'")

			                	);			      

							}

		                	$tanggalindex=$value;

					}elseif ($param_name == "order") {

						

					}

					else {

	            		$this->conditions['Notajual.'.$param_name] = $value;

	            	}                                       

	            	$this->request->data['Filter'][$param_name] = $value;

	        	}

    		}



		}

		//debug($this->conditions);

			//debug($this->Session->read('kondisi'));

		$this->set("title", 'Daftar Transaksi Jual');

		

		$this->Paginator->settings = array(

			 		'limit' => 10,

					'order' => array('Notajual.id' => 'desc'),

					'conditions' => $this->conditions,
					'recursive'=>0

				);

		

		$datas = $this->Paginator->paginate('Notajual');
		
		$this->set(compact('datas'));

		$this->set('tanggalindex',$tanggalindex);

		$this->set('search', isset($this->params['named']['search']) ? $this->params['named']['search'] : "");

	}



	public function laporan(){

        $this->conditions = array(); //Transform POST into GET 

        $awalbulan=date('Y-m-d');

        $akhirbulan=date("Y-m-t", strtotime(date('Y-m-d')));

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

	        		

	                $filter_url[$name] = urlencode($value['year'].'-'.$value['month'].'-'.$value['day']);

	                if($name=="awalbulan")

	                	$awalbulan=$value['year'].'-'.$value['month'].'-'.$value['day'];

	            	else

	            		$akhirbulan=$value['year'].'-'.$value['month'].'-'.$value['day'];

	            	

	            }

			}       

	        // now that we have generated an url with GET parameters, 

	        // we'll redirect to that page

	        return $this->redirect($filter_url);                

		}else{

		// Inspect all the named parameters to apply the filters

			$a=array();

			$this->conditions['OR']=array();

        	

        	foreach($this->params['named'] as $param_name => $value){

	            // Don't apply the default named parameters used for pagination

	            ////debug($this->params['named']);

	            if(!in_array($param_name, array('page','sort','direction','limit'))){

	            	// You may use a switch here to make special filters

	            	// like "between dates", "greater than", etc

	                if ($param_name == "awalbulan") {

							array_push($a,

		                		array('Notajual.tanggal > ' => $value)

		                	);

		                	array_push($this->conditions['OR'], 

		                		array('Notajual.tanggal' => $value)

		                	);			                							

		                	$awalbulan=$value;

					}elseif ($param_name == "akhirbulan") {

							array_push($a,

		                		array('Notajual.tanggal <' => $value)

		                	);			      

		                	array_push($this->conditions['OR'], 

		                		array('Notajual.tanggal ' => $value)

		                	);			                							

		                	$akhirbulan=$value;

					} 

					else {

	            		$this->conditions['Notajual.'.$param_name] = $value;

	            	}                                       

	            	$this->request->data['Filter'][$param_name] = $value;

	        	}

    		}



		}

			//debug($this->Session->read('kondisi'));

		$this->set("title", 'Laporan Penjualan');

		

		array_push($this->conditions['OR'], 

		                		$a

		                	);	

		$this->Paginator->settings = array(

			 		'limit' => 5,

					'order' => array('Notajual.id' => 'desc'),

					'conditions' => $this->conditions,

					'recursive'=>0

				);

		

		

		$datas = $this->Paginator->paginate('Notajual');

		$temps=$this->Notajual->find('all',array(

			 		'order' => array('Notajual.id' => 'desc'),

					'conditions' => $this->conditions,
					

					'recursive'=>-1


				));

		

		$keuntungan=0;

		$harga_total=0;

		$hutang=0;

		$potong=0;

		foreach ($temps as $key => $value) {

			$keuntungan=$keuntungan+$value['Notajual']['keuntungan_total'];

			$harga_total=$harga_total+$value['Notajual']['harga_total'];

			$hutang=$hutang+$value['Notajual']['hutang'];

			$potong=$potong+$value['Notajual']['potong'];

			// foreach ($value['Transjual'] as $key => $value) {

				

			// }

		}

		$this->set(compact('datas'));

		$this->set('awalbulan',$awalbulan);

		$this->set('akhirbulan',$akhirbulan);

		$this->set('keuntungan',$keuntungan);

		$this->set('harga_total',$harga_total);

		$this->set('harga_total_bersih',$harga_total-$potong);

		$this->set('hutang',$hutang);

		$this->set('potong',$potong);

		$this->set('search', isset($this->params['named']['search']) ? $this->params['named']['search'] : "");

	}



	public function stokitem(){

        $this->conditions = array(); //Transform POST into GET 

        $awalbulan=date('Y-m-d');

        $akhirbulan=date("Y-m-t", strtotime(date('Y-m-d')));

		if(($this->request->is('post') || $this->request->is('put')) && isset($this->data['Filter'])){

	        $filter_url['controller'] = $this->request->params['controller'];

			$filter_url['action'] = $this->request->params['action'];

	        // We need to overwrite the page every time we change the parameters

	        $filter_url['page'] = 1;

	        //debug($this->data['Filter']);

			// for each filter we will add a GET parameter for the generated url

	        foreach($this->data['Filter'] as $name => $value){

	        	if($value){

	        		// You might want to sanitize the $value here

	                // or even do a urlencode to be sure

	        		if($name=="awalbulan"){

	                	$filter_url[$name] = urlencode($value['year'].'-'.$value['month'].'-'.$value['day']);

	                	$awalbulan=$value['year'].'-'.$value['month'].'-'.$value['day'];

	                }elseif ($name=="akhirbulan") {

	                	 $filter_url[$name] = urlencode($value['year'].'-'.$value['month'].'-'.$value['day']);

	                	 $akhirbulan=$value['year'].'-'.$value['month'].'-'.$value['day'];

	                }else{	                	

	                	$filter_url[$name] = urlencode($value);

	                }



	             //    $filter_url[$name] = urlencode($value['year'].'-'.$value['month'].'-'.$value['day']);

	             //    if($name=="awalbulan")

	             //    	$awalbulan=$value['year'].'-'.$value['month'].'-'.$value['day'];

	            	// else

	            	// 	$akhirbulan=$value['year'].'-'.$value['month'].'-'.$value['day'];

	            	

	            }

			}       

	        // now that we have generated an url with GET parameters, 

	        // we'll redirect to that page

	        return $this->redirect($filter_url);                

		}else{

		// Inspect all the named parameters to apply the filters

			$a=array('Toko.id like '.$this->Session->read('Auth.User.toko_id'));

			$this->conditions['OR']=array();

        	

        	foreach($this->params['named'] as $param_name => $value){

	            // Don't apply the default named parameters used for pagination

	            ////debug($this->params['named']);

	            if(!in_array($param_name, array('page','sort','direction','limit'))){

	            	// You may use a switch here to make special filters

	            	// like "between dates", "greater than", etc

	                if ($param_name == "kode") {					                			

		                	array_push($a, 

		                		array('Item.kodebarang LIKE' => '%'. $value . '%')

		                	);

					}elseif ($param_name == "awalbulan") {

							// array_push($a,

		     //            		array('Notajual.tanggal > ' => $value)

		     //            	);

		     //            	array_push($this->conditions['OR'], 

		     //            		array('Notajual.tanggal' => $value)

		     //            	);			                							

		                	$awalbulan=$value;

					}elseif ($param_name == "akhirbulan") {

							// array_push($a,

		     //            		array('Notajual.tanggal <' => $value)

		     //            	);			      

		     //            	array_push($this->conditions['OR'], 

		     //            		array('Notajual.tanggal ' => $value)

		     //            	);			                							

		                	$akhirbulan=$value;

					} 

					else {

	            		$this->conditions['Notajual.'.$param_name] = $value;

	            	}                                       

	            	$this->request->data['Filter'][$param_name] = $value;

	        	}

    		}



		}

			//debug($this->Session->read('kondisi'));

		$this->set("title", 'Laporan Stok Item');	



			array_push($this->conditions['OR'], 

		                		$a

		                	);	

		$this->Paginator->settings = array(

			 		'limit' => 10,

					'order' => array('Item.kodebarang' => 'asc'),

					'fields'=>array('Itemtoko.id','Itemtoko.id','Item.kodebarang','Item.nama'),

					'conditions' => $this->conditions,

					'recursive' => 0

				);

		

		

		$datas = $this->Paginator->paginate('Itemtoko');

		$no=0;

		foreach ($datas as $data) {

			$jum_total=0;

			$time=strtotime($awalbulan);		

			while($time<=strtotime($akhirbulan)){

				$tahun=date("o",$time);

				$datas[$no][$tahun]=array();

				while ($time<=strtotime($tahun.'-12-31')&&$time<=strtotime($akhirbulan)) {					

					$bulan=date("n",$time);

					$tampbulan=array();

					while($time<=strtotime(date("Y-m-t",strtotime($tahun.'-'.$bulan.'-01')))&&$time<=strtotime($akhirbulan)){

						$tanggal=date("j",$time);

						$this->Transjual->unbindModel(array('belongsTo'=>array('Itemtoko')));
						
						$tamp=$this->Transjual->find('all',array(

					  		'order' => array('Transjual.id' => 'asc'),

						 	'conditions' => array('Notajual.tanggal'=>date("Y-m-d",$time),'Transjual.itemtoko_id'=>$data['Itemtoko']['id']),
						 	
						 ));		

						if($tamp){					

							$jum=0;

							 foreach ($tamp as $key) {

							 	$jum=$jum+$key['Transjual']['quantity'];

							 }	

							$tampbulan[$tanggal]=$jum;

							$jum_total=$jum_total+$jum;

						}

						

						$time=strtotime("+1 day",$time);	

					}

					$datas[$no][$tahun][$bulan]=$tampbulan;

				}

				

			}

			$datas[$no]['total']=$jum_total;

			$no=$no+1;



		}

		

		

		$this->set(compact('datas'));

		debug($datas);

		$this->set('awalbulan',$awalbulan);

		$this->set('akhirbulan',$akhirbulan);

		$this->set('kode', isset($this->params['named']['kode']) ? $this->params['named']['kode'] : "");

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

					'order' => array('Itemtoko.id' => 'asc'),

					'conditions' => $conditions,

					'page'=>$p

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



	public function detil($id=''){

		$this->set("title", 'Detil Transaksi Jual');
		$this->set('id',$id);

		

		$this->Paginator->settings = array(

					'limit' => 5,

					'order' => array('Transjual.id' => 'desc'),

					'conditions' => array('Transjual.notajual_id' => $id),

					'recursive'=>2

				);
		$this->Itemtoko->unbindModel(array('belongsTo'=>array('Toko'),'hasMany'=>array('Transjual','Hargaunit')));
		$this->Transjual->unbindModel(array('belongsTo'=>array('Notajual')));
		$datas = $this->Paginator->paginate('Transjual');
		debug($datas);
		$temp=$this->Notajual->find('first',array(

			'conditions' => array('Notajual.id' => $id),

			'recursive'=>-1));
		
		$nama_user=$this->User->findById($temp['Notajual']['user_id']);

		//$nama_pembeli=$this->Pembeli->findById($temp['Notajual']['pembeli_id']);

		$jenis_unit = $this->Unit->find('list',

			array('fields' => array('Unit.id','Unit.nama'),'recursive'=>-1

							));	

		// $isi_unit=	$this->Unit->find('list',

		// 	array('fields' => array('Unit.id','Unit.isi')

		// 					));	

		$hargaunit=$this->Hargaunit->find('list',

			array('fields' => array('Hargaunit.unit_id','Hargaunit.harga','Hargaunit.itemtoko_id'),'recursive'=>-1)

			);
		////debug($datas);

		$this->set(compact('datas','jenis_unit','hargaunit','temp','nama_user'));

		

	}

	public function delete_transjual($id = null) {

		if ($this->request->is('post')) {

			if ($id) {

				$data = $this->Transjual->findById($id);				
				$this->Transjual->id = $id;											
				$this->Itemtoko->id = $data['Itemtoko']['id'];
				
				$data['Itemtoko']['quantity']=$data['Itemtoko']['quantity']+$data['Transjual']['quantity'];
				$this->Itemtoko->save($data);
				$this->Notajual->id=$data['Notajual']['id'];
				$data['Notajual']['harga_total']=$data['Notajual']['harga_total']-$data['Transjual']['total_harga_jual'];
				$data['Notajual']['keuntungan_total']=$data['Notajual']['keuntungan_total']-$data['Transjual']['keuntungan'];
				
				 $this->Notajual->save($data);
				if ($this->Transjual->delete()) {

					$this->Session->setFlash('Data sudah terhapus', 'default',

											array('class'=>'success'));

				}

			}

		}

		 $this->redirect($this->referer());

	}

	public function delete($id = null) {

		if ($this->request->is('post')) {

			if ($id) {

				$data = $this->Notajual->findById($id);				

				$this->Notajual->id = $id;

				if ($this->Notajual->delete()) {

					$this->Session->setFlash('Data sudah terhapus', 'default',

											array('class'=>'success'));

				}

			}

		}

		$this->redirect(array('action'=>'index'));

	}



	public function edit_transjual($id = null){

		$this->set('title', 'Edit Transjual');

		if ($this->request->is('post')) {

			// lakukan operasi UPDATE		

			//debug($this->request->data);

			if ($this->request->data) {

				$this->Transjual->id = $this->request->data['Transjual']['id'];
				$Transjual=$this->Transjual->find('first',array(
					'conditions'=>array('Transjual.id'=>$this->request->data['Transjual']['id']),
					'recursive'=>1
					));
				
				 debug($this->request->data);				
				 debug($Transjual);
								
				$this->Notajual->id = $Transjual['Notajual']['id'];
				$Transjual['Notajual']['harga_total']=$Transjual['Notajual']['harga_total']-$Transjual['Transjual']['total_harga_jual'];
				$this->Notajual->save($Transjual);
				$this->Notajual->id = $Transjual['Notajual']['id'];
				$Transjual['Notajual']['harga_total']=$Transjual['Notajual']['harga_total']+$this->request->data['Transjual']['total_harga_jual'];
				$this->Notajual->save($Transjual);

				$this->Notajual->id = $Transjual['Notajual']['id'];
				$Transjual['Notajual']['keuntungan_total']=$Transjual['Notajual']['keuntungan_total']-$Transjual['Transjual']['keuntungan'];
				$this->Notajual->save($Transjual);
				$this->Notajual->id = $Transjual['Notajual']['id'];
				$Transjual['Notajual']['keuntungan_total']=$Transjual['Notajual']['keuntungan_total']+$this->request->data['Transjual']['keuntungan'];
				$this->Notajual->save($Transjual);
				
				$this->Itemtoko->id = $this->request->data['Transjual']['itemtokoidasli'];
				$Transjual['Itemtoko']['quantity']=$Transjual['Itemtoko']['quantity']+$Transjual['Transjual']['quantity'];
				$this->Itemtoko->save($Transjual);
				$idnota=$Transjual['Notajual']['id'];
				if ($this->request->data['Transjual']['itemtokoidasli']!==$this->request->data['Transjual']['itemtoko_id']) {
					$Transjual=$this->Itemtoko->find('first',array(
						'conditions'=>array('Itemtoko.id'=>$this->request->data['Transjual']['itemtoko_id']),
						'recursive'=>-1
					));	
				}
				
				$this->Itemtoko->id = $this->request->data['Transjual']['itemtoko_id'];
				$Transjual['Itemtoko']['quantity']=$Transjual['Itemtoko']['quantity']-$this->request->data['Transjual']['quantity'];
				$this->Itemtoko->save($Transjual);
				debug($Transjual);

				if ($this->Transjual->save($this->request->data)) {

					$this->Session->setFlash('Sunting data telah tersimpan.',

											 'default',

											 array('class'=>'success'));

					$this->redirect(array('controller'=>'notajuals','action'=>'detil',$idnota));

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

					$item=$this->Item->find('first',array('conditions'=>array('Item.id'=>$data['Itemtoko']['item_id']),'recursive'=>-1));
					
					$this->request->data = $data;

					$this->request->data['Unit']=$this->Unit->find('list',array(

						'fields' => array('Unit.id','Unit.nama'),

						'recursive'=>-1));

					$this->request->data['jenis_unit'] = $this->Unit->find('list',

					array('fields' => array('Unit.nama')

									));

					 $this->request->data['Item']=$item['Item'];					

					// $this->request->data['Hargaunit']=$this->Hargaunit->find('list',array(

					// 	'fields' => array('Hargaunit.unit_id','Hargaunit.harga'),

					// 	'conditions'=>array('Hargaunit.itemtoko_id'=>$data['Itemtoko']['id'])));

					

				} catch (NotFoundException $ex) {

					$this->Session->setFlash('Data tidak ditemukan.');

					$this->redirect($this->referer());

				}

			} else {

				$this->Session->setFlash('Permintaan tidak valid.');

				$this->redirect($this->referer());

			}

		}

	}

	public function add_transjual($id = null){

		$this->set('title', 'Tambah Transjual');

		if ($this->request->is('post')) {

			// lakukan operasi UPDATE		

			//debug($this->request->data);

			if ($this->request->data) {

				$this->Notajual->id = $this->request->data['Transjual']['notajual_id'];
				$Notajual=$this->Notajual->find('first',array(
					'conditions'=>array('Notajual.id'=>$this->request->data['Transjual']['notajual_id']),
					'recursive'=>-1
					));
				$Notajual['Notajual']['harga_total']=$Notajual['Notajual']['harga_total']+$this->request->data['Transjual']['total_harga_jual'];
				$Notajual['Notajual']['keuntungan_total']=$Notajual['Notajual']['keuntungan_total']+$this->request->data['Transjual']['keuntungan'];
				$this->Notajual->save($Notajual);
				
				$Itemtoko=$this->Itemtoko->find('first',array(
					'conditions'=>array('Itemtoko.id'=>$this->request->data['Transjual']['itemtoko_id']),
					'recursive'=>-1
				));	
			
				
				$this->Itemtoko->id = $this->request->data['Transjual']['itemtoko_id'];
				$Itemtoko['Itemtoko']['quantity']=$Itemtoko['Itemtoko']['quantity']-$this->request->data['Transjual']['quantity'];
				$this->Itemtoko->save($Itemtoko);

				$this->Transjual->create();
							
				if ($this->Transjual->save($this->request->data)) {

					$this->Session->setFlash('Sunting data telah tersimpan.',

											 'default',

											 array('class'=>'success'));

					$this->redirect(array('controller'=>'notajuals','action'=>'detil',$this->request->data['Transjual']['notajual_id']));

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
					$this->set('id', $id);
					
					
					$data['jenis_unit'] = $this->Unit->find('list',

					array('fields' => array('Unit.nama'),'recursive'=>-1

									));
					$this->set(compact('data',$data));
					
					

				} catch (NotFoundException $ex) {

					$this->Session->setFlash('Data tidak ditemukan.');

					$this->redirect($this->referer());

				}

			} else {

				$this->Session->setFlash('Permintaan tidak valid.');

				$this->redirect($this->referer());

			}

		}

	}


	public function edit($id=null){

		$this->set('title', 'Edit Notajual');

		if ($this->request->is('post')) {

			// lakukan operasi UPDATE				

			if ($this->request->data) {

				$this->Notajual->id = $this->request->data['Notajual']['id'];

				$this->request->data['Notajual']['status']='hutang';

				if($this->request->data['Notajual']['hutang']<=0){

					$this->request->data['Notajual']['status']='lunas';

				}

				if ($this->Notajual->save($this->request->data)) {



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

					$data = $this->Notajual->read(null, $id);

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

	

	public function cetak($id='') {

		

		$this->layout = "cetak_nota";

		$this->theme = NULL;

	

		$this->Paginator->settings = array(

					

					'order' => array('Transjual.id' => 'asc'),

					'conditions' => array('Transjual.notajual_id' => $id),

					'recursive'=>2

				);

		$datas = $this->Paginator->paginate('Transjual');

		$temp=$this->Notajual->find('first',array(

			'conditions' => array('Notajual.id' => $id),

			'recursive'=>1));

		$nama_user=$this->User->findById($temp['Notajual']['user_id']);

		//$nama_pembeli=$this->Pembeli->findById($temp['Notajual']['pembeli_id']);

		$jenis_unit = $this->Unit->find('list',

			array('fields' => array('Unit.id','Unit.nama')

							));	

		// $isi_unit=	$this->Unit->find('list',

		// 	array('fields' => array('Unit.id','Unit.isi')

		// 					));	

		$hargaunit=$this->Hargaunit->find('list',

			array('fields' => array('Hargaunit.unit_id','Hargaunit.harga','Hargaunit.itemtoko_id'))

			);

		////debug($datas);

		$this->set(compact('datas','jenis_unit','hargaunit','temp','nama_user'));

	}



}

?>