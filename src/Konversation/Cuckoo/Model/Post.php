<?php
namespace Konversation\Cuckoo\Model;

use Config;

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;

use Konversation\Cuckoo\Entity;
use Konversation\Cuckoo\Model\BaseModel;
use Konversation\Cuckoo\Model\SlugTrait;

class Post extends BaseModel implements SluggableInterface
{
    use SoftDeletingTrait;
    use SlugTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content', 'content_raw',
        'topic_id', 'user_id',
    ];

    /*
     * Get the topic this post belongs to.
     *
     * @return \Konversation\Cuckoo\Model\Topic
     */
    public function topic()
    {
        $model      = Config::get('cuckoo::model.topic', Entity::DEFAULT_TOPIC_MODEL);
        $primaryKey = Config::get('cuckoo::schema.topic.key');

        return $this->belongsTo($model, 'topic_id', $primaryKey);
    }

    /*
     * Get the topic the topic of this post belongs to.
     *
     * @return \Konversation\Cuckoo\Model\Board
     */
    public function board()
    {
        return $this->topic->board();
    }

    /*
     * Get the user that created this post.
     *
     * @return \Konversation\Cuckoo\Model\User
     */
    public function author()
    {
        $model      = Config::get('cuckoo::model.user', Entity::DEFAULT_USER_MODEL);
        $primaryKey = Config::get('cuckoo::schema.user.key');

        return $this->belongsTo($model, 'user_id', $primaryKey);
    }
}

