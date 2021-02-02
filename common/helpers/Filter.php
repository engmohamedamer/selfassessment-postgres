<?php

namespace common\helpers;

use backend\modules\assessment\models\Survey;
use backend\modules\assessment\models\SurveyStat;
use common\models\OrganizationStructure;
use Yii;
use yii\helpers\ArrayHelper;

class Filter
{
    public static function dateFilter($column_date, $unix = false, $prefix = '')
    {
        $key = $_GET['date'] ?: null;
        if ($key == null) {
            return ['IS NOT', $prefix . $column_date, null];
        }

        $column_date = empty($prefix) ? $column_date : $prefix . $column_date;
        $dateFormat = $unix ? "DATE(to_timestamp($column_date))" : "DATE($column_date)";
        $monthFormat = $unix ? "to_char(to_timestamp($column_date),'MM')" : "to_char(" . $column_date . "::date,'MM')";
        $yearForamt = $unix ? "to_char(to_timestamp($column_date),'YYYY')" : "to_char(" . $column_date . "::date,'YYYY')";
        // return $dateFormat;
        $date['dateCurrentDay'] = [$dateFormat => date('Y-m-d')];
        $date['dateLastDay'] = [$dateFormat => date('Y-m-d', strtotime("-1 day"))];

        $date['dateCurrentWeek'] = ["BETWEEN", "$dateFormat", date("Y-m-d", strtotime("last saturday")), date("Y-m-d", strtotime("1 day"))];
        $date["dateLastWeek"] = ["BETWEEN", "$dateFormat", date("Y-m-d", strtotime("-7 days", strtotime(date("Y-m-d", strtotime("last saturday"))))), date("Y-m-d", strtotime("last saturday"))];

        $date["dateCurrentMonth"] = [$monthFormat => date("m"), $yearForamt => date("Y")];
        $date["dateLastMonth"] = [$monthFormat => date("m", strtotime("-1 month")),
            $yearForamt => (date("m", strtotime("-1 month")) == "12") ? date("Y", strtotime("-1 year")) : date("Y"),
        ];

        $date["dateCurrentYear"] = [$yearForamt => date("Y")];
        $date["dateLastYear"] = [$yearForamt => date("Y", strtotime("-1 year"))];

        return $date[$key];
    }

    public static function organizationStructureQuery()
    {
        $organization_id = \Yii::$app->user->identity->userProfile->organization_id;
        $sector_id = \Yii::$app->user->identity->userProfile->sector_id;
        if ($sector_id) {
            // select * from organization_structure where  id = 9  or root = 1  and lvl > 2 and rgt < 12 and lft > 7
            $str = OrganizationStructure::findOne($sector_id);
            return OrganizationStructure::find()->where(['organization_id' => $organization_id, 'root' => $str->root])
                ->andWhere(['>', 'lvl', $str->lvl])
                ->andWhere(['<', 'rgt', $str->rgt])
                ->andWhere(['>', 'lft', $str->lft])
                ->orWhere(['id' => $str->id])
                ->addOrderBy('root, lft');
        }
        return OrganizationStructure::find()->where(['organization_id' => $organization_id])->addOrderBy('root, lft');
    }

    public static function adminAllowedSectorIds()
    {
        $organizationStructure = self::organizationStructureQuery()->all();
        if (count($organizationStructure)) {
            return ArrayHelper::getColumn($organizationStructure, 'id');
        }
        return [];
    }

