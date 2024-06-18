<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenghunisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penghunis', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('restrict')->onUpdate('cascade');

            $table->foreignId('product_id')->nullable()->constrained('products')->onDelete('restrict')->onUpdate('cascade');

            $table->datetime('tanggal_masuk')->nullable();
            $table->datetime('tanggal_keluar')->nullable();

            $table->integer('is_active')->nullable()->default(1);

            $table->timestamps();

            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penghunis');
    }
}
