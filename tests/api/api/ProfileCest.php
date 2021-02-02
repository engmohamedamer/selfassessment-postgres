<?php
namespace tests\api\api;

use tests\api\ApiTester;

class ProfileCest
{

    function _before(ApiTester $I)
    {
        $I->haveFixtures([
            'organization' => [
                'class' => \common\fixtures\OrganizationFixture::className(),
                'dataFile' => codecept_data_dir() . 'organization.php'
            ],
            'user' => [
                'class' => \common\fixtures\UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'contributers.php'
            ]
        ]);
    }


//    public function Login(ApiTester $I)
//    {
//        //$I->haveHttpHeader('Content-Type', 'application/json');
//        $I->sendPOST('/login', [
//            'identity' => 'contributor@org1.com',
//            'password' => 'password_0',
//            'locale' => 'ar'
//        ]);
//        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 401
//        $I->seeResponseIsJson();
//    }
//
//    // tests
//    public function getProfile(ApiTester $I)
//    {
//        $I->amBearerAuthenticated('foGDvBiPRrk8MkemGZyZCAudcdxTUtY-HjFW_PlR');
//        $I->haveHttpHeader('Content-Type', 'application/json');
//        $I->sendGET('/profile');
//        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
//        $I->seeResponseIsJson();
//        $I->seeResponseContains('profile');
//
//    }
}

?>
