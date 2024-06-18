<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('restrict')->onUpdate('cascade');

            $table->foreignId('product_id')->nullable()->constrained('products')->onDelete('restrict')->onUpdate('cascade');

            $table->string('type')->nullable();
            $table->string('sub_type')->nullable();

            $table->string('status')->nullable();

            $table->timestamp('transaction_date')->nullable();

            $table->decimal('amount', 15, 2)->default(0);

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
        Schema::dropIfExists('transactions');
    }
}
