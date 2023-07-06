<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('path')->nullable(false);

            $table->foreignId("size_id")
                    ->nullable(false)
                    ->constrained('image_sizes')
                    ->cascadeOnUpdate()
                    ->restrictOnDelete();

            $table->foreignId("todo_id")
                    ->nullable(false)
                    ->constrained()
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
}
