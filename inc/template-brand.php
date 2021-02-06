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
<!-- <style>
.mokup {
	display: flex;
	flex: 1;
  background: #191e24;
	justify-content: center;
	align-items: center;
  flex-direction: row-reverse;
  
  height: 100vh;

}

</style> -->


<div class="flex flex-wrap -mx-2 overflow-hidden sm:-mx-3">
  <div class="my-2 px-2 w-1/3 overflow-hidden sm:my-3 sm:px-3 sm:w-full">
    <div class="bg-white p-3 rounder-3">
         <?php  dynamic_sidebar('home_screen'); ?>
    </div>
  </div>
</div>
<?php







wp_footer();
