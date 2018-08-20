<?php
get_header();

while(have_posts()) {
  the_post();
  pageBanner();
  ?>

  <div class="container container--narrow page-section">
    <div class="breadcrumbs">
      <p><a href="<?php echo get_post_type_archive_link('course'); ?>"><i class="fa fa-home" aria-hidden="true"></i> All Courses</a> <span> / <?php the_title(); ?></span></p>
    </div>
    <div class="generic-content"><?php the_content(); ?></div>

    <?php
    $relatedTutors = new WP_Query(array(
      'posts_per_page' => -1,
      'post_type' => 'tutor',
      'orderby' => 'title',
      'order' => 'ASC',
      'meta_query' => array(
        array(
          'key' => 'related_courses',
          'compare' => 'LIKE',
          'value' => '"' . get_the_ID() . '"'
        )
      )
    ));

    if ($relatedTutors->have_posts()) {
      echo '<hr class="section-break">';
      echo '<h2 class="headline mb-3">' . get_the_title() . '  is run by </h2>';

      echo '<ul class="tutor-cards">';
      while($relatedTutors->have_posts()) {
        $relatedTutors->the_post(); ?>
        <li class="tutor-card__list-item">
          <a class="tutor-card" href="<?php the_permalink(); ?>">
            <img class="tutor-card__image" src="<?php the_post_thumbnail_url('tutorLandscape') ?>">
            <span class="tutor-card__name"><?php the_title(); ?></span>
          </a>
        </li>
      <?php }
      echo '</ul>';
    }

    wp_reset_postdata();

    $today = date('Ymd');
    $homepageEvents = new WP_Query(array(
      'posts_per_page' => 2,
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
        ),
        array(
          'key' => 'related_courses',
          'compare' => 'LIKE',
          'value' => '"' . get_the_ID() . '"'
        )
      )
    ));

    if ($homepageEvents->have_posts()) {
      echo '<hr class="section-break">';
      echo '<h2 class="headline mb-3">Upcoming ' . get_the_title() . ' events</h2>';

      while($homepageEvents->have_posts()) {
        $homepageEvents->the_post();
        get_template_part('template-parts/content-event');
      }
    }

    wp_reset_postdata();
    $relatedCampuses = get_field('related_campus');

    if ($relatedCampuses) {
      echo '<hr class="section-break">';
      echo '<h2 class="headline">' . get_the_title() . ' is available at:</h2>';

      echo '<ul class="min-list link-list">';
      foreach($relatedCampuses as $campus) {
        ?> <li><a href="<?php echo get_the_permalink($campus); ?>"><?php echo get_the_title($campus) ?></a></li> <?php
      }
      echo '</ul>';
    }
    ?>
  </div>

<?php }
get_footer();
?>
