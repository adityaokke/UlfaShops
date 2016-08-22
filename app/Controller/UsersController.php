<?php

App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

App::uses('AppController', 'Controller');

//App::uses('CakePdf', 'CakePdf.Pdf');





class UsersController extends AppController {

    public $components = array('Paginator', 'RequestHandler');

    public $helpers = array('Session');

    public $uses = array('Toko','User');

    public function beforeFilter() {

        parent::beforeFilter();

        $this->Auth->allow('login');

    }

    

    public function isAuthorized($user) {

        if (in_array($this->action, array('logout', 'index'))) {

            return true;

        }

        if (in_array($this->action, array('add', 'delete'))) {

            if (isset($user['role']) && $user['role'] === 'owner') {

                return true;

            }

            return false;

        } else if (in_array($this->action, array('edit', 'chpasswd'))) {

            if (isset($user['role']) &&

                in_array($user['role'], array('owner', 'manager toko', 'manager gudang', 'kasir'))) {

                return true;

            }

            return parent::isAuthorized($user);

        }

        return false;

    }

    

     public function index() {      
        $this->Paginator->settings = array(

                'limit' => 10,

                'order' => array(

                    'User.name' => 'asc'

                ),
                'recursive'=>-1

            );

        

        try {

            $this->set('users', $this->Paginator->paginate('User'));

        } catch (NotFoundException $e) {

            $this->redirect(array('action' => 'index'));

        }



    }

    

    public function chpasswd($id=null) {

        $userid = $id;

        if ($id == null) {

            if ($this->Auth->login()) {

                $userid = $this->Auth->user('id');

            }

        } else {

            $iduser = $this->User->findByIdhash($id);

            if (!empty($iduser)) {

                $userid = $iduser['User']['id'];

            }

        }

        

        $this->User->id = $userid;

        if (!$this->User->exists()) {

            throw new NotFoundException(__('User tidak valid'));

        }

        

        // tambahkan validator untuk field current_password dan retype password

        //

        $this->User->validator()->add('active_password', array('notEmpty'));

        $this->User->validator()->add('password2', array('notEmpty'));

        

        if ($this->request->is('post') || $this->request->is('put')) {

            ////debug($this->request->data);    

            // cek apakah current_password sama dengan yang tersimpan

            $passwordHasher = new BlowfishPasswordHasher();

            

            $userpasswd = $this->User->findById($userid);

            

            if ($passwordHasher->check(

                    $this->request->data['User']['active_password'],

                    $userpasswd['User']['password']) === false ||

                    $this->data['User']['password'] !== $this->data['User']['password2'])

            {

                $this->Session->setFlash(

                    __('Password tidak cocok. Ulangi kembali.')

                );

                $this->request->data = $this->User->read(null, $userid);

                unset($this->request->data['User']['password']);

                unset($this->request->data['User']['password2']);

                unset($this->request->data['User']['active_password']);

            } else {

                if ($this->User->save($this->request->data)) {

                    $this->Session->setFlash(__('User telah tersimpan.'), 'default', array('class' => 'success'));

                    

                    $this->User->validator()->remove('active_password');

                    $this->User->validator()->remove('password2');

                    

                    return $this->redirect(array('action' => 'index'));

                }

                $this->Session->setFlash(

                    __('User tidak dapat diupdate, silahkan dicoba lagi.')

                );

            }

        } else {

            $this->request->data = $this->User->read(null, $userid);

            unset($this->request->data['User']['password']);

        }

    }

    

    public function view($id = null) {

        $this->User->id = $id;

        

        $this->layout = "default";

        $this->theme = NULL;

        

        if (!$this->User->exists()) {

            throw new NotFoundException(__('Invalid user'));

        }

        //$this->pdfConfig = array(

        //        'orientation' => 'portrait',

        //        'filename' => 'user_' . $id

        //    );



        $this->set('user', $this->User->read(null, $id));

    }

    

