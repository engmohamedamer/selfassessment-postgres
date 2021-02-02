<?php

use common\models\User;
use common\rbac\Migration;

class m150625_214101_roles extends Migration
{
    /**
     * @return bool|void
     * @throws \yii\base\Exception
     */
    public function up()
    {
        $this->auth->removeAll();

        $user = $this->auth->createRole(User::ROLE_USER);
        $this->auth->add($user);

        $manager = $this->auth->createRole(User::ROLE_MANAGER);
        $this->auth->add($manager);
        $this->auth->addChild($manager, $user);


        $schooladmin = $this->auth->createRole(User::ROLE_SCHOOL_ADMIN);
        $this->auth->add($schooladmin);



        $schoolActivityAdmin = $this->auth->createRole(User::ROLE_SCHOOL_ACTIVITY_ADMIN);
        $this->auth->add($schoolActivityAdmin);



        $officialNDoffice = $this->auth->createRole(User::ROLE_OFFICLAL_NE_OFFICE);
        $this->auth->add($officialNDoffice);




        $admin = $this->auth->createRole(User::ROLE_ADMINISTRATOR);
        $this->auth->add($admin);
        $this->auth->addChild($admin, $manager);
        $this->auth->addChild($admin, $user);

        $this->auth->assign($admin, 1);
        $this->auth->assign($manager, 2);
        $this->auth->assign($user, 3);
    }

    /**
     * @return bool|void
     */
    public function down()
    {
        $this->auth->remove($this->auth->getRole(User::ROLE_ADMINISTRATOR));
        $this->auth->remove($this->auth->getRole(User::ROLE_MANAGER));
        $this->auth->remove($this->auth->getRole(User::ROLE_USER));
        $this->auth->remove($this->auth->getRole(User::ROLE_SCHOOL_ADMIN));
        $this->auth->remove($this->auth->getRole(User::ROLE_SCHOOL_ACTIVITY_ADMIN));


        $this->auth->remove($this->auth->getRole(User::ROLE_OFFICLAL_NE_OFFICE));
    }
}
