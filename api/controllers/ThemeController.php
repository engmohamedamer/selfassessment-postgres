<?php

namespace api\controllers;

use Yii;
use api\helpers\ResponseHelper;
use common\models\Organization;
use common\models\User;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ThemeController extends RestController
{

    public function  behaviors()
    {
        $behaviors = parent::behaviors();
        // remove authentication filter if there is one
        unset($behaviors['authenticator']);

        if (isset($this->apache_request_headers()['Authorization'])) {
            $behaviors['authenticator'] = [
                'class' => CompositeAuth::class,
                'authMethods' => [
                    HttpBearerAuth::class,
                ]
            ];
            $behaviors['authenticator']['except'] = ['options'];
        }
        return $behaviors;
    }

    public function actionIndex(){

        $params = \Yii::$app->request->get();
        $organization = Organization::findOne(['slug'=>$params['org']]);

        if (!$organization) {
            return ResponseHelper::sendFailedResponse(['ORGANIZATION_NOT_FOUND'=>'Organization not found'],404);
        }

        if (empty($params['lang'])) {
            if ($organization->organizationTheme->locale == 'ar-AR') {
                $locale = 'ar';
            }else{
                $locale = 'en';
            }
        }else{
            $locale = $params['lang'];
        }

        if (\Yii::$app->user->identity) {
            if (\Yii::$app->user->identity->userProfile->locale == 'ar-AR') {
                $locale = 'ar';
            }else{
                $locale = 'en';
            }
        }


        $theme = $organization->organizationTheme;


        if (!\Yii::$app->user->identity and is_null($locale)) {
            if ($theme->locale == 'ar-AR') {
                $locale = 'ar';
            }else{
                $locale = 'en';
            }
        }

        \Yii::$app->language = $locale;

        $organization = Organization::findOne(['slug'=>$params['org']]);
        // $organization = Organization::find()->limit(1)->one();
        $footerLinks = $organization->organizationFooterLinks;


        $colors =[
            'brandPrimColor'=> $theme->brandPrimColor,
            'brandSecColor'=> $theme->brandSecColor,
            'brandHTextColor'=>  $theme->brandHTextColor,
            'brandPTextColor'=> $theme->brandPTextColor,
            'brandBlackColor'=> $theme->brandBlackColor,
            'brandGrayColor'=> $theme->brandGrayColor,
            'arfont'=> $theme->arfont,
            'enfont'=> $theme->enfont,
        ];

       $footer = [
           'links'=>[
               ['title'=>$footerLinks->name_link1,'href'=>$footerLinks->link1],
               ['title'=>$footerLinks->name_link2,'href'=>$footerLinks->link2],
               ['title'=>$footerLinks->name_link3,'href'=>$footerLinks->link3],
               ['title'=>$footerLinks->name_link4,'href'=>$footerLinks->link4],
               ['title'=>$footerLinks->name_link5,'href'=>$footerLinks->link5],
           ],
           'social_media'=>[
               ['title'=>'facebook','href'=>$theme->facebook],
               ['title'=>'twitter','href'=>$theme->twitter],
               ['title'=>'linkedin','href'=>$theme->linkedin],
               ['title'=>'instagram','href'=>$theme->instagram],
           ]
       ];

       if ($_SERVER['SERVER_NAME'] == 'sahlit.com'){
            $redirectUri = 'http://sahlit.com/auth?slug='. $organization->slug;
        }else{
            $redirectUri = 'http://tamkeentechlab.com/auth?slug='. $organization->slug;
        }

        $organizationDate = ['id'=> $organization->id,'name'=> $organization->name,'address'=> $organization->address ,'about'=> $organization->about, 'logo'=> $organization->first_image_base_url . $organization->first_image_path, 'logo_icon'=>$organization->second_image_base_url . $organization->second_image_path,'locale'=> $locale,'allow_registration'=> (bool) $organization->allow_registration,'sso_login'=> (bool)$organization->sso_login,'link_sso_login'=> $redirectUri ];

        return ['theme_version'=> strtotime($theme->updated_at),'organization'=>$organizationDate,'colors'=>$colors,'footer'=>$footer];
    }


  public function apache_request_headers() {
        $arh = array();
        $rx_http = '/\AHTTP_/';
        foreach($_SERVER as $key => $val) {
            if( preg_match($rx_http, $key) ) {
                $arh_key = preg_replace($rx_http, '', $key);
                $rx_matches = array();
                // do some nasty string manipulations to restore the original letter case
                // this should work in most cases
                $rx_matches = explode('_', $arh_key);
                if( count($rx_matches) > 0 and strlen($arh_key) > 2 ) {
                    foreach($rx_matches as $ak_key => $ak_val) $rx_matches[$ak_key] = ucfirst($ak_val);
                    $arh_key = implode('-', $rx_matches);
                }
                $arh[$arh_key] = $val;
            }
        }
        return( $arh );
    }

}
