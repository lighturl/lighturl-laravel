<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
class CreateSofaRevisionsTable extends Migration
{
    /**
     * Revisions table.
     *
     * @var string
     */
    protected $table;
    public function __construct()
    {
        $this->table = 'lighturl';
    }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->increments('id');
            $table->string('heavy_url', 255);
            $table->string('short_key', 255);
            $table->integer('user')->unsigned();
            $table->timestamp('created_at')->useCurrent();

			$table->unique(['short_key','heavy_url']);
            $table->index(['short_key', 'heavy_url']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop($this->table);
    }
}