<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    use SoftDeletes;

    /** Категории статьи
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public  function category(){
        //статьи принадлежат категории
        return $this->belongsTo(BlogCategory::class);
    }

    /** Автор статьи
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public  function user(){
        //статья принадлежат пользователю
        return $this->belongsTo(User::class);
    }
}
