<?php

namespace api\resources;

use backend\models\City;

class CityResource extends City
{
    public function fields()
    {
        return [
            'id',
            'title',
        ];
    }


}
