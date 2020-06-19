<?php


namespace App\Repositories;

use App\Models\BlogPost as Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class BlogPostRepository.
 *
 * @package App\Repositories
 */

class BlogPostRepository extends CoreRepository
{

    /**
     * @return string
     *  Return the model
     */
    public function getModelClass()
    {
        return Model::class;
    }

    /**
     * get posts for display by paginator.
     * @param int|null $perPage
     * @return LengthAwarePaginator
     */
    public function getAllWithPaginate($perPage = null){

        $columns = [
            'id',
            'title',
            'slug',
            'is_published',
            'published_at',
            'user_id',
            'category_id',
            ];

        $result = $this
            ->startConditions()
            ->select($columns)
            ->orderBy('id', 'DESC')
           // ->with(['category', 'user'])
            ->with(['category' => function($query){$query->select(['id','title']);},'user:id,name',])
            ->paginate($perPage);

        // dd($result);

        return $result;

    }

}
