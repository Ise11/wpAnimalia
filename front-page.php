<?php get_header(); ?>
<div class="jumbotron jumbotron--front-page mb-0">
  <div class="text-center my-3  text-white">
    <h1 class="headline headline--large">Welcome!</h1>
    <h2 class="headline headline--small">Do you want to learn about animals behavior?</h2>
    <a href="<?php echo get_post_type_archive_link('course'); ?>" class="btn btn-lg btn-dark">Find course</a>
  </div>
</div>

<div class="row">
  <div class="col-12 bg-dark text-center py-3">
    <h2 class="align-middle text-white">Upcoming events</h2>
  </div>
  <div class="col-12">
    <div class="container container--narrow pt-5">
      <?php
      $today = date('Ymd');
      $homepageEvents = new WP_Query(array(
        'posts_per_page' => 3,
        'post_type' => 'event',
        'meta_key' => 'event_date',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
        'meta_query' => array(
          array(
            'key' => 'event_date',
            'compare' => '>=',
            'value' => $today,
            'type' => 'numeric'
          )
        )
      ));

      while($homepageEvents->have_posts()) {
        $homepageEvents->the_post();
        get_template_part('template-parts/content', 'event');
      }
      ?>
    </div>
  </div>

</div>
<p class="t-center mb-5"><a href="<?php echo get_post_type_archive_link('event') ?>" class="btn btn-dark">View All Events</a></p>


<div class="col-12 bg-dark text-center py-3 mb-5">
  <h2 class="align-middle text-white">New articles</h2>
</div>
<div class="container py-5">
  <div class="row y-5">
    <?php
    $homepagePosts = new WP_Query(array(
      'posts_per_page' => 3
    ));

    while ($homepagePosts->have_posts()) {
      $homepagePosts->the_post(); ?>
      <div class="col-md-4">
        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

        <p><?php if (has_excerpt()) {
          echo get_the_excerpt();
        } else {
          echo wp_trim_words(get_the_content(), 40);
        } ?> <a href="<?php the_permalink(); ?>" class="nu gray">Read more</a></p>
      </div>
    <?php } wp_reset_postdata();
    ?>

  </div>
  <p class="t-center my-5"><a href="<?php echo site_url('/index.php/blog'); ?>" class="btn btn-dark">View All Blog Posts</a></p>

</div>

<?php get_footer();

?>
