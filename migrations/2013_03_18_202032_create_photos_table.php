<?php

class Photos_Create_Photos_Table {

    /**
     * Make changes to the database.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function ($table) {
            $table->increments('id');
            $table->integer('gallery_id')->unsigned()->nullable()->default(null);
            $table->string('filename', 200);
            $table->string('caption', 200)->nullable();
            $table->string('description', 200)->nullable();
            $table->boolean('published')->default(true);
            $table->timestamps();
            // Foreign Keys
            $table->foreign('gallery_id')->references('id')->on('galleries');
        });
    }

    /**
     * Revert the changes to the database.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('photos', function ($table) {
            $table->drop_foreign('photos_gallery_id_foreign');
        });
        Schema::drop('photos');
    }

}