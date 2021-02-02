<?php

namespace api\resources;

use backend\models\District;

class DistrictResource extends District
{
    public function fields()
    {
        return [
            'id',
            'title',
        ];
    }


}
