<?php

namespace App\Services;

use App\Model\Family;

class FamilyService extends Service
{
    public function getFamilyByWhere($params)
    {
        $results = [];
        $results['draw'] = $params['draw'];
        $results['recordsTotal'] = Family::all()->count();
        $results['recordsFiltered'] = Family::all()->count();
        $results['data'] = Family::offset($this->_offset)
            ->orderBy($this->_sortField, $this->_sortType)
            ->limit($this->_length)
            ->get()
            ->toArray();

        return $results;
    }
}
