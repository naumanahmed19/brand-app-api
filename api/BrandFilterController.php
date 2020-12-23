<?php
class BrandFilterController{

    public function get(){
       
            $data = [];

            $attr = [];

            $terms = [
                'Colors'=>'pa_color',
                'Pattern'=>'pa_pattern',
                'Size'=>'pa_size',
            ];

            foreach($terms as $key=>$term){
                if(term_exists($term)){
                    $attr[] =  $this->getSection($key,$term);
                }
            }
            $data['sections'] = $attr;
            
            return  $data;
    }

    private function getSection($title,$term){
        $attr = [];
        $attr['title'] = $title;
        $attr['categories'] =  get_terms($term);
        
        return $attr;
    }
    
        
}


