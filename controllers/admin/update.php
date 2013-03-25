<?php

use Photos\Models\Gallery;
use Photos\Models\Photo;

/**
 * Update (or delete) photos
 */
class Photos_Admin_Update_Controller extends Photos_Admin_Base_Controller {

    /**
     * Render Photos Manage Gallery page
     */
    public function get_delete_photo()
    {
        $id = trim(urldecode(Input::get('id')));
        $photo = Photo::find($id);
        if (is_null($photo)) {
            return Response::error('404');
        }
        $gallery = $photo->gallery;
        $img_dir = path('public') . 'uploads' . DS . 'photos' . DS . $gallery->slug;
        $img_thumb_dir = $img_dir . DS . 'thumbs';
        // Delete files
        File::delete($img_dir . DS . $photo->filename);
        File::delete($img_thumb_dir . DS . $photo->filename);
        // Delete the photo model
        $photo->delete();
        if (Request::ajax()) {
            exit(json_encode(true));
        } else {
            return Redirect::to_action('admin::photos.manage_gallery' . '?id=' . $gallery->id)
            ->with('success', 'Photo deleted');;
        }
    }

    /**
     * Render Photos Manage Gallery page
     */
    public function get_delete_gallery()
    {
        $id = trim(urldecode(Input::get('id')));
        $gallery = Gallery::with('photos')->find($id);
        if (is_null($gallery)) {
            return Response::error('404');
        }
        if (count($gallery->photos) > 0) {
            return Redirect::to_action('admin::photos.manage_gallery' . '?id=' . $gallery->id)
            ->with('error', 'Gallery has images and cannot be deleted. Try unpublishing.');
        }
        $name = $gallery->name;
        // Delete the photo model
        $gallery->delete();
        return Redirect::to_action('admin::photos')
        ->with('success', 'Deleted gallery "' . $name . '"');
    }

    /**
     * Render Photos Manage Gallery page
     */
    public function post_update_photo()
    {
        $id = trim(urldecode(Input::get('id')));
        $photo = Photo::find($id);
        if (is_null($photo)) {
            return Response::error('404');
        }
        $gallery = $photo->gallery;
        $photo->caption = trim(strip_tags(urldecode(Input::get('caption'))));
        $photo->description = trim(strip_tags(urldecode(Input::get('description'))));
        $photo->save();
        // Response
        if (Request::ajax()) {
            exit(json_encode(true));
        } else {
            return Redirect::to_action('admin::photos.manage_gallery' . '?id=' . $gallery->id)
            ->with('success', 'Photo updated');;
        }
    }

}
