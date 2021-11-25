<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequisitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisitions', function (Blueprint $table) {
            $table->id();
            $table->integer('type');
            // الجهة المسخر فيها
            $table->string('destination');
            // المهام الموكلة اليه
            $table->string('authorized_tasks');
            $table->boolean('is_printed')->default(false);
            $table->boolean('number')->nullable()->unique();
            $table->foreignId('person_id')->onDelete('cascade');

            $table->unique(['type', 'person_id']);

            $table->softDeletes();
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
        Schema::dropIfExists('requisitions');
    }
}
