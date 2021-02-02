<style>
    /* .sectionClass {
        position: relative;
        display: block;
    }
    #projectFacts .fullWidth {
        padding: 0;
    }
    .fullWidth {
        width: 100% !important;
        display: table;
        float: none;
        padding: 0;
        min-height: 1px;
        height: 100%;
        position: relative;
    }
    .projectFactsWrap {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: horizontal;
        -webkit-box-direction: normal;
        -ms-flex-direction: row;
        flex-direction: row;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
    }
    .projectFactsWrap .item {
        width: 25%;
        height: 100%;
        padding: 50px 0px;
        text-align: center;
    }
    .projectFactsWrap .item:nth-child(1) {
        background: #101f2e;
    }
    .projectFactsWrap .item:nth-child(2) {
        background: #122233;
    }
    .projectFactsWrap .item:nth-child(3) {
        background: #152638;
    }
    .projectFactsWrap .item:nth-child(4) {
        background: #172c42;
    }
    .projectFactsWrap .item i {
        vertical-align: middle;
        font-size: 50px;
        color: rgba(255, 255, 255, 0.8);
    }
    .projectFactsWrap .item p {
        color: rgba(255, 255, 255, 0.8);
        font-size: 18px;
        margin: 0;
        padding: 10px;
    }
    .projectFactsWrap .item p.number {
        font-size: 40px;
        padding: 0;
        font-weight: bold;
    }
    .projectFactsWrap .item span {
        width: 60px;
        background: rgba(255, 255, 255, 0.8);
        height: 2px;
        display: block;
        margin: 0 auto;
    }
 */











    .v-progress-circular {
      margin: 1rem;
    }

    .survey-preloader {
      position: absolute;
      top: 0;
      right:0;
      width: 100%;
      height: 100%;
      z-index: 99999;
      padding: 30%;
      background: white;
    }




    .sectionClass {
    padding: 20px 0px 50px 0px;
    position: relative;
    display: block;
    }

    .fullWidth {
    width: 100% !important;
    display: table;
    float: none;
    padding: 0;
    min-height: 1px;
    height: 100%;
    position: relative;
    }


    .sectiontitle {
    margin: 30px 0 0px;
    min-height: 20px;
    }

    .report-title {
        background: white;
    }

    .report-details {
        border:2px dashed #ddd;
    }
    .sectiontitle h2 {
    font-size: 30px;
    color: #222;
    margin-top: 0px;
    }

    .sectiontitle .thirdBtn{
        background: var(--brandPrimColor) !important;
        color: #fff;
        float: left;
        span{
            color: #fff;
        }
    }


    .headerLine {
    width: 160px;
    height: 2px;
    display: inline-block;
    background: #101F2E;
    }


    .projectFactsWrap{
        display: flex;
    margin-top: 30px;
    flex-direction: row;
    flex-wrap: wrap;
    }


    #projectFacts .fullWidth{
    padding: 0;
    }

    .projectFactsWrap .item{
    width: 33.3%;
    height: 100%;
    padding: 50px 0px;
    text-align: center;
        .v-btn{
            height: 24px;
        }
        .v-btn__content{
            background: transparent;
            height: auto;
            color: #fff;
        }
        
    }

    .projectFactsWrap .item:nth-child(1){
    background: rgb(16, 31, 46);
    }

    .projectFactsWrap .item:nth-child(2){
    background: rgb(18, 34, 51);
    }

    .projectFactsWrap .item:nth-child(3){
    background: rgb(21, 38, 56);
    }

    .projectFactsWrap .item:nth-child(4){
    background: rgb(23, 44, 66);
    }

    .projectFactsWrap .item p.number{
    font-size: 40px;
    padding: 0;
    font-weight: bold;
    }

    .projectFactsWrap .item p{
    color: rgba(255, 255, 255, 0.8);
    font-size: 18px;
    margin: 0;
    padding: 10px;
    // font-family: 'Open Sans';
    }


    .projectFactsWrap .item span{
    width: 60px;
    background: rgba(255, 255, 255, 0.8);
    height: 2px;
    display: block;
    margin: 0 auto;
    }


    .projectFactsWrap .item i{
    vertical-align: middle;
    font-size: 50px;
    color: rgba(255, 255, 255, 0.8);
    }


    .projectFactsWrap .item:hover i, .projectFactsWrap .item:hover p{
    color: white;
    }

    .projectFactsWrap .item:hover span{
    background: white;
    }
    .projectFactsWrap .item:hover span.v-btn__content{
    background: transparent;
    }

    @media (max-width: 786px){
    .projectFactsWrap .item {
        flex: 0 0 50%;
    }
    }

    .v-data-table__mobile-row__cell {
        padding-right: 35px;
        text-align: center;

    }

    tbody tr td.v-data-table__mobile-row:nth-child(odd) {
        background: rgba(238, 238, 238, 0.4) !important;

    }
    
    
    .v-data-table__mobile-row {
        height: auto !important;
        padding: 10px !important;
    }



    .report-details {
        text-align: center;
        .display-1 {
            background: var(--brandPrimColor);
            color: white;
            border-radius: 20px 0;
            display: inline-block;
            padding: 10px 5%;
        }
    }


    #my-report {
        // background: aliceblue;
        padding: 0 20px;
        border: 2px dashed var(--brandPrimColor);
        border-radius: 15px;
    }

    body.receipt .sheet { width: 58mm; height: 1000mm } /* change height as you like */
    @media print { body.receipt { width: 58mm } } /* this line is needed for fixing Chrome's bug */



  

  .tablepop table thead tr th{
    background: #152638 !important;
    color: #fff !important;
  }
  .tablepop table tr td p{
      margin: 0 !important
  }
  .tablepop table tr td{
      padding: 10px;
  }

  .green {
      background: green !important;
  }

  .red {
      background: red !important;
  }

  .orange {
      background: orange !important;
  }

  .#cebe32 {
      background: #cebe32 !important;
  }
</style> 

<div id="assessmentReport" data-SurveyId="<?= $survey->survey_id ?>"  data-UserId="<?= $user_id; ?>" data-tocken="<?= Yii::$app->user->getIdentity()->access_token ;?>" ></div>

