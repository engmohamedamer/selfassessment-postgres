<?php
namespace api\tests\api;

use api\tests\ApiTester;

class ThemeCest
{


    function _before(ApiTester $I)
    {
        $I->haveFixtures([
            'organization' => [
                'class' => \common\fixtures\OrganizationFixture::className(),
                'dataFile' => codecept_data_dir() . 'organization.php'
            ],
            'organizationTheme' => [
                'class' => \common\fixtures\OrganizationThemeFixture::className(),
                'dataFile' => codecept_data_dir() . 'organization_theme.php'
            ],
            'organizationFooterLinks' => [
                'class' => \common\fixtures\OrganizationThemeFooterLinks::className(),
                'dataFile' => codecept_data_dir() . 'organization_footer_links.php'
            ]
        ]);
    }

    /**
      * @dataProvider dataReportProvider
    */
    public function theme(ApiTester $I, \Codeception\Example $example)
    {
        $I->sendPOST($example['url']);
        $I->seeResponseCodeIs($example['code']);
        $I->seeResponseContainsJson($example['contains']);
    }

    /**
     * @return array
    */
    protected function dataReportProvider() 
    {
        return [
            [
                'url'=>'/theme?org=org1',
                'code'=>200,
                'contains'=>[
                    'organization'=>[
                        'locale'=>'ar'
                    ],
                    'colors'=>[],
                    'footer'=>[
                        'links'=>[],
                        'social_media'=>[],
                    ],
                ],
            ],
            [
                'url'=>'/theme?org=org1&lang=en',
                'code'=>200,
                'contains'=>[
                    'organization'=>[
                        'locale'=>'en'
                    ],
                    'colors'=>[],
                    'footer'=>[
                        'links'=>[],
                        'social_media'=>[],
                    ],
                ],
            ],
            [
                'url'=>'theme?org=org',
                'code'=>404,
                'contains'=>[
                    'ORGANIZATION_NOT_FOUND'=>'Organization not found'
                ],
            ],
        ];
    }


}

?>
