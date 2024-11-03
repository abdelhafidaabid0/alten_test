<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up() {
        Schema::dropIfExists('products');

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code')
                  ->unique();
            $table->string('name');
            $table->text('description')
                  ->nullable();
            $table->string('image')
                  ->nullable();
            $table->string('category');
            $table->decimal('price', 8, 2);
            $table->integer('quantity');
            $table->string('internal_reference')
                  ->nullable();
            $table->string('shell_id')
                  ->nullable();
            $table->enum('inventory_status', ['INSTOCK', 'LOWSTOCK', 'OUTOFSTOCK']);
            $table->float('rating')
                  ->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down() : void {
        Schema::dropIfExists('products');
    }
};
