<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('birth_place')->nullable();
            $table->string('original_job')->nullable();
            $table->date('birthdate');
            $table->date('requisition_date');
            $table->integer('rank');
            // الهيئة المستخدمة
            $table->string('commission',50);
            $table->foreignId('user_id')->default(0)->onDelete('set default');
            $table->unique(['first_name','last_name']);
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
        Schema::dropIfExists('people');
    }
}
