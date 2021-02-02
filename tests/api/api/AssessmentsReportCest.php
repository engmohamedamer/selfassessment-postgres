<?php
namespace tests\api\api;
use tests\api\ApiTester;

class AssessmentsReportCest
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
    }

    /**
	  * @dataProvider dataReportProvider
	*/
    public function testReportApi(ApiTester $I, \Codeception\Example $example)
    {
        $I->amBearerAuthenticated('fR4KSiyuXpHYst5c4JSDY0kJ2HLuOb05jMV4FDmD');
    	$I->sendGET($example['url']);
        $I->seeResponseContainsJson($example['contains']);
        $I->seeResponseCodeIs($example['code']);

        $qGainedPoints = $I->grabDataFromResponseByJsonPath('$.data..qGainedPoints');
        // $I->assertEquals(4,5);
        // $I->comment(implode(',', $qGainedPoints));

    }

    /**
     * @return array
    */
    protected function dataReportProvider()
    {
    	return [
            [
                'url'=>'assessments/report/1000',
                'code'=>404,
                'contains'=>[
                    'errors'=>[
                        'message'=>'Survey not found'
                    ],
                ],
            ],
            [
                'url'=>'assessments/report/2',
                'code'=>403,
                'contains'=>[
                    'errors'=>[
                        'message'=>'Forbidden'
                    ],
                ],
            ],
    		[
            	'url'=>'assessments/report/1',
        		'code'=>200,
        		'contains'=>[
        			'data'=>[
        				'generalInfo'=>[
                            'total_points'=>10
                        ]
        			],
        		],
    		],
    	];
    }

    /**
      * @dataProvider dataReportProviderWhenUserUnauthenticated
    */
    public function testReportWhenUserUnauthenticated(ApiTester $I, \Codeception\Example $example)
    {
        $I->sendGET($example['url']);
        $I->seeResponseContainsJson($example['contains']);
        $I->seeResponseCodeIs($example['code']);
    }

    /**
     * @return array
    */
    protected function dataReportProviderWhenUserUnauthenticated()
    {
        return [
            [
                'url'=>'assessments/report/1',
                'code'=>401,
                'contains'=>[
                    'name'=>'Unauthorized'
                ],
            ],

        ];
    }

    /**
      * @dataProvider dataProviderReportForQuestionTypeText
    */
    public function testReportForQuestionTypeText(ApiTester $I, \Codeception\Example $example)
    {
        $I->amBearerAuthenticated('fR4KSiyuXpHYst5c4JSDY0kJ2HLuOb05jMV4FDmD');
        $I->sendGET($example['url']);
        $I->seeResponseContainsJson($example['contains']);
        $I->seeResponseCodeIs($example['code']);
    }

    /**
     * @return array
    */
    protected function dataProviderReportForQuestionTypeText()
    {
        return [
            [
                'url'=>'assessments/report/1',
                'code'=>200,
                'contains'=>[
                    'data'=>[
                        'generalInfo'=>[],
                        'answers'=>[
                            [
                                "qNum"=> 1,
                                "qText"=> "Q1",
                                "qAnswer"=> "Text",
                                "qGainedPoints"=> 5,
                                "qTotalPoints"=> 5,
                                "qCorrectiveActions"=> [],
                                "qType"=> "Single textbox",
                            ]
                        ],
                    ],
                ],
            ],
        ];
    }


    /**
      * @dataProvider dataProviderReportForQuestionTypeMultipleChoice
    */
    public function testReportForQuestionTypeMultipleChoice(ApiTester $I, \Codeception\Example $example)
    {
        $I->amBearerAuthenticated('fR4KSiyuXpHYst5c4JSDY0kJ2HLuOb05jMV4FDmD');
        $I->sendGET($example['url']);
        $I->seeResponseContainsJson($example['contains']);
        $I->seeResponseCodeIs($example['code']);
    }

    /**
     * @return array
    */
    protected function dataProviderReportForQuestionTypeMultipleChoice()
    {
        return [
            [
                'url'=>'assessments/report/1',
                'code'=>200,
                'contains'=>[
                    'data'=>[
                        'generalInfo'=>[],
                        'answers'=>[
                            [],
                            [
                                "qNum"=> 2,
                                "qText"=> "Q2",
                                "qAnswer"=> [
                                    [
                                        "value"=> "Q2 One choice",
                                        "correct"=> false
                                    ],
                                    [
                                        "value"=> "Q2 Two choice",
                                        "correct"=> true
                                    ],
                                    [
                                        "value"=> "Q2 Three choice",
                                        "correct"=> true
                                    ]
                                ],
                                "qGainedPoints"=> 5,
                                "qTotalPoints"=> 5,
                                "qCorrectiveActions"=> [],
                                "qType"=> "Multiple choice",
                                "qAttatchments"=> []
                            ]
                        ],
                    ],
                ],
            ],
        ];
    }

    /**
      * @dataProvider dataProviderReportForQuestionTypeOneChoiceOfList
    */
    public function testReportForQuestionTypeOneChoiceOfList(ApiTester $I, \Codeception\Example $example)
    {
        $I->amBearerAuthenticated('fR4KSiyuXpHYst5c4JSDY0kJ2HLuOb05jMV4FDmD');
        $I->sendGET($example['url']);
        $I->seeResponseContainsJson($example['contains']);
        $I->seeResponseCodeIs($example['code']);
    }

    /**
     * @return array
    */
    protected function dataProviderReportForQuestionTypeOneChoiceOfList()
    {
        return [
            [
                'url'=>'assessments/report/1',
                'code'=>200,
                'contains'=>[
                    'data'=>[
                        'generalInfo'=>[],
                        'answers'=>[
                            [],
                            [],
                            [
                                "qNum"=>3,
                                "qText"=>"Q3",
                                "qAnswer"=>[
                                    "value"=>"Q3 Three choice",
                                    "correct"=>true
                                ],
                                "qGainedPoints"=>5,
                                "qTotalPoints"=>5,
                                "qCorrectiveActions"=>[],
                                "qType"=>"One choise of list",
                                "qAttatchments"=>[],
                            ]

                        ],
                    ],
                ],
            ],
        ];
    }

    /**
      * @dataProvider dataProviderReportForQuestionTypeDropdown
    */
    public function testReportForQuestionTypeDropdown(ApiTester $I, \Codeception\Example $example)
    {
        $I->amBearerAuthenticated('fR4KSiyuXpHYst5c4JSDY0kJ2HLuOb05jMV4FDmD');
        $I->sendGET($example['url']);
        $I->seeResponseContainsJson($example['contains']);
        $I->seeResponseCodeIs($example['code']);
    }

    /**
     * @return array
    */
    protected function dataProviderReportForQuestionTypeDropdown()
    {
        return [
            [
                'url'=>'assessments/report/1',
                'code'=>200,
                'contains'=>[
                    'data'=>[
                        'generalInfo'=>[],
                        'answers'=>[
                            [],
                            [],
                            [],
                            [
                                "qNum"=>4,
                                "qText"=>"Q4",
                                "qAnswer"=>[
                                    "value"=>"Q4 Three choice",
                                    "correct"=>true
                                ],
                                "qGainedPoints"=>5,
                                "qTotalPoints"=>5,
                                "qCorrectiveActions"=>[],
                                "qType"=>"Dropdown",
                                "qAttatchments"=>[],
                            ]
                        ],
                    ],
                ],
            ],
        ];
    }

    /**
      * @dataProvider dataProviderReportForQuestionTypeRanking
    */
    public function testReportForQuestionTypeRanking(ApiTester $I, \Codeception\Example $example)
    {
        $I->amBearerAuthenticated('fR4KSiyuXpHYst5c4JSDY0kJ2HLuOb05jMV4FDmD');
        $I->sendGET($example['url']);
        $I->seeResponseContainsJson($example['contains']);
        $I->seeResponseCodeIs($example['code']);
    }

    /**
     * @return array
    */
    protected function dataProviderReportForQuestionTypeRanking()
    {
        return [
            [
                'url'=>'assessments/report/1',
                'code'=>200,
                'contains'=>[
                    'data'=>[
                        'generalInfo'=>[],
                        'answers'=>[
                            [],
                            [],
                            [],
                            [],
                            [
                                "qNum"=>5,
                                "qText"=>"Q5",
                                "qAnswer"=>[
                                    "Q5 One choice: 1",
                                    "Q5 Two choice: 1",
                                    "Q5 Three choice: 1"
                                ],
                                "qGainedPoints"=>5,
                                "qTotalPoints"=>5,
                                "qCorrectiveActions"=>[],
                                "qType"=>"Ranking",
                                "qAttatchments"=>[],
                            ]
                        ],
                    ],
                ],
            ],
        ];
    }

    /**
      * @dataProvider dataProviderReportForQuestionTypeRating
    */
    public function testReportForQuestionTypeRating(ApiTester $I, \Codeception\Example $example)
    {
        $I->amBearerAuthenticated('fR4KSiyuXpHYst5c4JSDY0kJ2HLuOb05jMV4FDmD');
        $I->sendGET($example['url']);
        $I->seeResponseContainsJson($example['contains']);
        $I->seeResponseCodeIs($example['code']);
    }

    /**
     * @return array
    */
    protected function dataProviderReportForQuestionTypeRating()
    {
        return [
            [
                'url'=>'assessments/report/1',
                'code'=>200,
                'contains'=>[
                    'data'=>[
                        'generalInfo'=>[],
                        'answers'=>[
                            [],
                            [],
                            [],
                            [],
                            [],
                            [
                                "qNum"=>6,
                                "qText"=>"Q6",
                                "qAnswer"=>50,
                                "qGainedPoints"=>5,
                                "qTotalPoints"=>5,
                                "qCorrectiveActions"=>[],
                                "qType"=>"Rating",
                                "qAttatchments"=>[],
                            ]
                        ],
                    ],
                ],
            ],
        ];
    }

    /**
      * @dataProvider dataProviderReportForQuestionTypeCommentBox
    */
    public function testReportForQuestionTypeCommentBox(ApiTester $I, \Codeception\Example $example)
    {
        $I->amBearerAuthenticated('fR4KSiyuXpHYst5c4JSDY0kJ2HLuOb05jMV4FDmD');
        $I->sendGET($example['url']);
        $I->seeResponseContainsJson($example['contains']);
        $I->seeResponseCodeIs($example['code']);
    }

    /**
     * @return array
    */
    protected function dataProviderReportForQuestionTypeCommentBox()
    {
        return [
            [
                'url'=>'assessments/report/1',
                'code'=>200,
                'contains'=>[
                    'data'=>[
                        'generalInfo'=>[],
                        'answers'=>[
                            [],
                            [],
                            [],
                            [],
                            [],
                            [],
                            [
                                "qNum"=>7,
                                "qText"=>"Q7",
                                "qAnswer"=>"Text Box",
                                "qGainedPoints"=>5,
                                "qTotalPoints"=>5,
                                "qCorrectiveActions"=>[],
                                "qType"=>"Comment box",
                                "qAttatchments"=>[],
                            ]
                        ],
                    ],
                ],
            ],
        ];
    }

    /**
      * @dataProvider dataProviderReportForQuestionTypeDate
    */
    public function testReportForQuestionTypeDate(ApiTester $I, \Codeception\Example $example)
    {
        $I->amBearerAuthenticated('fR4KSiyuXpHYst5c4JSDY0kJ2HLuOb05jMV4FDmD');
        $I->sendGET($example['url']);
        $I->seeResponseContainsJson($example['contains']);
        $I->seeResponseCodeIs($example['code']);
    }

    /**
     * @return array
    */
    protected function dataProviderReportForQuestionTypeDate()
    {
        return [
            [
                'url'=>'assessments/report/1',
                'code'=>200,
                'contains'=>[
                    'data'=>[
                        'generalInfo'=>[],
                        'answers'=>[
                            [],
                            [],
                            [],
                            [],
                            [],
                            [],
                            [],
                            [
                                "qNum"=>8,
                                "qText"=>"Q8",
                                "qAnswer"=>"2019-11-28",
                                "qGainedPoints"=>5,
                                "qTotalPoints"=>5,
                                "qCorrectiveActions"=>[],
                                "qType"=>"Date/Time",
                                "qAttatchments"=>[],
                            ]
                        ],
                    ],
                ],
            ],
        ];
    }

    /**
      * @dataProvider dataProviderReportForQuestionTypeFile
    */
    public function testReportForQuestionTypeFile(ApiTester $I, \Codeception\Example $example)
    {
        $I->amBearerAuthenticated('fR4KSiyuXpHYst5c4JSDY0kJ2HLuOb05jMV4FDmD');
        $I->sendGET($example['url']);
        $I->seeResponseContainsJson($example['contains']);
        $I->seeResponseCodeIs($example['code']);
    }

    /**
     * @return array
    */
    protected function dataProviderReportForQuestionTypeFile()
    {
        return [
            [
                'url'=>'assessments/report/1',
                'code'=>200,
                'contains'=>[
                    'data'=>[
                        'generalInfo'=>[],
                        'answers'=>[
                            [],
                            [],
                            [],
                            [],
                            [],
                            [],
                            [],
                            [],
                            [
                                "qNum"=>9,
                                "qText"=>"Q9",
                                "qAnswer"=>[],
                                "qGainedPoints"=>5,
                                "qTotalPoints"=>5,
                                "qCorrectiveActions"=>[],
                                "qType"=>"File",
                                "qAttatchments"=>[],
                            ]
                        ],
                    ],
                ],
            ],
        ];
    }
}
