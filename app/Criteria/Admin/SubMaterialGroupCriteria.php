<?php

namespace App\Criteria\Admin;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;
use Input;
use Date;

/**
 * Class MaterialGroupCriteria
 * @package namespace App\Criteria\Admin;
 */
class SubMaterialGroupCriteria implements CriteriaInterface
{
    /**
     * Apply criteria in query repository
     *
     * @param $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $search = Input::get('search');

        $m = $model->with('SubmaterialGroups');
        
        if (!empty($search['sub_material_group']) and $search['sub_material_group'] > 0) {
            $m->whereHas('roles', function ($query) use($search) {
                    $query->where('sub_material_group.id', $search['sub_material_group']);
            });
        }

        $m->where(function($query) use($search) {

            if (!empty($search['title'])) {
                $query->where('title', 'LIKE', '%' . $search['title'] . '%');
            }
        });

        return $m;
    }
}
