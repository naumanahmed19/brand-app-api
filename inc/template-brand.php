<?php
/**
 * Template Name: Brand App
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0
 */

wp_head();

?>
<script>
document.addEventListener('prechange', function(event) {
  document.querySelector('ons-toolbar .center')
    .innerHTML = event.tabItem.getAttribute('label');
});
</script>
<style>
.mokup {
	display: flex;
	flex: 1;
  background: #191e24;
	justify-content: center;
	align-items: center;
  flex-direction: row-reverse;
  
  height: 100vh;

}
.src{
  display: none;
}

</style>


<div class="mokup">
<div class="marvel-device note8 shadow-lg rounded-lg">
    <div class="screen">

    <div class="src home_screen">
         <?php  dynamic_sidebar('home_screen'); ?>
      </div>
      <div class="src search_screen">
        <?php  dynamic_sidebar('search_screen'); ?>
      </div>
      <div class="src settings_screen">
        <?php  dynamic_sidebar('settings_screen'); ?>
      </div>

    </div>
    
</div>
</div>

<?php







wp_footer();
