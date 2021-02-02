<?php
namespace api\tests\api;

use api\tests\ApiTester;

class UsersCest
{
    
    public $email = "user@user.com";
    public $password = "123456";

    function _before(ApiTester $I)
    {
        $I->haveFixtures([
            'organization' => [
                'class' => \common\fixtures\OrganizationFixture::className(),
                'dataFile' => codecept_data_dir() . 'organization.php'
            ],
            'user'=>[
                'class' => \common\fixtures\UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php'
            ],
            'userProfile'=>[
                'class' => \common\fixtures\UserProfileFixture::className(),
                'dataFile' => codecept_data_dir() . 'user_profile.php'
            ]
        ]);
        $I->haveHttpHeader('Content-Type', 'application/json');
    }

        /**
      * @dataProvider dataCreateProvider
    */
    public function createUserViaAPI(ApiTester $I, \Codeception\Example $example)
    {
        $I->sendPOST($example['url'], $example['data']);
        $I->seeResponseCodeIs($example['code']);
        $I->seeResponseContainsJson($example['contains']);
    }

    /**
     * @return array
    */
    protected function dataCreateProvider() 
    {
        return [
            [
                'url'=>'user/signup',
                'data'=>[],
                'code'=>400,
                'contains'=>[
                ]
            ],
            [
                'url'=>'user/signup',
                'data'=>[
                    'name' => 'user test', 
                    'email' => $this->email,
                    'locale' => 'ar',
                ],
                'code'=>400,
                'contains'=>[
                    'ORGANIZATION_NOT_FOUND'=>'برجاء ادخال مؤسسة صحيحة',
                ]
            ],
            [
                'url'=>'user/signup',
                'data'=>[
                    'name' => 'user test', 
                    'email' => $this->email,
                    'organization' => 'fake'
                ],
                'code'=>400,
                'contains'=>[
                    "ORGANIZATION_NOT_FOUND"=>"برجاء ادخال مؤسسة صحيحة"
                ]
            ],
            [
                'url'=>'user/signup',
                'data'=>[
                    'name' => 'user test', 
                    'email' => $this->email,
                    'organization' => 'org1',
                    'locale' => 'en',
                ],
                'code'=>400,
                'contains'=>[
                    "password"=>"Password cannot be blank."
                ]
            ],
            [
                'url'=>'user/signup',
                'data'=>[
                    'name' => 'user test', 
                    'email' => $this->email,
                    'password' => $this->password,
                    'bio' => 'add user from api',
                    'mobile'=>'0132323232',
                    'organization' => 'org1',
                ],
                'code'=>400,
                'contains'=>[
                    "mobile"=>"ادخل رقم جوال صحيح"
                ]
            ],
            [
                'url'=>'user/signup',
                'data'=>[
                    'name' => 'user test', 
                    'email' => $this->email,
                    'password' => $this->password,
                    'bio' => 'add user from api',
                    'mobile'=>'0512345678',
                    'organization' => 'org1',
                ],
                'code'=>200,
                'contains'=>[
                    "message"=>"تم انشاء الحساب بنجاح"
                ]
            ],
        ];
    }


    public function loginSuccessAPI(ApiTester $I)
    {
        $I->sendPOST('user/login',[
            'identity' => 'user@test.com',
            'password' => '123456',
        ]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson([
            'success'=>true,
            'data'=>[
                'profile'=>[],
            ],
        ]);

        // $token = $I->grabDataFromResponseByJsonPath('$.data.token');
    }

    /**
      * @dataProvider dataFailProvider
    */
    protected function loginFailAPI(ApiTester $I, \Codeception\Example $example)
    {
        $I->sendPOST($example['url'], $example['data']);
        $I->seeResponseCodeIs($example['code']);
        $I->seeResponseContainsJson($example['contains']);
    }

    /**
     * @return array
    */
    protected function dataFailProvider() 
    {
        return [
            [
                'url'=>'user/login',
                'data'=>[],
                'code'=>400,
                'contains'=>[
                    'INVALID_USERNAME_OR_PASSWORD'=>'البيانات المدخلة غير متطابقة مع البيانات المسجلة لدينا.',
                ]
            ],
            [
                'url'=>'user/login',
                'data'=>[
                    'identity' => $this->email,
                ],
                'code'=>400,
                'contains'=>[
                    'INVALID_USERNAME_OR_PASSWORD'=>'البيانات المدخلة غير متطابقة مع البيانات المسجلة لدينا.',
                ]
            ],
            [
                'url'=>'user/login',
                'data'=>[
                    'identity' => $this->email,
                    'password' => $this->password,
                ],
                'code'=>401,
                'contains'=>[
                    'INVALID_USERNAME_OR_PASSWORD'=>'حسابك لم يتم تفعيله بعد',
                ]
            ],
            [
                'url'=>'user/login',
                'data'=>[
                    'identity' => 'm.edu.95@gmail.com',
                    'password' => 123456,
                ],
                'code'=>401,
                'contains'=>[
                    'INVALID_ROLE'=>'لا تملك صلاحية الدخول',
                ]
            ],
        ];
    }

}

?>
