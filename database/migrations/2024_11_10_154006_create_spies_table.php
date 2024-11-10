<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('spies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('agency'); // Agency field with predefined values
            $table->string('country_of_operation')->nullable();
            $table->date('date_of_birth');
            $table->date('date_of_death')->nullable(); // Optional field
            $table->timestamps();
            $table->unique(['name', 'surname']);   // Ensure uniqueness of the spy by name and surname
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spies');
    }
};
