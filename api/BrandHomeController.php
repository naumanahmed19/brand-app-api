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
                $i++;
            }


            $data['categories'] =  get_field('filter_categories', 'option');;
            $data['sections'] = $sd;

            return [
             'data' => $data,
             'status' => 200
         ];
    }
    
        
}


