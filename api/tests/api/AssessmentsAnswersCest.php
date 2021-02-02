<?php 
namespace api\tests\api;
use api\tests\ApiTester;
use common\fixtures\AssessmentQuestionAnswersFixture;
use common\fixtures\AssessmentQuestionsFixture;

class AssessmentsAnswersCest
{

    public function _before(ApiTester $I)
    {
        $I->haveFixtures([
            'user' => [
                'class' => \common\fixtures\UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php'
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
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->amBearerAuthenticated('fR4KSiyuXpHYst5c4JSDY0kJ2HLuOb05jMV4FDmD');
    }

    /**
      * @dataProvider dataProvider
    */
    public function testAnswerAssessment(ApiTester $I, \Codeception\Example $example)
    {
        $I->sendPUT($example['url'],$example['data']);
        $I->seeResponseContainsJson($example['contains']);
        $I->seeResponseCodeIs($example['code']);
    }

    /**
     * @return array
    */
    protected function dataProvider() 
    {
        return [
            [
                'url'=>'assessments/1000',
                'code'=>404,
                'data'=>[
                ],
                'contains'=>[
                    'message'=>'Assessment not found', // not found because assessment id does not exist
                ],
            ],
            [
                'url'=>'assessments/1',
                'code'=>400,
                'data'=>[
                ],
                'contains'=>[
                    'errors'=>['message'=>'Invalid Params'], // because key answer not sent
                ],
            ],
            [
                'url'=>'assessments/1',
                'code'=>200,
                'data'=>[
                    "answers"=>[],
                ],
                'contains'=>[
                    'success'=>true
                ],
            ],
        ];
    }

    /**
      * @dataProvider dataProviderForQuestionTypeText
    */
    public function testAnswerForQuestionTypeText(ApiTester $I, \Codeception\Example $example)
    {
        $I->sendPUT($example['url'],$example['data']);
        $I->seeResponseContainsJson($example['contains']);
        $I->seeResponseCodeIs($example['code']);
    }

    /**
     * @return array
    */
    protected function dataProviderForQuestionTypeText() 
    {
        // Single textbox id -> 6
        return [
            [
                'url'=>'assessments/1',
                'code'=>403,
                'data'=>[
                    "answers"=>[
                        "q-1"=>"نصي  جواب مع صورة",
                        "f-1"=>true,
                        "a-1"=>[
                            [
                                "name"=>"64682197_2320155574731095_6761853737519546368_n.png",
                                "type"=>"image/png",
                                "content"=>"http://storage.selfassest.localhost/source/answers/64682197_2320155574731095_6761853737519546368_n.png"
                            ],
                        ],
                    ],
                ],
                'contains'=>[
                    'errors'=>['message'=>'Forbidden'], // forbidden because this question not allowed attach file
                ],
            ],
            [
                'url'=>'assessments/1',
                'code'=>400,
                'data'=>[
                    "answers"=>[
                        "q-1"=>[1,2,3],
                    ],
                ],
                'contains'=>[
                    'errors'=>['message'=>'Bad Request'], // bad request because this question not allowe array answers
                ],
            ],
            [
                'url'=>'assessments/1',
                'code'=>200,
                'data'=>[
                    "answers"=>[
                        "q-1"=>"Text",
                    ],
                ],
                'contains'=>[
                    'success'=>true
                ],
            ],
        ];
    }

    /**
      * @dataProvider dataProviderForQuestionTypeMultipleChoice
    */
    public function testAnswerForQuestionTypeMultipleChoice(ApiTester $I, \Codeception\Example $example)
    {
        $I->sendPUT($example['url'],$example['data']);
        $I->seeResponseContainsJson($example['contains']);
        $I->seeResponseCodeIs($example['code']);
    }

    /**
     * @return array
    */
    protected function dataProviderForQuestionTypeMultipleChoice() 
    {
        // Multiple choice id -> 1
        return [
            [
                'url'=>'assessments/1',
                'code'=>200,
                'data'=>[
                    "answers"=>[
                        "q-2"=> [],
                    ],
                ],
                'contains'=>[
                    'success'=>true
                ],
            ],
            [
                'url'=>'assessments/1',
                'code'=>400,
                'data'=>[
                    "answers"=>[
                        "q-2"=>[4,5,6],
                    ],
                ],
                'contains'=>[
                    'errors'=>['message'=>'Bad Request'], // bad request because this question not have answers ids sent
                ],
            ],
            [
                'url'=>'assessments/1',
                'code'=>200,
                'data'=>[
                    "answers"=>[
                        "q-2"=>[1,2,3],
                    ],
                ],
                'contains'=>[
                    'success'=>true
                ],
            ],
        ];
    }

    /**
      * @dataProvider dataProviderForQuestionTypeOneChoiceOfList
    */
    public function testAnswerForQuestionTypeOneChoiceOfList(ApiTester $I, \Codeception\Example $example)
    {
        $I->sendPUT($example['url'],$example['data']);
        $I->seeResponseContainsJson($example['contains']);
        $I->seeResponseCodeIs($example['code']);
    }

    /**
     * @return array
    */
    protected function dataProviderForQuestionTypeOneChoiceOfList() 
    {
        // One choise of list -> 2
        return [
            [
                'url'=>'assessments/1',
                'code'=>400,
                'data'=>[
                    "answers"=>[
                        "q-3"=>[1,2,3],
                    ],
                ],
                'contains'=>[
                    'errors'=>['message'=>'Bad Request'], // bad request because question q-3 not allowed array type
                ],
            ],
            [
                'url'=>'assessments/1',
                'code'=>400,
                'data'=>[
                    "answers"=>[
                        "q-3"=>3,
                    ],
                ],
                'contains'=>[
                    'errors'=>['message'=>'Bad Request'], // bad request because question q-3 not have answer id 3
                ],
            ],
            [
                'url'=>'assessments/1',
                'code'=>200,
                'data'=>[
                    "answers"=>[
                        "q-3"=>6,
                    ],
                ],
                'contains'=>[
                    'success'=>true
                ],
            ],

        ];
    }

    /**
      * @dataProvider dataProviderForQuestionTypeDropdown
    */
    public function testAnswerForQuestionTypeDropdown(ApiTester $I, \Codeception\Example $example)
    {
        $I->sendPUT($example['url'],$example['data']);
        $I->seeResponseContainsJson($example['contains']);
        $I->seeResponseCodeIs($example['code']);
    }

    /**
     * @return array
    */
    protected function dataProviderForQuestionTypeDropdown() 
    {
        // Dropdown -> 3
        return [
            [
                'url'=>'assessments/1',
                'code'=>400,
                'data'=>[
                    "answers"=>[
                        "q-4"=>[1,2,3],
                    ],
                ],
                'contains'=>[
                    'errors'=>['message'=>'Bad Request'], // bad request because question q-4 not allowed array type
                ],
            ],
            [
                'url'=>'assessments/1',
                'code'=>400,
                'data'=>[
                    "answers"=>[
                        "q-4"=>3,
                    ],
                ],
                'contains'=>[
                    'errors'=>['message'=>'Bad Request'], // bad request because question q-4 not have answer id 3
                ],
            ],
            [
                'url'=>'assessments/1',
                'code'=>200,
                'data'=>[
                    "answers"=>[
                        "q-4"=>9,
                    ],
                ],
                'contains'=>[
                    'success'=>true
                ],
            ],

        ];
    }


    /**
      * @dataProvider dataProviderForQuestionTypeRanking
    */
    public function testAnswerForQuestionTypeRanking(ApiTester $I, \Codeception\Example $example)
    {
        $I->sendPUT($example['url'],$example['data']);
        $I->seeResponseContainsJson($example['contains']);
        $I->seeResponseCodeIs($example['code']);
    }

    /**
     * @return array
    */
    protected function dataProviderForQuestionTypeRanking() 
    {
        // Ranking -> 4
        return [
            [
                'url'=>'assessments/1',
                'code'=>400,
                'data'=>[
                    "answers"=>[
                        "q-5"=>1,
                    ],
                ],
                'contains'=>[
                    'errors'=>['message'=>'Bad Request'], // bad request because question q-5 allowed array type
                ],
            ],
            [
                'url'=>'assessments/1',
                'code'=>400,
                'data'=>[
                    "answers"=>[
                        "q-5"=>[4,5,6],
                    ],
                ],
                'contains'=>[
                    'errors'=>['message'=>'Bad Request'], // bad request because this question not have answers ids sent
                ],
            ],
            [
                'url'=>'assessments/1',
                'code'=>400,
                'data'=>[
                    "answers"=>[
                        "q-5"=>[
                            9=>[
                                'rate'=>1
                            ],
                            10=>[
                                'rate'=>1
                            ],
                            11=>[
                                'rate'=>1
                            ],
                            12=>[
                                'rat'=>1
                            ],
                        ],
                    ],
                ],
                'contains'=>[
                    'errors'=>['message'=>'Bad Request'], // bad request because key {rat} not allowed
                ],
            ],
            [
                'url'=>'assessments/1',
                'code'=>200,
                'data'=>[
                    "answers"=>[
                        "q-5"=>[
                            9=>[
                                'rate'=>1
                            ],
                            10=>[
                                'rate'=>1
                            ],
                            11=>[
                                'rate'=>1
                            ],
                            12=>[
                                'rate'=>1
                            ],
                        ],
                    ],
                ],
                'contains'=>[
                    'success'=>true
                ],
            ],
        ];
    }

    /**
      * @dataProvider dataProviderForQuestionTypeRating
    */
    public function testAnswerForQuestionTypeRating(ApiTester $I, \Codeception\Example $example)
    {
        $I->sendPUT($example['url'],$example['data']);
        $I->seeResponseContainsJson($example['contains']);
        $I->seeResponseCodeIs($example['code']);
    }

    /**
     * @return array
    */
    protected function dataProviderForQuestionTypeRating() 
    {
        // Rating -> 5
        return [
            [
                'url'=>'assessments/1',
                'code'=>400,
                'data'=>[
                    "answers"=>[
                        "q-6"=>[1,2,3],
                    ],
                ],
                'contains'=>[
                    'errors'=>['message'=>'Bad Request'], // bad request because question q-6 not allowed array type
                ],
            ],
            [
                'url'=>'assessments/1',
                'code'=>400,
                'data'=>[
                    "answers"=>[
                        "q-6"=> -10,
                    ],
                ],
                'contains'=>[
                    'errors'=>['message'=>'Bad Request'], // bad request because question has range answer between 0-100
                ],
            ],
            [
                'url'=>'assessments/1',
                'code'=>400,
                'data'=>[
                    "answers"=>[
                        "q-6"=>101,
                    ],
                ],
                'contains'=>[
                    'errors'=>['message'=>'Bad Request'], // bad request because question has range answer between 0-100
                ],
            ],
            [
                'url'=>'assessments/1',
                'code'=>200,
                'data'=>[
                    "answers"=>[
                        "q-6"=>50,
                    ],
                ],
                'contains'=>[
                    'success'=>true
                ],
            ],

        ];
    }


    /**
      * @dataProvider dataProviderForQuestionTypeCommentBox
    */
    public function testAnswerForQuestionTypeCommentBox(ApiTester $I, \Codeception\Example $example)
    {
        $I->sendPUT($example['url'],$example['data']);
        $I->seeResponseContainsJson($example['contains']);
        $I->seeResponseCodeIs($example['code']);
    }
    /**
     * @return array
    */
    protected function dataProviderForQuestionTypeCommentBox() 
    {
        // Comment box id -> 8
        return [
            [
                'url'=>'assessments/1',
                'code'=>403,
                'data'=>[
                    "answers"=>[
                        "q-7"=>"تعليق مع صورة",
                        "f-7"=>true,
                        "a-7"=>[
                            [
                                "name"=>"64682197_2320155574731095_6761853737519546368_n.png",
                                "type"=>"image/png",
                                "content"=>"http://storage.selfassest.localhost/source/answers/64682197_2320155574731095_6761853737519546368_n.png"
                            ],
                        ],
                    ],
                ],
                'contains'=>[
                    'errors'=>['message'=>'Forbidden'], // forbidden because this question not allowed attach file
                ],
            ],
            [
                'url'=>'assessments/1',
                'code'=>400,
                'data'=>[
                    "answers"=>[
                        "q-7"=>[1,2,3],
                    ],
                ],
                'contains'=>[
                    'errors'=>['message'=>'Bad Request'], // bad request because this question not allowe array answers
                ],
            ],
            [
                'url'=>'assessments/1',
                'code'=>200,
                'data'=>[
                    "answers"=>[
                        "q-7"=>"Text Box",
                    ],
                ],
                'contains'=>[
                    'success'=>true
                ],
            ],
        ];
    }

    /**
      * @dataProvider dataProviderForQuestionTypeDate
    */
    public function testAnswerForQuestionTypeDate(ApiTester $I, \Codeception\Example $example)
    {
        $I->sendPUT($example['url'],$example['data']);
        $I->seeResponseContainsJson($example['contains']);
        $I->seeResponseCodeIs($example['code']);
    }

    /**
     * @return array
    */
    protected function dataProviderForQuestionTypeDate() 
    {
        // Date/Time -> 9
        return [
            [
                'url'=>'assessments/1',
                'code'=>400,
                'data'=>[
                    "answers"=>[
                        "q-8"=>[1,2,3],
                    ],
                ],
                'contains'=>[
                    'errors'=>['message'=>'Bad Request'], // bad request because this question not allowe array answers
                ],
            ],
            [
                'url'=>'assessments/1',
                'code'=>400,
                'data'=>[
                    "answers"=>[
                        "q-8"=>"",
                    ],
                ],
                'contains'=>[
                    'errors'=>['message'=>'Bad Request'], // bad request because this question is requried 
                ],
            ],
            [
                'url'=>'assessments/1',
                'code'=>400,
                'data'=>[
                    "answers"=>[
                        "q-8"=>"1992-10",
                    ],
                ],
                'contains'=>[
                    'errors'=>['message'=>'Bad Request'], // bad request because sent invalid date
                ],
            ],
            [
                'url'=>'assessments/1',
                'code'=>200,
                'data'=>[
                    "answers"=>[
                        "q-8"=>"2019-11-28",
                    ],
                ],
                'contains'=>[
                    'success'=>true
                ],
            ],
        ];
    }

    /**
      * @dataProvider dataProviderForQuestionTypeFile
    */
    public function testAnswerForQuestionTypeFile(ApiTester $I, \Codeception\Example $example)
    {
        $I->sendPUT($example['url'],$example['data']);
        $I->seeResponseContainsJson($example['contains']);
        $I->seeResponseCodeIs($example['code']);
    }
    
    /**
     * @return array
    */
    protected function dataProviderForQuestionTypeFile() 
    {
        // File -> 11
        return [
            [
                'url'=>'assessments/1',
                'code'=>400,
                'data'=>[
                    "answers"=>[
                        "q-9"=>"",
                    ],
                ],
                'contains'=>[
                    'errors'=>['message'=>'Bad Request'], // bad request because this question is allow array answers 
                ],
            ],
             [
                'url'=>'assessments/1',
                'code'=>400,
                'data'=>[
                    "answers"=>[
                        "q-9"=>[
                            [
                                "name"=>"64682197_2320155574731095_6761853737519546368_n.png",
                                "type"=>"image/png",
                                "content"=>"http://storage.localhost/source/answers/64682197_2320155574731095_6761853737519546368_n.png"
                            ],
                        ],
                    ],
                ],
                'contains'=>[
                    'errors'=>['message'=>'Bad Request'], // bad request because invalid content url
                ],
            ],
            [
                'url'=>'assessments/1',
                'code'=>200,
                'data'=>[
                    "answers"=>[
                        "q-9"=>[
                            [
                                "name"=>"64682197_2320155574731095_6761853737519546368_n.png",
                                "type"=>"image/png",
                                "content"=>"http://storage.selfassest.localhost/source/answers/64682197_2320155574731095_6761853737519546368_n.png"
                            ],
                        ],
                    ],
                ],
                'contains'=>[
                    'success'=>true
                ],
            ],
        ];
    }
}
