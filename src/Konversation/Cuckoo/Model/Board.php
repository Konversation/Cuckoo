<?php
namespace Konversation\Cuckoo\Model;

use Config;

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;

use Konversation\Cuckoo\Entity;
use Konversation\Cuckoo\Model\BaseModel;
use Konversation\Cuckoo\Model\SlugTrait;

class Board extends BaseModel implements SluggableInterface
{
    use SoftDeletingTrait;
    use SlugTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'boards';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'title', 'description', 'parent_board_id' ];

    /*
     * Get all topics that are categorized in this board.
     *
     * @return \Konversation\Cuckoo\Model\Topic
     */
    public function topics()
    {
        $model      = Config::get('cuckoo::model.topic', Entity::DEFAULT_TOPIC_MODEL);
        $primaryKey = Config::get('cuckoo::schema.topic.key');

        return $this->hasMany($model, 'board_id', $primaryKey);
    }

    /*
     * Get parent board.
     *
     * @return null|\Konversation\Cuckoo\Model\Board
     */
    public function parent()
    {
        $model      = Config::get('cuckoo::model.board', Entity::DEFAULT_BOARD_MODEL);
        $primaryKey = Config::get('cuckoo::schema.board.key');

        return $this->belongsTo($model, 'parent_board_id', $primaryKey);
    }

    /*
     * Get children boards.
     *
     * @return null|\Konversation\Cuckoo\Model\Board
     */
    public function children()
    {
        $model      = Config::get('cuckoo::model.board', Entity::DEFAULT_BOARD_MODEL);
        $primaryKey = Config::get('cuckoo::schema.board.key');

        return $this->hasMany($model, 'parent_board_id', $primaryKey); 
    }

    /*
     * Scope for only getting parent boards.
     *
     * @param  \Illuminate\Database\Query\QueryBuilder $query
     * @return null|\Illuminate\Database\Query\QueryBuilder
     */
    public function scopeOnlyParents($query)
    {
        return $query->where('parent_board_id', null);
    }

    /*
     * Scope for getting only children of a given parent board.
     *
     * @param  \Illuminate\Database\Query\QueryBuilder $query
     * @param  int|\Konversation\Cuckoo\Model\Board $parent
     * @return null|\Illuminate\Database\Query\QueryBuilder
     */
    public function scopeOnlyChildrenOf($query, $parent)
    {
        if ($parent instanceof self) {
            $parent = $parent->getKey();
        }

        return $query->where('parent_board_id', $parent);
    }
}

