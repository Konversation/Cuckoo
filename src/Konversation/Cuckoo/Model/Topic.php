<?php
namespace Konversation\Cuckoo\Model;

use Config;

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;

use Konversation\Cuckoo\Entity;
use Konversation\Cuckoo\Model\BaseModel;
use Konversation\Cuckoo\Model\SlugTrait;

class Topic extends BaseModel implements SluggableInterface
{
    use SoftDeletingTrait;
    use SlugTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'topics';

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
    protected $fillable = [ 'title', 'board_id' ];

    /*
     * Get all posts that belong to this topic.
     *
     * @return \Konversation\Cuckoo\Model\Post
     */
    public function posts()
    {
        $model      = Config::get('cuckoo::model.post', Entity::DEFAULT_POST_MODEL);
        $primaryKey = Config::get('cuckoo::schema.post.key');

        return $this->hasMany($model, 'topic_id', $primaryKey);
    }

    /*
     * Get the board that belongs to this topic.
     *
     * @return \Konversation\Cuckoo\Model\Board
     */
    public function board()
    {
        $model      = Config::get('cuckoo::model.board', Entity::DEFAULT_BOARD_MODEL);
        $primaryKey = Config::get('cuckoo::schema.board.key');

        return $this->belongsTo($model, 'board_id', $primaryKey);
    }

    /*
     * Get the main (first) posts that belongs to this topic.
     *
     * @return \Konversation\Cuckoo\Model\Post
     */
    public function getPostAttribute()
    {
        return $this->posts()->first();
    }

    /*
     * Get the user that created this topic.
     *
     * @return \Konversation\Cuckoo\Model\User
     */
    public function getAuthorAttribute()
    {
        return $this->post->author;
    }

    /*
     * Alias for getAuthorAttribute.
     *
     * @return \Konversation\Cuckoo\Model\User
     */
    public function getUserAttribute()
    {
        return $this->author;
    }

    /*
     * Get the creation date of this topic.
     *
     * @return \Carbon\Carbon
     */
    public function getCreatedAtAttribute()
    {
        return $this->post->created_at;
    }

    /*
     * Get the update date of this topic.
     *
     * @return \Carbon\Carbon
     */
    public function getUpdatedAtAttribute()
    {
        return $this->post->updated_at;
    }

    /*
     * Get the actual and parsed content of this topic
     *
     * @return string
     */
    public function getContentAttribute()
    {
        return $this->post->content;
    }
}

