<?php
namespace Konversation\Cuckoo\Model;

use Cviebrock\EloquentSluggable\SluggableTrait;

trait SlugTrait
{
    use SluggableTrait;

    /**
     * The configuration for slug generation.
     *
     * @var array
     */
    protected $sluggable = [
        'build_from'        => 'title',
        'save_to'           => 'slug',
        'include_trashed'   => true,
        'use_cache'         => false,
        'max_length'        => 48,
    ];

    /*
     * Scope for getting topics by slug. 
     *
     * @param  \Illuminate\Database\Query\QueryBuilder $query
     * @param  string $slug
     * @return \Illuminate\Database\Query\QueryBuilder
     */
    public function scopeSlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }

    /*
     * Static method to find by slug.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public static function findBySlug($slug, $columns = [ '*' ])
    {
        $instance = new static;

        if (is_array($slug)) {
            return $instance->newQuery()->whereIn('slug', $slug)->get($columns);
        }

        return $instance->newQuery()->slug($slug)->get($columns);
    }
}

