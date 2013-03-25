<?php

use Photos\Models\Gallery;

/**
 * Photo gallery admin controller
 */
class Photos_Admin_Gallery_Controller extends Photos_Admin_Base_Controller {

    /**
     * Generate Gallery create form
     */
    public function get_create()
    {
        return View::make('photos::admin.gallery.create', $this->data);
    }

    /**
     * Gallery create form POST handler
     */
    public function post_create()
    {
        // Validation rules
        $rules = array(
            'name' => 'required|max:100',
        );
        // Prepare validation
        $validation = Validator::make(Input::all(), $rules);
        // Run validation
        if($validation->fails()) {
            return Redirect::to(URL::current())->with_errors($validation)
                                               ->with_input();
        } else {
            // Validation passed. Create page
            $gallery = new Gallery(array(
                'name' => trim(strip_tags(Input::get('name'))),
                'slug' => trim(Str::slug(Input::get('name'))),
                'published' => (is_null(Input::get('published')) ? 0 : 1),
            ));
            $insert = $gallery->save();
            if ($insert) {
                return Redirect::to_action('admin::photos')
                ->with('success', 'Successfully created gallery: '
                       . Input::get('name'));
            } else {
                return redirect::to(URL::current())
                ->with('error', 'Unable to create gallery');
            }
        }
    }

    /**
     * Gallery edit page form
     */
    public function get_edit()
    {
        $id = trim(urldecode(Input::get('id')));
        $gallery = Gallery::find($id);
        if (is_null($gallery)) {
            return Response::error('404');
        }
        $this->data['gallery'] = $gallery;
        return View::make('photos::admin.gallery.edit', $this->data);
    }


    /**
     * Gallery edit page POST handler
     */
    public function post_edit()
    {
        $full_url = URL::current() . '/' . Input::get('id');
        $name = trim(strip_tags(Input::get('name')));
        // Validation rules
        $rules = array(
            'name' => 'required|max:100',
            );
        // Prepare validation
        $validation = Validator::make(Input::all(), $rules);
        // Run validation
        if($validation->fails()) {
            return Redirect::to($full_url)->with_errors($validation)
                ->with_input();
        } else {
            // Validation passed. Update gallery
            $gallery = Gallery::find(Input::get('id'));
            // Check if gallery is valid
            if (is_null($gallery)) {
                return Redirect::to_action('admin::photos')
                    ->with('error', 'Invalid gallery specified');
            }
            // Now update gallery
            if ($gallery->name !== $name) {
                $gallery->name = $name;
                $gallery->slug = Str::slug($name);
            }
            $gallery->description = trim(Input::get('description'));
            $gallery->published = (is_null(Input::get('published')) ? 0 : 1);
            $update = $gallery->save();
            // Check if update was successful
            if ($update) {
                return Redirect::to_action('admin::photos')
                    ->with('success', 'Successfully updated gallery: '
                           . Input::get('name'));
            } else {
                return redirect::to($full_url)
                    ->with('error', 'Unable to update gallery');
            }
        }
    }
    
}
