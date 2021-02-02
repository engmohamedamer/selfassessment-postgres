<?php

use common\models\Organization;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = Yii::t('backend', 'Dashboard');
\backend\assets\DashboardAsset::register($this);
?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="">
        <div class="">
            <h1 class=" m-0 text-dark"><?= Yii::t('backend','Dashboard') ?></h1>
        </div>
        <div class=" actionBtns">
            <a href="/organization/create" class="btn btn-success"><i class="icofont-plus"></i><?= Yii::t('backend','New Organization') ?> </a>
            <a data-toggle="collapse" href="#filterCollapse" role="button" aria-expanded="false" aria-controls="filterCollapse" class="btn btn-info"><span><i class="fa fa-filter mr-2 ml-2"></i> <?= \Yii::t('common', 'Filter Options')?> </span></a>

        </div>

    </div>

</div>
    <div class="collapse <?php if(isset($_GET['date']) || isset($_GET['organization_id'])) echo 'in' ;?>" id="filterCollapse">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-filter fa-xs"></i> <?= \Yii::t('common', 'Dashboard Filter')?></h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <form method="GET">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?= \Yii::t('common', 'Filter by time')?></label>
                            <select class="form-control" name="date">
                                <option value=""><?= Yii::t('backend','All');  ?></option>
                                <option value="dateCurrentDay" <?php if($_GET['date'] == 'dateCurrentDay') echo "selected"; ;?> >
                                    <?= Yii::t('common','Current Day')?>
                                </option>
                                <option value="dateLastDay" <?php if($_GET['date'] == 'dateLastDay') echo "selected"; ;?>>
                                    <?= Yii::t('common','Last Day')?>
                                </option>
                                <option value="dateCurrentWeek" <?php if($_GET['date'] == 'dateCurrentWeek') echo "selected"; ;?>>
                                    <?= Yii::t('common','Current Week')?>
                                </option>
                                <option value="dateLastWeek" <?php if($_GET['date'] == 'dateLastWeek') echo "selected"; ;?>>
                                    <?= Yii::t('common','Last Week')?>
                                </option>
                                <option value="dateCurrentMonth" <?php if($_GET['date'] == 'dateCurrentMonth') echo "selected"; ;?>>
                                    <?= Yii::t('common','Current Month')?>
                                </option>
                                <option value="dateLastMonth" <?php if($_GET['date'] == 'dateLastMonth') echo "selected"; ;?>>
                                    <?= Yii::t('common','Last Month')?>
                                </option>
                                <option value="dateCurrentYear" <?php if($_GET['date'] == 'dateCurrentYear') echo "selected"; ;?>>
                                    <?= Yii::t('common','Current Year')?>
                                </option>
                                <option value="dateLastYear" <?php if($_GET['date'] == 'dateLastYear') echo "selected"; ;?>>
                                    <?= Yii::t('common','Last Year')?>
                                </option>
                            </select>
                            <small class="form-text text-muted"><?= \Yii::t('common', 'Filter the dashboard by time.')?></small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?= \Yii::t('common', 'Filter by organizations')?></label>

                            <select class="form-control" name="organization_id">
                                <option value=""><?= Yii::t('backend','All');  ?></option>
                                <?php foreach(Organization::find()->all() as $org): ?>
                                    <option value="<?= $org->id ?>"  <?php if($_GET['organization_id'] == $org->id) echo "selected"; ;?> ><?= $org->name ?></option>
                                <?php endforeach; ?>
                            </select>
                            <!-- <input type="text" class="form-control" value=""> -->
                            <!-- <small class="form-text text-muted"><?= \Yii::t('common', 'Filter the dashboard by organization.')?></small> -->
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">

                            <button class="btn btn-success" style="margin-top: 32px;"><?= \Yii::t('common', 'Filter')?></button>
                        </div>
                    </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
