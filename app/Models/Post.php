<?php

namespace App\Models;

use App\Builders\PostBuilder;
use App\Http\Requests\PostRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id',
    ];

    public function newEloquentBuilder($builder)
    {
        return new PostBuilder($builder);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public static function createFromRequest(PostRequest $request)
    {
        return self::create($request->validated());
    }

    public function updateFromRequest(PostRequest $request)
    {
        $this->update($request->validated());
    }
}
