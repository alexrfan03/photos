<?php namespace Photos\Models;

/**
 * Photo gallery model
 */
class Gallery extends \Eloquent {

    // Table name
    public static $table = "galleries";

    // Timestamps
    public static $timestamps = true;

    /**
     * has-many relation with Photos\Models\Photo
     *
     * A gallery can have many photos
     */
    public function photos()
    {
        return $this->has_many('Photos\Models\Photo');
    }

    /**
     * Set slug
     */
    public function set_slug($slug)
    {
        $new_slug = $slug;
        $slug_rows = Gallery::where('slug', 'LIKE', $slug . '%')
        ->order_by('slug', 'asc')
        ->get();
        if (count($slug_rows) > 0) {
            $slugs_values = array();
            foreach ($slug_rows as $row) {
                $slugs_values[] = $row->slug;
            }
            $last_slug = array_reverse(explode('-', array_pop($slugs_values)));
            if ((int) $last_slug[0] !== 0) {
                $new_slug = $slug . '-' . (((int) $last_slug[0]) + 1);
            } else {
                $new_slug = $slug . '-1';
            }
        }
        $this->set_attribute('slug', $new_slug);
    }

}