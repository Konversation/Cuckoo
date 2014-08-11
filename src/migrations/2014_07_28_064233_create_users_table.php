<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $table = $this->getTable();

        if (!Schema::hasTable($table)) {
            Schema::create($table, function ($table) {
            $table->increments($this->getKey())->unsigned();
                $table->timestamps();
                $table->softDeletes();
                $table->rememberToken();
                $table->string('username', 32);
                $table->string('email', 256);
                $table->string('password', 64);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table = $this->getTable();

        Schema::drop($table);
    }

    /**
     * Get the configured table for the migrations.
     *
     * @return string   Table name
     */
    protected function getTable()
    {
        return Config::get('cuckoo::schema.user.table', 'users');
    }

    /**
     * Get the configured primary key for the migrations.
     *
     * @return string   Primary key name
     */
    protected function getKey()
    {
        return Config::get('cuckoo::schema.user.key', 'id');
    }
}

