<?php

use Photos\Models\Gallery;
use Photos\Models\Photo;

/**
 * Manage photo galleries
 */
class Photos_Admin_Manage_Gallery_Controller extends Photos_Admin_Base_Controller {

    /**
     * constructor for Photos Manage Gallery
     */
    public function __construct()
    {
        parent::__construct();
        $id = trim(urldecode(Input::get('id')));
        $this->data['gallery'] = Gallery::with('photos')->find($id);
        if (is_null($this->data['gallery'])) {
            return Response::error('404');
        }
    }

    /**
     * Render Photos Manage Gallery page
     */
    public function get_index()
    {
        return View::make('photos::admin.manage.manage_gallery', $this->data);
    }

}