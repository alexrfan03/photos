<?php

use Photos\Models\Gallery;

class Photos_Admin_Home_Controller extends Photos_Admin_Base_Controller {

    public function get_index()
    {
        $this->data['search'] = true;
        $this->data['q'] = trim(strip_tags(urldecode(Input::get('q'))));
        $this->data['galleries'] = Gallery::with('photos')
        ->where('name', 'LIKE', '%' . $this->data['q'] . '%')
        ->order_by('updated_at', 'desc')
        ->paginate(10);
        return View::make('photos::admin.home.list', $this->data);
    }

}