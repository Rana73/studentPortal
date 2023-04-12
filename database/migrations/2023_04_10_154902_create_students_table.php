<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id')
                    ->constrained('institutes')
                    ->onDelete('cascade');
            $table->string('class')->length(100);
            $table->string('name')->length(100);
            $table->string('email')->length(100)->unique();
            $table->string('phone')->length(11);;
            $table->string('status')->length(1)->default(1)->comment('1 => unconfirmed, 2 => admitted, => 3 => terminated');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
