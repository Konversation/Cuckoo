<?php
namespace Konversation\Cuckoo\Model;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

use Konversation\Cuckoo\Model\UserTrait as CuckooUserTrait;

class User extends Eloquent implements UserInterface, RemindableInterface
{
    use UserTrait;
    use RemindableTrait;
    use CuckooUserTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [ 'password', 'remember_token' ];
}

