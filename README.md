Photo Gallery for Laravel
=========================

This bundle provides photo galleries with image upload for Laravel 3
with the
[Admin Framework](https://github.com/CodeBinders/admin-framework).

Features
--------

- Create multiple galleries. Each gallery will hold multiple images.
- Support for multiple image upload simultaneously.
- Integration with Themes bundle to create thumbnailed-list of
  galleries
- Integration with Admin Framework to make it easy to create/edit
  galleries andupload photos
- Support for thumbnail generation and thumbnail display using Twitter
  Bootstrap.
- Support for theming slideshows with choice of modal box,
  e.g. Colorbox, Lightbox etc.

Requirements
------------

- [Admin Framework](https://github.com/CodeBinders/admin-framework)
- [Themes Bundle](https://github.com/kaustavdm/Laravel_Theme_Bundle) -
  preferably use this fork.
- [Resizer Bundle](https://github.com/maikeldaloo/Resizer)
- Laravel 3

Installation
------------

- Git clone or copy the bundle to Laravel's `bundles` directory:

  ```sh
  $ git clone git@github.com:CodeBinders/photos.git
  ```

- Edit `application/bundles.php` and register Photos bundle. Use your
  preference as the `'handles'` value, e.g.:

  ```php
  'photos' => array('handles' => 'photos'),
  ```

- Run migrations. Run this command in Laravel's project directory:

  ```sh
  php artisan migrate:photos
  ```

- Generate permissions for Photos

  ```sh
  php artisan photos::generate
  ```

- Publish bundle assets

  ```sh
  php artisan bundle:publish photos
  ```

- Implement a theme based on the Theme bundle. The theme should
  implement a layout called `galleries`. For example of the layout see `examples/layouts/`
  directory.

- If a `theme.php` config file is not already present in Laravel's `application/config/`
  directory, copy `config/theme.php` to Laravel's
  `application/config/` directory and set your default theme.

- If a `photo.php` config file is not already present in Laravel's
  `application/config/` directory, copy `config/photo.php` to
  Laravel's`application/config/` directory and set the value of
  `list_page_title`.

License
-------

Released under the terms of the GNU General Public License v3+. For
full license text see: http://www.gnu.org/licenses/gpl.txt
