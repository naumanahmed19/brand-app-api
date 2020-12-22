<?php
class BrandFilterController{

    public function get(){
       
            $data = [];

           // $data['categories'] =  get_field('filter_categories', 'option');;
            $data['colors'] =  get_terms( 'pa_color' );
            $data['pattern'] = get_terms( 'pa_pattern');
            $data['size'] = get_terms( 'pa_size' );

            

            return  $data;
    }
    
        
}


