<?php

/**
 * Migration for galleries table
 */
class Photos_Create_Galleries_Table {

    /**
     * Make changes to the database.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galleries', function ($table) {
            $table->increments('id');
            $table->string('name', 200)->unique();
            $table->string('slug', 200)->unique();
            $table->boolean('published')->default(false);
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Revert the changes to the database.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('galleries', function ($table) {
            $table->drop_unique('galleries_slug_unique');
        });
        Schema::drop('galleries');
    }

}
