<?php

function animalia_post_types() {

  register_post_type('event', array(
  'supports' => array('title', 'editor', 'excerpt'),
  'rewrite' => array('slug' => 'events'),
  'has_archive' => true,
  'public' => true,
  'labels' => array(
    'name' => 'Events',
    'add_new_item' => 'Add New Event',
    'edit_item' => 'Edit Event',
    'all_items' => 'All Events',
    'singular_name' => 'Event'
  ),
  'menu_icon' => 'dashicons-calendar'
));

  register_post_type('campus', array(
    'supports' => array('title', 'editor', 'excerpt'),
    'rewrite' => array('slug' => 'campuses'),
    'has_archive' => true,
    'public' => true,
    'labels' => array(
      'name' => 'Campuses',
      'add_new_item' => 'Add new Campus',
      'edit_item' => 'Edit Campus',
      'singular_name' => 'Campus'
    ),
     'menu_icon' => 'dashicons-location-alt'
  ));



  // Program Post Type
  register_post_type('course', array(
    'supports' => array('title', 'editor'),
    'rewrite' => array('slug' => 'courses'),
    'has_archive' => true,
    'public' => true,
    'labels' => array(
      'name' => 'Courses',
      'add_new_item' => 'Add New course',
      'edit_item' => 'Edit course',
      'all_items' => 'All courses',
      'singular_name' => 'course'
    ),
    'menu_icon' => 'dashicons-awards'
  ));


  // tutor Post Type
  register_post_type('tutor', array(
    'show_inrest' => true,
    'supports' => array('title', 'editor', 'thumbnail'),
    'public' => true,
    'labels' => array(
      'name' => 'Tutors',
      'add_new_item' => 'Add New tutor',
      'edit_item' => 'Edit tutor',
      'all_items' => 'All tutors',
      'singular_name' => 'tutor'
    ),
    'menu_icon' => 'dashicons-welcome-learn-more'
  ));

}

add_action('init', 'animalia_post_types');
