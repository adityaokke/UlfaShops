<?php

App::uses('AppModel', 'Model');

App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');



class User extends AppModel {

    public $belongsTo = array(

                'Toko'=> array(

                        'className' => 'Tokos',

                        'foreignKey' => 'toko_id'

                    )

            );

    public $hasMany = array(
                'Notajual'=>array(
                        'className'=>'Notajuals',
                        'foreignKey'=>'user_id'
                    )
            );

    public $validate = array(

        'username' => array(

            'required' => array(

                'rule' => array('notEmpty'),

                'message' => 'A username is required'

            )

        ),

        'password' => array(

            'required' => array(

                'rule' => array('notEmpty'),

                'message' => 'A password is required'

            )

        ),

        'nama_lengkap' => array(

                'required' => array(

                        'rule' => array('notEmpty'),

                        'message' => 'Nama lengkap harus dimasukkan'

                )

        ),

        'role' => array(

            'valid' => array(

                'rule' => array('inList', array('owner', 'manager toko', 'manager gudang', 'kasir')),

                'message' => 'Please enter a valid role',

                'allowEmpty' => false

            )

        )

    );

    

    public function beforeSave($options = array()) {

        if (isset($this->data[$this->alias]['password'])) {

            $passwordHasher = new BlowfishPasswordHasher();

            $this->data[$this->alias]['password'] = $passwordHasher->hash(

                $this->data[$this->alias]['password']

            );

        }

        return true;

    }

    

    function isUniqueEmail($check) {

 

        $email = $this->find(

            'first',

            array(

                'fields' => array(

                    'User.id'

                ),

                'conditions' => array(

                    'User.email' => $check['email']

                )

            )

        );

 

        if(!empty($email)){

            if($this->data[$this->alias]['id'] == $email['User']['id']){

                return true;

            }else{

                return false;

            }

        }else{

            return true;

        }

    }

}

?>