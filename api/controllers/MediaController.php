<?php 
namespace api\controllers;
use api\helpers\ImageHelper;
use api\helpers\ResponseHelper;
use backend\modules\assessment\models\SurveyQuestion;
use common\models\Media;
use common\models\SurveyUserAnswerAttachments;

class MediaController extends  MyActiveController
{
    public $modelClass = SurveyUserAnswerAttachments::class;

    public function actions(){
        $actions = parent::actions();
        unset($actions['create']);
        unset($actions['delete']);
        return $actions;
    }
	

    public function actionCreate()
	{
        $params = \Yii::$app->request->post();
        $files= $params['files'];
        $questionId= $params['question_id'];
        $question = SurveyQuestion::findOne(['survey_question_id'=>$questionId]);

        if(!$question) return ResponseHelper::sendFailedResponse(['data'=>"Wrong Question"],'400');

        foreach ($_FILES["files"]["error"] as $key => $error) {
		    if ($error == UPLOAD_ERR_OK) {
		        $tmp_name = $_FILES["files"]["tmp_name"][$key];
		        $name = basename($_FILES["files"]["name"][$key]);
                $uploaddir = \Yii::getAlias('@storage'). '/web/source/answers';
		        move_uploaded_file($tmp_name, $uploaddir.'/'.$name);

		        $fileObj= new SurveyUserAnswerAttachments();
                $fileObj->survey_user_answer_attachments_user_id = \Yii::$app->user->identity->getId();
                $fileObj->survey_user_answer_attachments_survey_id = $question->survey_question_survey_id ;
                $fileObj->survey_user_answer_attachments_question_id = $question->survey_question_id ;
                $fileObj->path = 'answers/'.$name;
                $fileObj->base_url= \Yii::getAlias('@storageUrl'). '/source/';
                $fileObj->name = $name;
                $fileObj->save();
		    }
		}

        return var_dump($params);
	}

    public function actionUpload()
    {
        $links = [];
        $user = \Yii::$app->user->identity->userProfile;
        $user_id = $user->user_id;
        $org_id = $user->organization_id;


        $allowed_mime_types = array(
            'image/jpeg',
            'image/jpg',
            'image/png',
            'application/pdf',
            'application/doc',
            'text/csv',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'text/plain'
        );

        foreach ($_FILES as $key => $file) {
            if (in_array($_FILES[$key]["type"], $allowed_mime_types) and $_FILES[$key]["size"] <= 10485760) {
                $tmp_name = $_FILES[$key]["tmp_name"];
                $name = 'File-'.time().basename($_FILES[$key]["name"]);
                $uploaddir = \Yii::getAlias('@storage'). "/web/source/answers/$org_id/$user_id";
                if (!file_exists($uploaddir)) {
                    mkdir($uploaddir, 0777, true);
                }
                move_uploaded_file($tmp_name, $uploaddir.'/'.$name);
                $media = new Media();
                $media->path = "answers/$org_id/$user_id/$name";
                $media->base_url = \Yii::getAlias('@storageUrl'). '/source/';
                $media->type = $_FILES[$key]["type"];
                $media->created_at = time();
                $media->user_id = $user_id;
                $media->save(false);
                $links[] =  [basename($_FILES[$key]["name"])=>['id'=>$media->id,'name'=>$name,'link'=>\Yii::getAlias('@storageUrl'). "/source/answers/$org_id/$user_id/$name"]];
            }else{
                return ResponseHelper::sendFailedResponse(['message'=>"File Not Allowed"],400);
            }

        }
        return ResponseHelper::sendSuccessResponse($links,200);
    }

    public function actionDelete($id)
    {
        $user_id = \Yii::$app->user->identity->userProfile->user_id;
        $media = Media::find()->where(['id'=>$id,'user_id'=>$user_id])->one();
        if ($media) {
           unlink(\Yii::getAlias('@storage'). '/web/source/'.$media->path);
           $media->delete(false);
            return ResponseHelper::sendSuccessResponse(['message'=>"File Delete Successfully"]);
        }else{
            return ResponseHelper::sendFailedResponse(['message'=>"File Not Found"],400);
        }
    }

}



