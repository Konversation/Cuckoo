<?php
namespace Konversation\Cuckoo\Model;

use Config;

use Konversation\Cuckoo\Exception\InvalidEntityException;
use Konversation\Cuckoo\Model\Topic;
use Konversation\Cuckoo\Model\Post;

trait UserTrait
{
    /*
     * Get all posts made by the user.
     *
     * @return \Konversation\Cuckoo\Model\Post
     */
    public function posts()
    {
        $model      = Config::get('cuckoo::model.post', Entity::DEFAULT_POST_MODEL);
        $primaryKey = Config::get('cuckoo::schema.post.key');

        return $this->hasMany($model, 'user_id', $primaryKey);
    }

    /*
     * Get all topics created by the user.
     *
     * @return \Konversation\Cuckoo\Model\Topic
     */
    public function topics()
    {
        $model      = Config::get('cuckoo::model.topic', Entity::DEFAULT_TOPIC_MODEL);
        $primaryKey = Config::get('cuckoo::schema.topic.key');

        return $this->hasMany($model, 'user_id', $primaryKey);
    }

    /*
     * Check if the user is the creator of the given entity.
     *
     * @param  \Konversation\Cuckoo\Model\Topic|\Konversation\Cuckoo\Model\Post $entity
     * @return bool
     */
    public function isAuthorOf($entity)
    {
        if ($entity instanceof Topic || $entity instanceof Post) {
            return $entity->user_id == $this->getKey();
        }

        throw new InvalidEntityException();
    }
}

