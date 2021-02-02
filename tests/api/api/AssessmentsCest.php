<?php
namespace tests\api\api;
use tests\api\ApiTester;
use common\fixtures\AssessmentQuestionsFixture;

class AssessmentsCest
{

	public function _before(ApiTester $I)
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
            ],
            'user'=>[
                'class' => \common\fixtures\UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php'
            ],
            'userProfile'=>[
                'class' => \common\fixtures\UserProfileFixture::className(),
                'dataFile' => codecept_data_dir() . 'user_profile.php'
            ],
            'assessments' => [
                'class' => \common\fixtures\AssessmentFixture::className(),
                'dataFile' => codecept_data_dir() . 'assessments.php'
            ],
            'assessmentsStats' => [
                'class' => \common\fixtures\AssessmentsStatsFixture::className(),
                'dataFile' => codecept_data_dir() . 'assessments_stats.php'
            ],
            'assessmentsQuestion' => [
                'class' => \common\fixtures\AssessmentQuestionsFixture::className(),
                'dataFile' => codecept_data_dir() . 'asessment_questions.php'
            ],
            'assessmentsQuestionAnswers' => [
                'class' => \common\fixtures\AssessmentQuestionAnswersFixture::className(),
                'dataFile' => codecept_data_dir() . 'asessment_questions_answers.php'
            ],
        ]);
        $I->amBearerAuthenticated('fR4KSiyuXpHYst5c4JSDY0kJ2HLuOb05jMV4FDmD');
    }

    // tests
    public function list(ApiTester $I)
    {
    	$I->sendGET('assessments');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson([
        	'items'=>[
                [
                    'id'=>5,
                    'isClosed'=> false,
                    'status'=> 0,
                    'survey_time_to_pass'=>10,
                    'expiryDate'=>'2019-12-28 13:50:00',
                ],
                [
                    'id'=>4,
                    'isClosed'=> false,
                    'status'=> 2,
                    'survey_time_to_pass'=>10,
                    'expiryDate'=>'2019-12-28 13:50:00',
                ],
                [
                    'id'=>3,
                    'isClosed'=> true,
                    'status'=> 0,
                    'survey_time_to_pass'=>10,
                    'expiryDate'=>'2019-12-01 13:50:00',
                ],
                [
                    'id'=>2,
                    'isClosed'=> true,
                    'status'=> 0,
                    'survey_time_to_pass'=>10,
                    'expiryDate'=>'2019-12-26 13:50:00',
                ],
                [
                    'id'=>1,
                    'isClosed'=> false,
                    'status'=> 1,
                    'survey_time_to_pass'=>10,
                    'expiryDate'=>'2019-12-26 13:50:00',
                ]
        	],
    	]);
    	// $this->assessment = $I->grabDataFromResponseByJsonPath('$.items..id');
    }

    /**
	  * @dataProvider dataViewProvider
	*/
    public function view(ApiTester $I, \Codeception\Example $example)
    {
    	$I->sendGET($example['url']);
        $I->seeResponseCodeIs($example['code']);
        $I->seeResponseContainsJson($example['contains']);
    }

    /**
     * @return array
    */
    protected function dataViewProvider()
    {
    	return [
            [
                'url'=>'assessments/1000',
                'code'=>404,
                'contains'=>[
                    'errors'=>['message'=>'Survey not found'],
                ],
            ],
    		[
            	'url'=>'assessments/1',
        		'code'=> 200,
        		'contains'=>[
        			'pages'=>[],
        		],
    		],
    		// [
      //       	'url'=>'assessments/2',
      //   		'code'=> 403,
      //   		'contains'=>[
      //   			'errors'=>['message'=>'Forbidden'],
      //   		],
    		// ],
      //       [
      //           'url'=>'assessments/3',
      //           'code'=> 403,
      //           'contains'=>[
      //               'errors'=>['message'=>'Forbidden'],
      //           ],
      //       ],
      //       [
      //           'url'=>'assessments/4',
      //           'code'=> 403,
      //           'contains'=>[
      //               'errors'=>['message'=>'Forbidden'],
      //           ],
      //       ],
            [
                'url'=>'assessments/5',
                'code'=> 200,
                'contains'=>[
                    'pages'=>[],
                ],
            ],

    	];
    }
}
