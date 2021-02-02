<?php
use api\helpers\ResetPassword;
use yii\helpers\Html;

$organization = $user->userProfile->organization;
$logo     = $organization->first_image_base_url . $organization->first_image_path;
$siteLink = ResetPassword::siteLink($user);
$reportLink = $siteLink."/report/$token";
$path = \Yii::getAlias('@apiUrl');
;
?>
<!-- start coded_template: id:5555860215 path:C/ustom/email/onboarding_template/content_onboarding_updated_nocta_noheader.html -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>تقرير اجابات المشارك</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width">
  <style type="text/css">
    @import url(https://fonts.googleapis.com/css?family=Cairo|Cairo);
    /* /\/\/\/\/\/\/\/\/ CLIENT-SPECIFIC STYLES /\/\/\/\/\/\/\/\/ */

    body {
        direction: rtl;
    }

    #outlook a {
      padding: 0;
    }

    /* Force Outlook to provide a "view in browser" message */

    .ReadMsgBody {
      width: 100%;
    }

    .ExternalClass {
      width: 100%;
    }

    /* Force HM to display emails at full width */

    .ExternalClass,
    .ExternalClass p,
    .ExternalClass span,
    .ExternalClass font,
    .ExternalClass td,
    .ExternalClass div {
      line-height: 100%;
    }

    /* Force HM to display normal line spacing */

    body,
    table,
    td,
    p,
    a,
    li,
    blockquote {
      -webkit-text-size-adjust: 100%;
      -ms-text-size-adjust: 100%;
    }

    /* Prevent WebKit and Windows mobile changing default text sizes */

    table,
    td {
      mso-table-lspace: 0pt;
      mso-table-rspace: 0pt;
    }

    /* Remove spacing between tables in Outlook 2007 and up */

    img {
      -ms-interpolation-mode: bicubic;
    }

    /* Allow smoother rendering of resized image in Internet Explorer */

    /* /\/\/\/\/\/\/\/\/ RESET STYLES /\/\/\/\/\/\/\/\/ */

    body {
      margin: 0;
      padding: 0;
    }

    img {
      border: 0;
      height: auto;
      line-height: 100%;
      outline: none;
      text-decoration: none;
    }

    body,
    #bodyTable,
    #bodyCell {
      height: 100% !important;
      margin: 0;
      padding: 0;
      width: 100% !important;
    }

    table {
      border-collapse: collapse;
    }

    img {
      display: block;
    }

    .appleLinks a {
      color: #8A959E !important;
      text-decoration: none;
    }

    span.preheader {
      display: none !important;
    }
  </style>

  <style type="text/css" id="hs-inline-css">
    .preheader,
    span[summary="preheader"] {
      display: none !important;
      Margin-left: -9999 !important;
      width: 0 !important;
      height: 0 !important;
      visibility: hidden !important;
      min-width: 0 !important;
      min-height: 0 !important;
      font-size: 0 !important;
      line-height: 0 !important;
    }

    .outer-table {
      width: 100%;
      max-width: 640px;
    }

    .inner-table {
      width: 93.75%;
      max-width: 600px;
    }

    .main-content {
      width: 83.34%;
      max-width: 500px;
    }

    .alt-content {
      width: 73.34%;
      max-width: 440px;
    }










    body {
      font-family: 'Cairo', sans-serif;
      color: #8A959E;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
      font-family: 'Cairo', sans-serif;
      font-weight: 200;
      margin: 0 auto;
    }

    h1 {
      font-size: 40px;
      color: #1F2532;
      letter-spacing: 0;
    }

    h3 {
      font-size: 12px;
      color: #8A959E;
      letter-spacing: 1px;    }

    p,
    li {
      font-family: 'Cairo', sans-serif;
      font-weight: 300;
      margin: 0 0 1em 0;
      font-size: 18px;
      color: #8A959E;
      letter-spacing: 0;
      line-height: 38px;
    }

    p,
    ul,
    li,
    ol {
      text-align: left;
    }

    strong {
      font-weight: 500;
    }

    .main-content a {
      color: #FF3366 !important;
    }

    .main-content a:hover {
      color: #153DD1 !important;
    }

    .view-in-browser {
      font-size: 11px;
      color: #8A959E;
      letter-spacing: 0;
      border-bottom: 1px solid #B9C0C4;
      text-decoration: none;
    }

    .offer-table {
      background: url(https://ams3.digitaloceanspaces.com/collegify-storage-server/images/logo.svg) #464D5D center center / 640px 500px no-repeat !important;
      box-shadow: 0px 20px 40px -10px rgba(0, 0, 0, 0.15) !important;
      -webkit-box-shadow: 0px 20px 40px -10px rgba(0, 0, 0, 0.15) !important;
    }


    img+div {
      display: none;
    }
  </style>

  <style type="text/css" id="no-inline-css">
    @media screen and (max-width:9999px) {
        .main-cta:hover,
      * [summary="main-cta"]:hover {
        background-color: #153DD1 !important;
        box-shadow: 0px 20px 40px -10px rgba(0, 0, 0, 0.2) !important;
        -webkit-box-shadow: 0px 20px 40px -10px rgba(0, 0, 0, 0.2) !important;
      }
      .twitter:hover img,
      * [summary="twitter"]:hover img {
        background-color: #153DD1 !important;
        box-shadow: 0px 20px 40px -10px rgba(0, 0, 0, 0.2) !important;
        -webkit-box-shadow: 0px 20px 40px -10px rgba(0, 0, 0, 0.2) !important;
      }
      .facebook:hover img,
      * [summary="facebook"]:hover img {
        background-color: #153DD1 !important;
        box-shadow: 0px 20px 40px -10px rgba(0, 0, 0, 0.2) !important;
        -webkit-box-shadow: 0px 20px 40px -10px rgba(0, 0, 0, 0.2) !important;
      }
      .linkedin:hover img,
      * [summary="linkedin"]:hover img {
        background-color: #153DD1 !important;
        box-shadow: 0px 20px 40px -10px rgba(0, 0, 0, 0.2) !important;
        -webkit-box-shadow: 0px 20px 40px -10px rgba(0, 0, 0, 0.2) !important;
      }



    }

    @media only screen and (max-width: 599px) {}

    @media only screen and (max-width: 480px) {
      /* /\/\/\/\/\/\/ CLIENT-SPECIFIC MOBILE STYLES /\/\/\/\/\/\/ */
      body,
      table,
      td,
      p,
      a,
      li,
      blockquote {
        -webkit-text-size-adjust: none !important;
      }
      /* Prevent Webkit platforms from changing default text sizes */
      body {
        width: 100% !important;
        min-width: 100% !important;
      }
      /* Prevent iOS Mail from adding padding to the body */
      .main-content,
      .author-content {
        width: 85% !important;
      }
    }
  </style>

  <meta name="generator" content="HubSpot">
  <meta property="og:url" content="<?= $siteLink ?>">
  <meta name="x-apple-disable-message-reformatting">
</head>
<!--[if !((gte mso 9)|(IE))]><!-->

<body bgcolor="#eaeced" style="font-family:'Cairo', sans-serif; color:#8a959e"><span class="preheader" summary="preheader" style="display:none !important; Margin-left:-9999 !important; width:0 !important; height:0 !important; visibility:hidden !important; min-width:0 !important; min-height:0 !important; font-size:0 !important; line-height:0 !important"
    width="0" height="0"></span>
  <!--<![endif]-->
  <table id="body" class="body" summary="body" width="100%" height="100%" align="center" border="0" cellspacing="0" cellpadding="0" style="background-color:#eaeced;">
    <tbody>
      <tr>
        <td align="center" valign="top">

          <!-- START LIQUID WRAPPER -->
          <!--[if mso]>
        <table cellpadding="0" cellspacing="0" border="0" style="padding:0px;margin:0px;width:100%;">
            <tr>
                <td style="padding:0px;margin:0px;">&nbsp;</td>
                <td style="padding:0px;margin:0px;" width="640">
        <![endif]-->

          <table class="outer-table" summary="outer-table" align="center" valign="top" border="0" cellpadding="0" cellspacing="0" style="width:100%; max-width:640px; Margin:0 auto" width="100%">

            <tbody>
                <tr><img src="<?= $path.'/img/tamkeen-logo.png'?>" style="width: 100px; margin:10px auto;" alt=""></tr>
                <tr>مؤسسة تمكين للتقنيات</tr>
              <tr>
                <td>
                  <table class="inner-table" summary="inner-table" align="center" valign="top" border="0" cellpadding="0" cellspacing="0" style="width:93.75%; max-width:600px; Margin:0 auto; height:120px" height="120" width="93.75%">
                    <tbody>
                      <tr height="25">
                        <td style="font-size:0; line-height:0;">&nbsp;</td>
                      </tr>
                      <!-- <tr>
                        <td align="right" valign="middle"><a class="view-in-browser" href="" style="font-size:11px; color:#8a959e; letter-spacing:0; border-bottom:1px solid #b9c0c4; text-decoration:none" data-hs-link-id="0" target="_blank">View in browser</a></td>
                      </tr> -->
                      
                      <tr height="8" style="font-size: 0; line-height: 0;"><td>&nbsp;</td></tr>
				<tr><td align="center" valign="top"><table class="master-table" width="600">
				
<tbody><tr><td align="center">
    <table class="responsive-table" width="570" border="0" cellpadding="0" cellspacing="0" valign="top">
    	<tbody><tr>
            
    		<td width="70"><a href="<?= $siteLink ?>" data-hs-link-id="0"><img src="<?= $path.'/img/2.png'?>" width="50.0" height="47.0" alt="Tamkeen" style="border:0;"></a></td>
            
            
    		<td class="responsive-header-cell-big" style="font-family:'Cairo', arial, sans-serif !important;font-size:25px;line-height:30px !important;font-weight:200 !important;color:#252b33 !important;">تقرير اجابات المشارك</td>
            
            
    		<td class="responsive-header-cell" style="font-family:'Cairo', arial, sans-serif !important;font-size:13px !important;line-height:30px !important;font-weight:400 !important;color:#7e8890 !important;text-transform:uppercase !important;" align="right"> <?= $survey->survey_name ?> 
    			"<?= $survey->survey_id .'/'. date('Y',strtotime($survey->survey_created_at)) ?>"
    		</td>
            
        </tr>
    </tbody></table>
</td></tr>

<!-- <tr>
        <td width="100"><a href="<?= $siteLink ?>" data-hs-link-id="0"><img src="2.png" width="50.0" height="47.0" alt="Tamkeen" style="border:0;"></a></td>

</tr>

<tr>
        <td class="responsive-header-cell" style="font-family:'Cairo', arial, sans-serif !important;font-size:13px !important;line-height:30px !important;font-weight:400 !important;color:#7e8890 !important;text-transform:uppercase !important;" align="center"> استبيان وزارة العدل "123/2019"</td>

</tr> -->

                

    
    <tr height="40"><td>&nbsp;</td></tr>
    <tr>
    	<td align="center" valign="top">
            <table class="responsive-table" width="580" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" valign="top" style="overflow:hidden !important;border-radius:3px;">
                <tbody><tr><td><a href="<?= $siteLink ?>" data-hs-link-id="0"><img src="<?= $path.'/img/customer-survey.jpeg'?>" class="hero-image" width="580" style="border: 0; max-width: 100% !important;" srcset="customer-survey.jpeg" sizes="(max-width: 580px) 100vw, 580px"></a></td></tr>
                <tr height="46"><td>&nbsp;</td></tr>
                
                <tr><td align="center">
                    <table width="85%">
                        <tbody>
                            <tr>
                                <td width="100"><a href="<?= $siteLink ?>" data-hs-link-id="0"><img src="<?= $path.'/img/avatar.jpg'?>" width="100" height="100" alt="Tamkeen" style="border:0; margin: auto; border-radius: 100px;"></a></td>
                            </tr>
                            <tr><td align="center"><h2 style="margin: 0 !important; font-family:'Cairo', sans-serif !important;font-size:28px !important;line-height:38px !important;font-weight:200 !important;color:#252b33 !important;"><?= $user->userProfile->firstname .' ' . $user->userProfile->lastname ?></h2></td></tr>
                        
                    </tbody></table>
                </td></tr>
                <tr height="25"><td>&nbsp;</td></tr>
                
                
                <tr>
                    <td align="center">
                        <table class="story-4" border="0" cellpadding="0" cellspacing="0" width="78%">
                            <tbody><tr>
                                <td align="center" style="font-family:'Cairo', sans-serif !important;font-size:16px !important;line-height:30px !important;font-weight:400 !important;color:#7e8890 !important;"> تم الإجابة على الاستبيان بنجاح <br> يمكنك تحميل تقرير بإجابات الإستبيان والنقاط التي حصل عليها والإجراءات التصحيحية من هنا</td>
                              
                          
                            </tr>
                        </tbody></table>
                      
                         
                    </td>
                </tr>
                <tr height="36"><td>&nbsp;</td></tr>
                
                
                <tr><td align="center" valign="top">
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr><td align="center" valign="top">
                                <!--[if mso]>
                                    <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="http://blog.invisionapp.com/inside-design-google-ventures/" style="height:46px;v-text-anchor:middle;width:240px;" arcsize="3%" strokecolor="#ff2b63" fillcolor="#ff2b63">
                                        <w:anchorlock/>
                                        <center style="color:#ffffff;font-family:Helvetica, Arial,sans-serif;font-size:13px;text-transform: uppercase;">NOTHING VENTURED, NOTHING GAINED</center>
                                    </v:roundrect>
                                <![endif]-->
                                 <a class="main-cta" summary="main-cta" href="<?= $reportLink ?>"
                                                style="background-color:#153DD1; padding:14px 68px 14px 68px; border-radius:35px; color:#ffffff !important; display:inline-block; font-family:'Cairo', sans-serif; font-weight:500; font-size:16px; color:#FFFFFF; letter-spacing:1px; line-height:22px !important; text-align:center; text-decoration:none; -webkit-text-size-adjust:none"
                                                bgcolor="#153DD1" align="center" data-hs-link-id="1" target="_blank">تحميل التقرير</a>
                                            
                            </td></tr>
                        </tbody>
                    </table>
                </td></tr>
                
                
                <tr height="72" class="last-tr-height"><td>&nbsp;</td></tr>
            </tbody></table>
        </td>
    </tr>
    



                
                      
                      <tr height="50">
                        <td style="font-size:0; line-height:0;">&nbsp;</td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>

            

              <!--
           <tr>
               <td>
                    <table class="inner-table" summary="inner-table" align="center" bgcolor="#ffffff" valign="top" border="0" cellpadding="0" cellspacing="0" style="width:93.75%;max-width:600px;Margin:0 auto;">
                        <tbody>
                            <tr>
                                <td>
                                    <table class="main-content" summary="main-content" align="center" valign="top" border="0" cellpadding="0" cellspacing="0" style="width:83.34%;max-width:500px;Margin:0 auto;">
                                        <tbody>
                                            
                                                <tr><td align="center"><h3>Subheader</h3></td></tr>
                                                <tr height="20"><td>&nbsp;</td></tr>
                                            
                                                <tr><td align="center"><h1>Still thinking about that  plan? Get it now for 20% off!</h1></td></tr>
                                            
                                                <tr height="50"><td>&nbsp;</td></tr>
                                                <tr><td align="center">
                                                    
                                                        <img src="http://get.invisionapp.com/hubfs/email/common/pink-hr.png?noresize&width=60&height=1" height="1" width="60" />
                                                    
                                                </td></tr>
                                            
                                            
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
               </td>
           </tr>
           -->

              
              <!--<tr>
                   <td>
                        <table class="inner-table" summary="inner-table" align="center" bgcolor="#ffffff" valign="top" border="0" cellpadding="0" cellspacing="0" style="width:93.75%;max-width:600px;Margin:0 auto;">
                            <tbody>
                                <tr>
                                    <td>
                                        <table class="main-content" summary="main-content" align="center" valign="top" border="0" cellpadding="0" cellspacing="0" style="width:83.34%;max-width:500px;Margin:0 auto;">
                                            <tbody>
                                                <tr height="30"><td>&nbsp;</td></tr>
                                                <tr>
                                                    <td align="center">
                                                        
                                                        
                                                        
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                   </td>
               </tr>-->

                      <!-- <tr>
                        <td align="center"><span style="font-family: 'Cairo', sans-serif; font-weight: 300; font-size: 11px;color: #8A959E;letter-spacing: 1px;">مؤسسة تمكين للتقنيات</span>
                        </td>
                      </tr>
                      <tr height="30">
                        <td style="font-size:0; line-height:0;">&nbsp;</td>
                      </tr>    -->
            <!--   <tr>
                        <td>
                          <table class="social-table" summary="social-table" align="center" valign="middle"
                          border="0" cellpadding="0" cellspacing="0" style="width:240px;max-width:100%;Margin:0 auto;">
                            <tbody>
                              <tr>
                                <td width="60">
                                  <a class="twitter" summary="twitter" href="http://collegify.com"
                                  data-hs-link-id="0" target="_blank">
                                    <!~~[if (gte mso 9)|(IE)]>
                                      <img src="http://get.invisionapp.com/hubfs/email/common/btn-twitter-grey.png?noresize&width=60&height=60"
                                      width="60" height="60" />
                                    <![endif]~~>
                                    <!~~[if !((gte mso 9)|(IE))]>
                                      <!~~>
                                      <img src="http://get.invisionapp.com/hs-fs/hubfs/email/common/btn-twitter-trans@2x.png?noresize&amp;t=1508952411552&amp;width=60&amp;height=60&amp;name=btn-twitter-trans@2x.png"
                                      width="60" height="60" bgcolor="#B9C0C4" style="background-color: #B9C0C4; border-radius:30px;">
                                    <!~~<![endif]~~>
                                  </a>
                                </td>
                                <td width="30">&nbsp;</td>
                                <td width="60">
                                  <a class="facebook" summary="facebook" href="http://collegify.com"
                                  data-hs-link-id="0" target="_blank">
                                    <!~~[if (gte mso 9)|(IE)]>
                                      <img src="http://get.invisionapp.com/hubfs/email/common/btn-facebook-grey.png?noresize&width=60&height=60"
                                      width="60" height="60" />
                                    <![endif]~~>
                                    <!~~[if !((gte mso 9)|(IE))]>
                                      <!~~>
                                      <img src="http://get.invisionapp.com/hs-fs/hubfs/email/common/btn-facebook-trans@2x.png?noresize&amp;t=1508952411552&amp;width=60&amp;height=60&amp;name=btn-facebook-trans@2x.png"
                                      width="60" height="60" bgcolor="#B9C0C4" style="background-color: #B9C0C4; border-radius:30px;">
                                    <!~~<![endif]~~>
                                  </a>
                                </td>
                                <td width="30">&nbsp;</td>
                                <td width="60">
                                  <a class="linkedin" summary="linkedin" href="http://collegify.com"
                                  data-hs-link-id="0" target="_blank">
                                    <!~~[if (gte mso 9)|(IE)]>
                                      <img src="http://get.invisionapp.com/hubfs/email/common/btn-linkedin-grey.png?noresize&width=60&height=60"
                                      width="60" height="60" />
                                    <![endif]~~>
                                    <!~~[if !((gte mso 9)|(IE))]>
                                      <!~~>
                                      <img src="http://get.invisionapp.com/hs-fs/hubfs/email/common/btn-linkedin-trans@2x.png?noresize&amp;t=1508952411552&amp;width=60&amp;height=60&amp;name=btn-linkedin-trans@2x.png"
                                      width="60" height="60" bgcolor="#B9C0C4" style="background-color: #B9C0C4; border-radius:30px;">
                                    <!~~<![endif]~~>
                                  </a>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </td>
                      </tr> -->
              
           
              <tr height="60">
                <td>&nbsp;</td>
              </tr>
              <tr>
                
                        <td>
                          <table class="alt-content" summary="alt-content" align="center" valign="top" border="0" cellpadding="0" cellspacing="0" style="width:73.34%; max-width:440px; Margin:0 auto" width="73.34%">
                            <tbody>
                              <!-- <tr height="10">
                                <td style="font-size:0; line-height:0;">&nbsp;</td>
                              </tr>
                              <tr>
                                <td align="center" valign="top"><a href="http://collegify.com"
                                    data-hs-link-id="1" target="_blank">
                                                
                                                    <img src="https://image.ibb.co/iA53P9/_favicon.png" width="30" height="30" alt="InVision" style="border:0; width:30px;height:30px;">
                                                
                                            </a></td>
                              </tr>
                         <tr>
                                <td align="center" valign="top" style="font-family: 'Cairo', sans-serif; font-weight: 300; color:#1F2532;font-size:12px;letter-spacing:0;">
                                  <em></em>
                                </td>
                              </tr>

                              <tr height="30">
                                <td valign="top" align="center" style="font-family: 'Cairo', sans-serif; font-weight: 300; color:#8A959E;font-size:12px;letter-spacing:0;vertical-align: bottom;"><a class="view-in-browser" href="" style="font-size:11px; color:#8a959e; letter-spacing:0; border-bottom:1px solid #b9c0c4; text-decoration:none;" data-hs-link-id="0" target="_blank">Unsubscribe</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="view-in-browser" href="{{URL::to('https://www.collegify.com/#!/profile')}}" style="font-size:11px; color:#8a959e; letter-spacing:0; border-bottom:1px solid #b9c0c4;text-decoration:none" data-hs-link-id="0" target="_blank">Manage Preference</a></td>
                              </tr> -->

                              <tr height="30">
                                <td valign="top" align="center" style="font-family: 'Cairo', sans-serif; font-weight: 300; color:#8A959E;font-size:12px;letter-spacing:0;vertical-align: bottom;"><span class="appleLinks">جميع الحقوق محفوظة  @<?= date('Y') ?> مؤسسة تمكين للتقنيات</span></td>
                              </tr>
                              <tr height="20">
                                <td style="font-size:0; line-height:0;">&nbsp;</td>
                              </tr>

                              <tr height="50">
                                <td style="font-size:0; line-height:0;">&nbsp;</td>
                              </tr>

                            </tbody>
                          </table>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>

              <tr height="185">
                <td>&nbsp;</td>
              </tr>

            </tbody>
          </table>
          <!--[if mso]>
                </td>
                <td style="padding:0px;margin:0px;">&nbsp;</td>
            </tr>
        </table>
        <![endif]-->
          <!-- END LIQUID WRAPPER -->

        </td>
      </tr>
      <!-- start coded_template: id:4268246371 path:custom/page/macros/gmail-mobile-fix-as-TR.html -->
      <tr>
        <td>
          <div style="display:none; white-space:nowrap; font:15px courier; line-height:0;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>
        </td>
      </tr>
      <!-- end coded_template: id:4268246371 path:custom/page/macros/gmail-mobile-fix-as-TR.html -->
    </tbody>
  </table>
  <!-- end coded_template: id:5555860215 path:Custom/email/onboarding_template/content_onboarding_updated_nocta_noheader.html -->
 
</body>

</html>