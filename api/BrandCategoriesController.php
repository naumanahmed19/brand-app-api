<?php
class BrandCategoriesController{


    public function get(){
       
            $data = [];

            $sd = [];
            $i = 0;


            $sections =  get_field('quick_menu', 'option');

            foreach($sections as $section){
                $sd[$i]['title'] = $section['title'];
                $sd[$i]['categories'] =$section['categories'];
                $i++;
            }


           // $data['categories'] =  get_field('filter_categories', 'option');;
            $data['sections'] = $sd;

            

            return  $data;
    }
    
        
}


