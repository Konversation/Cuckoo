<?php
namespace Konversation\Cuckoo;

final class Entity
{
    /*
     * Entity ID for boards.
     */
    const BOARD = 1;

    /*
     * Entity ID for topics.
     */
    const TOPIC = 2;

    /*
     * Entity ID for posts.
     */
    const POST  = 3;

    /*
     * Default model for boards.
     */
    const DEFAULT_BOARD_MODEL = 'Konversation\\Cuckoo\\Model\\Board';

    /*
     * Default model for topics.
     */
    const DEFAULT_TOPIC_MODEL = 'Konversation\\Cuckoo\\Model\\Topic';

    /*
     * Default model for posts.
     */
    const DEFAULT_POST_MODEL  = 'Konversation\\Cuckoo\\Model\\Post';

    /*
     * Default model for users.
     */
    const DEFAULT_USER_MODEL = 'Konversation\\Cuckoo\\Model\\User';
}

