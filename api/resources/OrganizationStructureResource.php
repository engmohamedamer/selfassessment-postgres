<?php

namespace api\resources;
use common\models\OrganizationStructure;

class OrganizationStructureResource extends OrganizationStructure
{
    public function fields()
    {
        return [
            'id',
            'name',
        ];
    }


}
