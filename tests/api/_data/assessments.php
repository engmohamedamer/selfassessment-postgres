<?php
return [
    // for check assessment available for view api because contributor start it (status 1 in list)
    [
        'survey_id'=>1,
        'org_id'=>5,
        'survey_name' => 'Assessment one',
        'survey_created_at'=>'2019-12-01 13:50:00',
        'survey_expired_at'=>'2019-12-26 13:50:00',
        'survey_is_pinned'=>0,
        'survey_is_closed'=>0,
        'survey_time_to_pass'=>10,
        'survey_is_private'=>0,
        'survey_is_visible'=>1,
        'start_info'=>'Start Info',
        'survey_point'=>10,
    ],
    // closed assessment 403 - Forbidden
    [
        'survey_id'=>2,
        'org_id'=>5,
        'survey_name' => 'Assessment two',
        'survey_created_at'=>'2019-12-01 13:50:00',
        'survey_expired_at'=>'2019-12-26 13:50:00',
        'survey_is_pinned'=>0,
        'survey_is_closed'=>1,
        'survey_time_to_pass'=>10,
        'survey_is_private'=>0,
        'survey_is_visible'=>1,
        'start_info'=>'Start Info',
        'survey_point'=>10,
    ],
    // open but assessment time expired 403 - Forbidden
    [
        'survey_id'=>3,
        'org_id'=>5,
        'survey_name' => 'Assessment three',
        'survey_created_at'=>'2019-11-01 13:50:00',
        'survey_expired_at'=>'2019-12-01 13:50:00',
        'survey_is_pinned'=>0,
        'survey_is_closed'=>0,
        'survey_time_to_pass'=>10,
        'survey_is_private'=>0,
        'survey_is_visible'=>1,
        'start_info'=>'Start Info',
        'survey_point'=>10,
    ],
    // for check assessment view report btn in listing because contributor finished it (403 - Forbidden in view , status 2 in list)
    [
        'survey_id'=>4,
        'org_id'=>5,
        'survey_name' => 'Assessment four',
        'survey_created_at'=>'2019-11-01 13:50:00',
        'survey_expired_at'=>'2019-12-28 13:50:00',
        'survey_is_pinned'=>0,
        'survey_is_closed'=>0,
        'survey_time_to_pass'=>10,
        'survey_is_private'=>0,
        'survey_is_visible'=>1,
        'start_info'=>'Start Info',
        'survey_point'=>10,
    ],
    // open assessment
    [
        'survey_id'=>5,
        'org_id'=>5,
        'survey_name' => 'Assessment five',
        'survey_created_at'=>'2019-11-01 13:50:00',
        'survey_expired_at'=>'2019-12-28 13:50:00',
        'survey_is_pinned'=>0,
        'survey_is_closed'=>0,
        'survey_time_to_pass'=>10,
        'survey_is_private'=>0,
        'survey_is_visible'=>1,
        'start_info'=>'Start Info',
        'survey_point'=>10,
    ],
];
