<?php namespace Photos\Models;

class Photo extends \Eloquent {

    // Timestamps
    public static $timestamps = true;

    /**
     * Belongs to a gallery
     */
    public function gallery()
    {
        return $this->belongs_to('Photos\Models\Gallery');
    }

}