<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CategoryTranslate
 *
 * @property int $id
 * @property string $name
 * @property string $title
 * @property string $description
 * @property int|null $category_id
 * @property int $lang_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category|null $category
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryTranslate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryTranslate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryTranslate query()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryTranslate whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryTranslate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryTranslate whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryTranslate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryTranslate whereLangId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryTranslate whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryTranslate whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryTranslate whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CategoryTranslate extends Model
{
    use HasFactory;

    protected $table = 'category_translate';
    public $timestamps = true;

    protected $fillable = [
        'name', 'title', 'description', 'category_id', 'lang_id',
    ];

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class,'category_id');
    }
}
