<?php

use Photos\Models\Gallery;
use Photos\Models\Photo;

/**
 * Upload photos from pluploader 
 */
class Photos_Admin_Upload_Controller extends Photos_Admin_Base_Controller {

    /**
     * Respond to POST request only
     *
     * Error messages are very vague. Need to improve them if
     * possible.
     */
    public function post_do_upload()
    {
        $gallery_id = trim(strip_tags(urldecode(Input::get('gallery_id'))));
        $gallery = Gallery::find($gallery_id);
        if (is_null($gallery)) {
            return Response::error('500');
        }
        // Generate filename
        $img_filename = sha1($gallery->name . Input::get('name')) . '.' . File::extension(Input::get('name'));
        // Move uploaded photo to a permanent location
        $img = Input::file('image');
        // Create dirs if they don't exist
        $img_dir = path('public') . 'uploads' . DS . 'photos' . DS . $gallery->slug;
        $img_thumb_dir = $img_dir . DS . 'thumbs';
        if ( ! is_dir($img_dir)) {
            mkdir($img_dir, 0775, true);
        }
        if ( ! is_dir($img_thumb_dir)) {
            mkdir($img_thumb_dir, 0775, true);
        }
        // Resize uploaded image
        Bundle::start('resizer');
        $thumb_upload = Resizer::open($img)
        ->resize(200, 200, 'crop')
        ->save($img_thumb_dir . DS . $img_filename, 90);
        // Upload original image
        $img_upload = Input::upload('image', $img_dir, $img_filename);
        // Check image uploads
        if($thumb_upload === false and $img_upload === false) {
            return Response::error('500');
        }
        // Register photo with gallery
        $photo = new Photo(array('filename' => $img_filename));
        $gallery->photos()->insert($photo);
        exit(json_encode(array('filename' => $img_filename)));
    }

}
