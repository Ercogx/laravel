<?php

namespace App\Repositories;

use App\Models\BlogPost as Model;
use Illuminate\Pagination\LengthAwarePaginator;

class BlogPostRepository extends CoreRepository
{
    /**
     * @inheritDoc
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * Get list articles to display in list
     * (Admin panel)
     *
     * @return LengthAwarePaginator
     */
    public function getAllWithPaginate()
    {
       $columns = [
           'id',
           'title',
           'slug',
           'is_published',
           'published_at',
           'user_id',
           'category_id'
       ];

       $result = $this->startConditions()
           ->select($columns)
           ->orderBy('id', 'DESC')
           ->with(['category:id,title', 'user:id,name'])
           ->paginate(25);

       return $result;
    }

    /**
     * Get model for edit in admin panel
     *
     * @param int $id
     * @return Model
     */
    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }
}
