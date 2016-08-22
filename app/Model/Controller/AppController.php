<?php



/**

 * Application level Controller

 *

 * This file is application-wide controller file. You can put all

 * application-wide controller-related methods here.

 *

 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)

 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)

 *

 * Licensed under The MIT License

 * For full copyright and license information, please see the LICENSE.txt

 * Redistributions of files must retain the above copyright notice.

 *

 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)

 * @link          http://cakephp.org CakePHP(tm) Project

 * @package       app.Controller

 * @since         CakePHP(tm) v 0.2.9

 * @license       http://www.opensource.org/licenses/mit-license.php MIT License

 */



App::uses('Controller', 'Controller');



/**

 * Application Controller

 *

 * Add your application-wide methods in the class below, your controllers

 * will inherit them.

 *

 * @package		app.Controller

 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller

 */

class AppController extends Controller {

	public $layout = "basic";

	public $theme = "tema1";

    public $helpers = array('Session','Html');        

    public $components = array(

        'Session',

        'Auth' => array(

            'loginRedirect' => array(

                'controller' => 'main',

                'action' => 'index'

            ),

            'logoutRedirect' => array(

                'controller' => 'main',

                'action' => 'index'

            ),

            'authenticate' => array(

                'Form' => array(

                    'passwordHasher' => 'Blowfish'

                )

            ),

            'authorize' => array('Controller')

        ),

        'Cookie',

        'RequestHandler'

    );



    public function beforeFilter() {

        if (strpos($this->request->url, 'users') === true) {

            if (in_array($this->action, array('index'))) {

                if (isset($user['role']) && $user['role'] === 'owner') {

                $this->Auth->allow('index', 'view');

                }

            }

            else

            $this->Auth->allow('index', 'view');

        }

        else{

         $this->Auth->allow('view');   

        }



        // set cookie

        $this->Cookie->key = 'po90sd67d305bbb4d700d3f5ed3376d6#$%)asGb$@11~_+!@#HKis~#^';

        $this->Cookie->httpOnly = true;
        

        if (!$this->Auth->loggedIn() && $this->Cookie->read('its_me_cookie')) {

            $cookie = $this->Cookie->read('its_me_cookie');



            $user = $this->User->find('first', array(

                'conditions' => array(

                    'User.username' => $cookie['username'],

                    'User.password' => $cookie['password']

                )

            ));

            if ($user && !$this->Auth->login($user['User'])) {

                $this->redirect('/users/logout'); // destroy session & cookie

            }

        }

        

    }

}

