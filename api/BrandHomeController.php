<?php
class BrandHomeController{


    public function get(){
       
            $data = [];

            $sd = [];
            $i = 0;


            $sections =  get_field('home_screen_sections', 'option');

            foreach($sections as $section){
                $sd[$i]['title'] = $section['title'];
                $sd[$i]['image'] = $section['image'];
                $sd[$i]['filter'] =$section['filter'];
                $sd[$i]['categories'] =$section['categories'];

                $sd[$i]['type'] =$section['type'];
                $i++;


                if($section['type'] == 'product' ){
                    $sd[$i]['products'] = $this->getPosts($section);

                }



        
            }


            $data['categories'] =  get_field('filter_categories', 'option');;
            $data['sections'] = $sd;


            return  $data;
    }
    



    public function getPosts($section){
        
        $args = array(
            'posts_per_page'  => $section['posts_per_page'],
            //'offset'          => $postOffset,
           /// 'post_type'       => 'products',
        );

        
        /** 
         * Add Terms
         * 
        */
        // $terms =  $section['category'];
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



        //$posts = get_posts($args);
    
        $products_query = wc_get_products($args);
        $products = array();
        foreach ( $products_query as $product ) {

            $products[] = $product->get_data();
        }

        return $products;

    }
        
}