    public static function chartData()
    {

        if (!empty($_GET['organization_id'])) {
            $surveyIds = ArrayHelper::getColumn(Survey::find()->where(['org_id' => $_GET['organization_id']])->all(), 'survey_id');
            $filter = ['IN', 'survey_stat_survey_id', $surveyIds];
        } else {
            $filter = ['IS NOT', 'survey_stat_survey_id', null];
        }

        if ($_GET['date'] == 'dateLastYear') {
            $year = date("Y", strtotime("-1 year"));
            $chartPerYear = self::chartPerYear($year, $filter);
            return ['data' => $chartPerYear['data'], 'labels' => $chartPerYear['labels']];
        } elseif ($_GET['date'] == 'dateCurrentDay' || $_GET['date'] == 'dateLastDay' || $_GET['date'] == 'dateCurrentWeek') {
            $date = self::dateFilter("to_char(survey_stat_assigned_at,'YYYY-MM-DD')");
            $chartPerYear = self::chartPerWeek($date, $filter);
            return ['data' => $chartPerYear['data'], 'labels' => $chartPerYear['labels']];

        } elseif ($_GET['date'] == 'dateLastWeek') {

            $date = self::dateFilter("to_char(survey_stat_assigned_at::date,'YYYY-MM-DD')");
            $chartPerYear = self::chartPerWeek($date, $filter);
            return ['data' => $chartPerYear['data'], 'labels' => $chartPerYear['labels']];

        } elseif ($_GET['date'] == 'dateCurrentMonth') {

            $date = self::dateFilter('survey_stat_assigned_at');
            $chartPerYear = self::chartPerMonth($date, $filter);
            return ['data' => $chartPerYear['data'], 'labels' => $chartPerYear['labels']];

        } elseif ($_GET['date'] == 'dateLastMonth') {
            $date = self::dateFilter('survey_stat_assigned_at');
            $chartPerYear = self::chartPerMonth($date, $filter);
            return ['data' => $chartPerYear['data'], 'labels' => $chartPerYear['labels']];

        } else {
            $year = date('Y');
            $chartPerYear = self::chartPerYear($year, $filter);
            return ['data' => $chartPerYear['data'], 'labels' => $chartPerYear['labels']];
        }
    }

    private function chartPerWeek($date, $filter)
    {
        $surveyStatsCountPerMonthDay = SurveyStat::find()
            ->select(["to_char(survey_stat_assigned_at::date,'DD') as day", "count(survey_stat_assigned_at) as count_day"])
            ->where($date)
            ->andWhere($filter)
            ->groupBy(["to_char(survey_stat_assigned_at::date,'DD')"])
            ->all();

        $labels = [];
        $data = [];

        if ($_GET['date'] == 'dateCurrentWeek') {
            $start = (int) date("d", strtotime("last saturday"));
            $end = (int) date("d", strtotime("1 day"));
        } else {
            $start = (int) date("d", strtotime("-7 days", strtotime(date("Y-m-d", strtotime("last saturday")))));
            $end = (int) date("d", strtotime("last saturday"));
        }

        for ($i = $start; $i < $end; $i++) {
            $labels[] = $i;
            $data[] = 0;
        }

        foreach ($surveyStatsCountPerMonthDay as $key => $value) {
            $data[array_search($value->day, $labels)] = $value->count_day;
        }
        return ['data' => $data, 'labels' => $labels];
    }

    private function chartPerMonth($date, $filter)
    {
        $surveyStatsCountPerMonthDay = SurveyStat::find()
            ->select(["to_char(survey_stat_assigned_at::date,'DD') as day", "count(survey_stat_assigned_at) as count_day"])
            ->where($date)
            ->andWhere($filter)
            ->groupBy('survey_stat_assigned_at')
            ->all();

        $labels = [];
        $data = [];

        for ($i = 1; $i <= 30; $i++) {
            $labels[] = $i;
            $data[] = 0;
        }

        foreach ($surveyStatsCountPerMonthDay as $key => $value) {
            $data[($value->day - 1)] = $value->count_day;
        }
        return ['data' => $data, 'labels' => $labels];
    }

    private function chartPerYear($year, $filter)
    {
        $surveyStatsCountPerMonth = SurveyStat::find()
            ->select(["to_char(survey_stat_assigned_at,'MM') as month", " count(to_char(survey_stat_assigned_at,'MM')) as count_month"], )
            ->where(["to_char(survey_stat_assigned_at,'YYYY')" => $year])
            ->andWhere($filter)
            ->groupBy(["to_char(survey_stat_assigned_at,'MM')"])
            ->all();

        $labels = [];
        $data = [];

        for ($i = 1; $i <= 12; $i++) {
            $labels[] = self::months()[$i];
            $data[] = 0;
        }

        foreach ($surveyStatsCountPerMonth as $key => $value) {
            $data[($value->month - 1)] = $value->count_month;
        }
        return ['data' => $data, 'labels' => $labels];
    }

    private static function months()
    {
        return array(1 => 'Jan.', 2 => 'Feb.', 3 => 'Mar.', 4 => 'Apr.', 5 => 'May', 6 => 'Jun.', 7 => 'Jul.', 8 => 'Aug.', 9 => 'Sep.', 10 => 'Oct.', 11 => 'Nov.', 12 => 'Dec.');
    }
}
