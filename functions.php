<?php

define('ASSET_VERSION', date('Ymdh'));


$path = get_stylesheet_directory() . "/includes/functions/";
if (file_exists($path)) {
    foreach (new DirectoryIterator($path) as $f) {
        if ($f->isDot() || $f->isDir()) continue;
        locate_template( 'includes/functions/' . $f->getFilename(), true, true );
    }
}

$path = get_stylesheet_directory() . "/includes/post-types/";
if (file_exists($path)) {
    foreach (new DirectoryIterator($path) as $f) {
        if ($f->isDot() || $f->isDir()) continue;
        locate_template('includes/post-types/' . $f->getFilename(), true, true);
    }
}

$path = get_stylesheet_directory() . "/includes/custom-fields/";
if (file_exists($path)) {
    foreach (new DirectoryIterator($path) as $f) {
        if ($f->isDot() || $f->isDir()) continue;
        locate_template('includes/custom-fields/' . $f->getFilename(), true, true);
    }
}

$path = get_stylesheet_directory() . "/includes/widgets/";
if (file_exists($path)) {
    foreach (new DirectoryIterator($path) as $f) {
        if ($f->isDot() || $f->isDir()) continue;
        locate_template('includes/widgets/' . $f->getFilename(), true, true);
    }
}

$path = get_stylesheet_directory() . "/includes/shortcodes/";
if (file_exists($path)) {
    foreach (new DirectoryIterator($path) as $f) {
        if ($f->isDot() || $f->isDir()) continue;
        locate_template('includes/shortcodes/' . $f->getFilename(), true, true);
    }
}