<?php

/**
 * Base Admin controller for Photos
 */

class Photos_Admin_Base_Controller extends Admin_Base_Auth_Controller {

    public function __construct ()
    {
        parent::__construct();
        Event::listen('admin.tabs', function (&$admin_tabs) {
            $tab_items = array(
                array('Manage Galleries', 'admin::photos'),
                array('Create Gallery', 'admin::photos.gallery.create'),
            );
            foreach($tab_items as $row) {
                $admin_tabs->add($row);
            }
        });
    }

}