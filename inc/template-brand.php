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

</style>


  <div class="mokup">
    <div class="marvel-device note8 shadow-lg rounded-lg">
      <div class="screen">
        <ons-page>
          <ons-tabbar swipeable position="auto">
            <ons-tab page="tab1.html" icon="md-home" active>
            </ons-tab>
            <ons-tab page="tab2.html" icon="md-search">
            </ons-tab>
            <ons-tab page="tab3.html" icon="md-settings">
            </ons-tab>
          </ons-tabbar>
        </ons-page>

      <?php
      $home_logo =  get_field('app_home_logo', 'option');
      $cats =  get_field('filter_categories', 'option'); ?>
      
      <template id="tab1.html">
        <ons-page id="Tab1" class="cta filter" >
          <ons-toolbar class="scafold">
            <div class="center">
              <?php if($home_logo) : ?>
                <img class="brand-home-logo" src="<?php echo $home_logo; ?>" alt=""  />
              <?php endif; ?>
              </div>
              <div class="right">
                <ons-select id="choose-sel">
                <option value="all" data-filter="all">All</option>
                <?php foreach($cats as $cat): ?>
                  <option 
                    value="brand-section-<?php echo $cat->term_id; ?>" 
                    data-filter="brand-section-<?php echo $cat->term_id; ?>"
                  >
                  <?php echo $cat->name; ?>
                </option>
                <?php endforeach; ?>
              </ons-select>
            </div>
          </ons-toolbar>
          <div class="cta filter has-toolbar scafold">
            <div class="boxes">
              <?php  dynamic_sidebar('home_screen'); ?>
            </div>
          </div>
        </ons-page>
      </template>

      <template id="tab2.html">
        <ons-page id="Tab2">
        <?php  dynamic_sidebar('search_screen'); ?>
        </ons-page>
      </template>


      <template id="tab3.html">
        <ons-page id="Tab3">
        </ons-page>
      </template>

      </div>
    </div>
  </div>

<?php







wp_footer();