    public function add() {

        if ($this->request->is('post')) {

            if (!($this->data['User']['password'] === $this->data['User']['password2'])) {

                $this->Session->setFlash(__('Passwords tidak cocok.', true));               

                return;

            }



            $this->request->data['User']['idhash'] = md5('ULFAshops#' . $this->data['User']['username']);

            

            $this->User->create();

            if ($this->User->save($this->request->data)) {

                $this->Session->setFlash(__('The user has been saved'));

                return $this->redirect(array('action' => 'index'));

            }

            $this->Session->setFlash(

                __('The user could not be saved. Please, try again.')

            );

        }

    }

    

    public function edit($id = null) {

        if ($this->request->is('post') || $this->request->is('put')) {

            if ($this->User->save($this->request->data)) {

                $this->Session->setFlash(__('The user has been saved'));

                return $this->redirect(array('action' => 'index'));

            }

            $this->Session->setFlash(

                __('The user could not be saved. Please, try again.')

            );

        } else {

                        

            $userid = $id;

            $isFound = true;

            if ($id == null) {

                if ($this->Auth->login()) {

                    $userid = $this->Auth->user('id');

                }

            } else {

                $iduser = $this->User->findByIdhash($id);

                if (empty($iduser)) {

                    $isFound = false;

                } else {

                    $userid = $iduser['User']['id'];

                }

            }

                      

            

            if ($isFound){

                $this->request->data = $this->User->read(null, $userid);

                unset($this->request->data['User']['password']);

            } else {

                throw new NotFoundException(__('User tidak valid'));

            }

        }

    }



    public function delete($id = null) {

        // Prior to 2.5 use

        // $this->request->onlyAllow('post');

    

        $this->request->allowMethod('post');

    

        $iduser = $this->User->findByIdhash($id);

        

        $userid = $iduser['User']['id'];

        

        $this->User->id = $userid;

        if (!$this->User->exists()) {

            throw new NotFoundException(__('Invalid user'));

        }

        if ($this->User->delete()) {

            $this->Session->setFlash(__('User deleted'));

            return $this->redirect(array('action' => 'index'));

        }

        $this->Session->setFlash(__('User was not deleted'));

        return $this->redirect(array('action' => 'index'));

    }

    

    public function login() {

        if (!$this->Session->check('Auth.User')) {

            if ($this->request->is('post')) {

                if ($this->Auth->login()) {

                    if ($this->request->data['User']['remember_me'] == 1) {

                        // remove "remember me checkbox"

                        unset($this->request->data['User']['remember_me']);                        

                        // hash the user's password

                        $passwordHasher = new BlowfishPasswordHasher();

                        $this->request->data['User']['password'] =

                            $passwordHasher->hash($this->request->data['User']['password']);

                        

                        // write the cookie

                        $this->Cookie->write('its_me_cookie', $this->request->data['User'], true, '2 weeks');

                    }

                    

                    if ($this->Auth->user('role') === 'owner') {

                        return $this->redirect(array('controller' => 'users', 'action' => 'index'));

                    } else {

                        return $this->redirect(array('controller' => 'users', 'action' => 'index'));

                    }

                }

                $this->Session->setFlash(__('Username dan password tidak valid, silahkan ulang kembali'));

            }

        } else {

            if ($this->Session->check('Auth.User.role') === 'admin') {

                $this->redirect(array('controller' => 'users','action' => 'index'));

            } else {

                return $this->redirect(array('controller' => 'main', 'action' => 'index'));

            }

        }

        if ($this->request->is('post')) {

            if ($this->Auth->login()) {

                return $this->redirect($this->Auth->redirect());

            }

            $this->Session->setFlash(__('Invalid username or password, try again'));

        }

    }

    

    public function logout() {

        $this->Session->destroy();

        $this->Cookie->delete('its_me_cookie');

        return $this->redirect($this->Auth->logout());

    }



}

?>