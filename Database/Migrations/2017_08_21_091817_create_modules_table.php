<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('section');
            $table->string('title');
            $table->mediumText('description')->nullable();
            $table->tinyInteger('hidden')->default(0)->nullable();
            $table->smallInteger('pos')->default(0);
            $table->timestamps();
        });

        DB::table('modules')->insert( [
            'name' => 'users',
            'section' => 'accesses',
            'title' => 'Аккаунты',
        ]);
        DB::table('modules')->insert( [
            'name' => 'modules',
            'section' => 'accesses',
            'title' => 'Модули',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modules');
    }
}
