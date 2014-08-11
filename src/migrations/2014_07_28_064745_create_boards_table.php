<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoardsTable extends Migration
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
            $table->string('description', 256)->nullable();
            $table->integer('parent_board_id')->nullable()->unsigned();
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
        return Config::get('cuckoo::schema.board.table', 'boards');
    }

    /**
     * Get the configured primary key for the migrations.
     *
     * @return string   Primary key name
     */
    protected function getKey()
    {
        return Config::get('cuckoo::schema.board.key', 'id');
    }
}