<!-- /.content-header -->
<div class="row">
    <div class="col-sm-12 col-md-3">

            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="icofont-institution"></i></span>

                <div class="info-box-content">
                <span class="info-box-number"><?= $organizationsCount ?></span>
                <span class="info-box-text"><?= Yii::t('backend','Organizations Count') ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
    </div>
    <div class="col-sm-12 col-md-3">

            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="icofont-list"></i></span>

                <div class="info-box-content">
                <span class="info-box-number"><?= $surveyCount?></span>
                <span class="info-box-text"><?= Yii::t('backend','Assessments Count') ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
    </div>

    <div class="col-sm-12 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="icofont-files-stack"></i></span>

            <div class="info-box-content">
            <span class="info-box-number"><?= $surveyStatsCount ?></span>
            <span class="info-box-text"><?= Yii::t('backend','Contributing Count') ?></span>
            </div>
            <!-- /.info-box-content -->
        </div>

    </div>

    <div class="col-sm-12 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="icofont-ui-user-group"></i></span>

            <div class="info-box-content">
            <span class="info-box-number"><?= $userCount ?></span>
            <span class="info-box-text"><?= Yii::t('backend','Contributors Count') ?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <?= Yii::t('backend','Contributing Report') ?>
                </h3>
            </div>
            <div class="box-body">
                <canvas id="visitors-chart" style="height: 237px" height="237" ></canvas>

                <!-- <div class="d-flex flex-row justify-content-end">

                </div> -->
            </div>
            <div class="box-footer text-center">


                    <span class="mr-5 ml-5">
                        <i class="fas fa-square text-gray" style="color:#dd4b39 !important"></i> <?= Yii::t('backend','Contributing Count') ?>
                    </span>
            </div>
        <!-- /.box-body -->
        </div>

    </div>
</div>



<div class="row">
    <div class="col-sm-12">
        <div class="box box-dark">
            <div class="box-header with-border">
                <h3 class="box-title"><?= Yii::t('common','New Organizations') ?></h3>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <?php if(count($organizations)):?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th><?= Yii::t('common','Name') ?></th>
                                <th><?= Yii::t('common','Assessments')?></th>
                                <th><?= Yii::t('common','Contributors')?></th>
                                <th><?= Yii::t('backend','Contributing Count')?></th>
                                <th><?= Yii::t('common','Actions') ?></th>
                            </tr>
                        </thead>
                            <tbody>
                                <?php foreach($organizations as $organization):?>
                                <tr>
                                    <td>

                                        <a href="/organization/view?id=<?= $organization->id ?>"><?= $organization->name ?></a>
                                    </td>
                                    <td><a ><?= $organization->countSurvey() ?></a></td>
                                    <td><a href="#"><?= $organization->countUsers() ?></a></td>
                                    <td><a href="#"><?= $organization->startSurvey() ?></a></td>
                                    <td>
                                        <a href="/organization/view?id=<?= $organization->id ?>" class="text-muted newOrgsActions" title="<?= Yii::t('common','View') ?>" style="margin-right: 10px">
                                            <i class="fas fa-file-contract"></i>
                                        </a>
                                        <a href="/organization/update?id=<?= $organization->id ?>" class="text-muted newOrgsActions"  title="<?= Yii::t('common','Edit') ?>">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                    </td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                        <div class="box-footer text-center">
                            <a href="/organization" class="btn btn-success"><?= Yii::t('common','All Organizations') ?></a>
                        </div>
                    <?php else:?>
                        <p><?= Yii::t('common','No results') ?></p>
                    <?php endif;?>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>

    <!-- /.col-md-6 -->
</div>



<!-- /.row -->

<?php

$l = json_encode($labels);
$d2 = json_encode($dataChart);
$js = <<<JS
$(function () {
  'use strict'

  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }

  var mode      = 'index'
  var intersect = true
    var Charts = $('#visitors-chart')
  var visitorsChart  = new Chart(Charts, {
    data   : {
      labels  : $l,
      datasets: [
        {
          type                : 'line',
          data                : $d2,
          backgroundColor     : 'tansparent',
          borderColor         : '#dd4b39 ',
          pointBorderColor    : '#dd4b39 ',
          pointBackgroundColor: '#dd4b39 ',
          fill                : false,
          pointHoverBackgroundColor: '#dd4b39',
          pointHoverBorderColor    : '#dd4b39'
        }]
    },
    options: {
      maintainAspectRatio: false,
      tooltips           : {
        mode     : mode,
        intersect: intersect
      },
      hover              : {
        mode     : mode,
        intersect: intersect
      },
      legend             : {
        display: false
      },
      scales             : {
        yAxes: [{
          // display: false,
          gridLines: {
            display      : true,
            lineWidth    : '4px',
            color        : 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks    : $.extend({
            beginAtZero : true,
            suggestedMax: 20
          }, ticksStyle)
        }],
        xAxes: [{
          display  : true,
          gridLines: {
            display: false
          },
          ticks    : ticksStyle
        }]
      }
    }
  })
})
JS;
$this->registerJs($js);

?>

