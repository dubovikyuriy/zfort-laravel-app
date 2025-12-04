<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('actors', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();

            //its not very good but in the technical task it is required to make description unique
            $table->text('description')->unique();

            $table->string('first_name');
            $table->string('last_name');
            $table->string('address');
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('gender')->nullable();
            $table->integer('age')->nullable();

            $table->timestamps();


            //for select at list page
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('actors');
    }
};
