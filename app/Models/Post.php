<?php

namespace App\Models;

use App\Helpers\Helper;
use App\Models\Scopes\DomainScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

#[ScopedBy([DomainScope::class])]
class Post extends Model
{
    protected $fillable = [
        'title',
        'description',
        'text',
        'tags',
        'domain_id',
    ];

    protected $casts = [
        'tags' => 'array',
    ];

    protected $appends = [
        'image',
        'slug'
    ];

    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }

    public function getImageAttribute(): string
    {
        $random = Helper::firstLetters($this->title);
        return 'https://'.$random.'.mm.bing.net/th?q=' . urlencode($this->title);
    }

    public function getSlugAttribute(): string
    {
        if (empty($this->slug)) {
            return Str::slug($this->title);
        }
        return '';
    }

}
