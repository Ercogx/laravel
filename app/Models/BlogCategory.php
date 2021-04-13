<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\BlogCategory
 *
 * @property int $id
 * @property int $parent_id
 * @property string $slug
 * @property string $title
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read BlogCategory $parentCategory
 * @property-read string $parentTitle
 * @method static \Illuminate\Database\Eloquent\Builder|BlogCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogCategory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogCategory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogCategory whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogCategory whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogCategory whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read string $parent_title
 * @method static \Illuminate\Database\Query\Builder|BlogCategory onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|BlogCategory withTrashed()
 * @method static \Illuminate\Database\Query\Builder|BlogCategory withoutTrashed()
 */
class BlogCategory extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Root category
     */
    const ROOT = 1;

    protected $fillable = [
        'title',
        'slug',
        'parent_id',
        'description',
    ];

    /**
     * Get parent category
     *
     * @return BlogCategory
     */
    public function parentCategory()
    {
        return $this->belongsTo(BlogCategory::class, 'parent_id', 'id');
    }

    /**
     * Example Accessor
     *
     * @return string
     */
    public function getParentTitleAttribute(){
        $title = $this->parentCategory->title
            ?? ($this->isRoot()
            ? 'Root'
            : '???');

        return $title;
    }

    /**
     * Check if category object is root
     *
     * @return bool
     */
    public function isRoot(){
        return $this->id === BlogCategory::ROOT;
    }
}
