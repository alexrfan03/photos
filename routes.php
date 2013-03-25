<?php

use Photos\Models\Photo;
use Photos\Models\Gallery;

Route::get('(:bundle)/(:any)', function ($slug) {
    $slug = trim(urldecode($slug), '\ /');
    $data['gallery'] = Gallery::with('photos')->where_slug($slug)
                                              ->where_published(1)
                                              ->first();
    if (is_null($data['gallery'])) {
        return Response::error('404');
    }
    // Theme
    $theme = IoC::resolve('Theme');
    $theme->set_theme(Config::get('theme.active'));
    $theme->set_layout('galleries');
    $theme->title($data['gallery']->name . ' - ' . Config::get('photos.list_page_title', 'Galleries'));
    return $theme->render('photos::galleries.view', $data);
});

Route::get('(:bundle)', function () {
    $data['galleries'] = Gallery::with('photos')->where_published(1)
                                                ->order_by('name', 'asc')
                                                ->get();
    // Theme
    $theme = IoC::resolve('Theme');
    $theme->set_theme(Config::get('theme.active'));
    $theme->set_layout('galleries');
    $theme->title(Config::get('photos.list_page_title', 'Galleries'));
    return $theme->render('photos::galleries.list', $data);
});