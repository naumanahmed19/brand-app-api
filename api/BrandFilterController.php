<?php
class BrandCategoriesController{


    public function get(){
       
            $data = [];

            // $sd = [];
            // $i = 0;


            // $sections =  get_field('quick_menu', 'option');

            // foreach($sections as $section){
            //     $sd[$i]['title'] = $section['title'];
            //     $sd[$i]['categories'] =$section['categories'];
            //     $i++;
            // }


           // $data['categories'] =  get_field('filter_categories', 'option');;
            $data['colors'] =-$terms = get_terms( 'pa_color' );
            $data['pattern'] =-$terms = get_terms( 'pa_pattern' );
            $data['size'] =-$terms = get_terms( 'pa_size' );

            

            return  $data;
    }
    
        
}


