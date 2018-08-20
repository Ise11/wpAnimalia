<?php
get_header();

while(have_posts()) {
  the_post();
  pageBanner();
  ?>

  <div class="container container--narrow page-section">
    <div class="breadcrumbs">
      <p><a href="<?php echo get_post_type_archive_link('event'); ?>"><i class="fa fa-home" aria-hidden="true"></i> Events Home</a> / <span><?php the_title(); ?></span></p>
    </div>
    <div class="generic-content"><?php the_content(); ?></div>

    <?php
    $relatedPrograms = get_field('related_courses');
    if ($relatedPrograms) {
      echo '<hr class="section-break">';
      echo '<h2 class="headline">Related Program</h2>';
      echo '<ul class="link-list min-list">';
      foreach($relatedPrograms as $program) { ?>
        <li><a href="<?php echo get_the_permalink($program); ?>"><?php echo get_the_title($program); ?></a></li>
      <?php }
      echo '</ul>';
    }
    ?>
  </div>

<?php }
get_footer();
?>
