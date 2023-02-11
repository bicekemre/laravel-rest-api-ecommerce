<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;
return new class extends Migration
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
            $table->foreignIdfor(Category::class, 'category_id')->nullable();
            $table->string('name');
            $table->float('price');
            $table->text('lead');
            $table->text('description');
            $table->string("slug");
            $table->integer('quantity')->nullable();
            $table->integer('rating')->nullable();
            $table->integer('views')->nullable();
            $table->boolean("is_active");
            $table->boolean("is_recommended");
            $table->timestamps();
            $table->softDeletes();
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
};
