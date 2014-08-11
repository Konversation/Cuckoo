<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $table = $this->getTable();

        Schema::create($table, function ($table) {
            $table->increments($this->getKey())->unsigned();
            $table->softDeletes();
            $table->string('title', 32);
            $table->string('slug', 48)->nullable();
            $table->integer('board_id')->unsigned();
            $table->datetime('activated_at')->nullable();
            $table->datetime('closed_at')->nullable();
            $table->string('closed_reason', 128)->nullable();
        });
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
        return Config::get('cuckoo::schema.topic.table', 'topics');
    }

    /**
     * Get the configured primary key for the migrations.
     *
     * @return string   Primary key name
     */
    protected function getKey()
    {
        return Config::get('cuckoo::schema.topic.key', 'id');
    }
}

