<?php

namespace App\Repositories;

use App\Models\BlogCategory as Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class BlogCategoryRepository
 * @package App\Repositories
 */
class BlogCategoryRepository extends CoreRepository
{

    /**
     * Get model for edit in admin panel
     *
     * @param int $id
     * @return Model
     */
    public function getEdit(int $id)
    {
        return $this->startConditions()->find($id);
    }

    /**
     * Get list category for view in select list
     *
     * @return Collection
     */
    public function getForComboBox()
    {
        //return $this->startConditions()->all();

        $fields = implode(', ', [
            'id',
            'CONCAT (id, ". ", title) AS id_title',
        ]);

        $result = $this
            ->startConditions()
            ->selectRaw($fields)
            ->toBase()
            ->get();

        return $result;
    }

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAllWithPaginate($perPage = null)
    {
        $columns = ['id', 'title', 'parent_id'];

        $result = $this
            ->startConditions()
            ->paginate($perPage, $columns);

        return $result;
    }
}
