<?php
class RekordExploreController{


    public function get(){
       
            $data = [];
            $i = 0;


            $albums = new RekordAlbumsController();
            $tracks = new RekordTracksController();
            $artists = new RekordArtistsController();


            $sections =  get_field('home_screen_sections', 'option');

            foreach($sections as $section){
                $postPerPage = $section['r_number_of_post'];


                $data[$i]['title'] = $section['title'];
                $data[$i]['image'] = $section['image'];
                $data[$i]['filter'] =$section['filter'];
                $data[$i]['categories'] =$section['categories'];
                

                $postType = $section['r_post_type'];
              
                

              
                $args = array(
                    'posts_per_page'  => $postPerPage,
                    //'offset'          => $postOffset,
                    'post_type'       =>  $postType,
                
                );

                
                /** 
                 * Add Terms
                 * 
                */
                // $terms =  $section['r_category'];
                // if(!empty($terms)){
                //     $data[$i]['terms']  = $terms->slug;
                //     $args['tax_query'] = array(
                //         array(
                //             'taxonomy' => $postType.'-categories',
                //             'field'    => 'slug',
                //             'terms'    => $terms,
                //         ),
                //     );
                // }



                // $posts = get_posts($args);
                
                // if($section['r_post_type'] == 'album'){
                
                //     $data[$i]['albums'] =  $albums->data($posts);
                // }
                
                // if($section['r_post_type'] == 'track'){
                //     $data[$i]['tracks'] =$tracks->data($posts);
                // }

                // if($section['r_post_type'] == 'artist'){
                //     $data[$i]['artists'] =$artists->data($posts);
                // }


                //$data['sections'][$i] = $section['r_post_type'];	

                $i++;
            }


            return [
                'data' => $data,
                'status' => 200
            ];
    }
    
        
}


