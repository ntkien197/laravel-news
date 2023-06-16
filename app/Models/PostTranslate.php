<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PostTranslate
 *
 * @property int $id
 * @property string $name
 * @property string $title
 * @property string $sub_title
 * @property string $content
 * @property int|null $post_id
 * @property int $lang_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Post|null $post
 * @method static \Illuminate\Database\Eloquent\Builder|PostTranslate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostTranslate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostTranslate query()
 * @method static \Illuminate\Database\Eloquent\Builder|PostTranslate whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostTranslate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostTranslate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostTranslate whereLangId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostTranslate whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostTranslate wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostTranslate whereSubTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostTranslate whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostTranslate whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PostTranslate extends Model
{
    use HasFactory;

    protected $table = 'post_translate';
    public $timestamps = true;

    protected $fillable = [
        'name','title','sub_title','content','post_id','lang_id'
    ];

    public function post(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Post::class,'post_id');
    }
}
