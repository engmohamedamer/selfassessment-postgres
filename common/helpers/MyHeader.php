<?php
namespace common\helpers;
use Authy\AuthyApi;
use Authy\AuthyResponse;
use hyperia\security\Headers;
use yii\base\Application;

class MyHeader extends Headers
{
    public function bootstrap($app)
    {
        $app->on(Application::EVENT_BEFORE_REQUEST, function () {
            if (is_a(\Yii::$app, 'yii\web\Application')) {
                $headers = \Yii::$app->response->headers;

                $headers->set('X-Powered-By', $this->xPoweredBy);

                if (!empty($this->xFrameOptions)) {
                    $headers->set('X-Frame-Options', $this->xFrameOptions);
                }

//                $content_security_policy = $this->getContentSecurityPolicyDirectives();
//                if (!empty($content_security_policy)) {
//                    $headers->set('Content-Security-Policy', $content_security_policy);
//                }
//
//                if (!empty($this->stsMaxAge)) {
//                    $headers->set('Strict-Transport-Security', 'max-age=' . $this->stsMaxAge . ';');
//                }
//
//                if ($this->contentTypeOptions) {
//                    $headers->set('X-Content-Type-Options', 'nosniff');
//                }
//
                if ($this->xssProtection) {
                    $headers->set('X-XSS-Protection', '1; mode=block;' . $this->getXssProtectionReportPart());
                }

//                if (!empty($this->publicKeyPins)) {
//                    $headers->set('Public-Key-Pins', $this->publicKeyPins);
//                }
            }
        });
    }


    /**
     * Get report part for X-XSS-Protection header
     *
     * @access private
     * @return string
     */
    private function getXssProtectionReportPart()
    {
        $report = '';
        if (!empty($this->reportUri)) {
            $report = ' report=' . $this->reportUri . '/';
        }

        return $report;
    }

}
