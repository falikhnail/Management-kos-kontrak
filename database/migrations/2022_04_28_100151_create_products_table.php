<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();
            $table->text('address')->nullable();

            $table->integer('buy')->default(0);
            $table->integer('price')->default(0);
            $table->enum('durasi_pembayaran', ['harian', 'bulanan', 'tahunan'])->nullable();

            $table->text('photo')->nullable();
            $table->text('note')->nullable();

            $table->foreignId('penghuni')->nullable()->constrained('users')->onDelete('restrict')->onUpdate('cascade');

            $table->integer('is_active')->default(1)->nullable();

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
        Schema::dropIfExists('products');
    }
}
