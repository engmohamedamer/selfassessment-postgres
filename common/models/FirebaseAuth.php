<?php 
namespace common\models;

use Yii;

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

trait FirebaseAuth {

    protected $acc;
    protected $firebase;

    // firebase connectFirebaseAuth
    public function connectFirebaseAuth(){
        $this->acc = ServiceAccount::fromJsonFile(Yii::getAlias('@backend'). '/php-with-firebase-ce76b-539e320ea026.json');
        $this->firebase = (new Factory)->withServiceAccount($this->acc)->create();
    }
    
    public function createFirebaseUser($userProperties)
    {
        return $this->getFirebaseAuth()->createUser($userProperties);;
    }

    // firebase getFirebaseAuth
    public function getFirebaseAuth()
    {
        return (new Factory)->withServiceAccount($this->acc)->create()->getAuth();
    }

    // firebase createFirebaseAuthCustomToken
    public function createFirebaseAuthCustomToken($uid)
    {
        return $this->firebase->getAuth()->createCustomToken($uid);
    }
}

?>