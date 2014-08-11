<?php
namespace Konversation\Cuckoo\Model;

use Config;
use Eloquent;

class BaseModel extends Eloquent
{
    /*
     * {@inheritDoc}
     */
    public function getClassIdentifier()
    {
        return snake_case(class_basename($this));
    }

    /*
     * {@inheritDoc}
     */
    public function getTable()
    {
        $key = 'cuckoo::schema.' . $this->getClassIdentifier() . '.table';

        return Config::get($key, $this->table);
    }

    /*
     * {@inheritDoc}
     */
    public function getKeyName()
    {
        $key = 'cuckoo::schema.' . $this->getClassIdentifier() . '.key';

        return Config::get($key, $this->primaryKey);
    }
}

