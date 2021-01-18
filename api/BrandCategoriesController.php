<?php
class BrandCategoriesController{


    public function get(){
        $data = [];
        $ctrl = new BrandHomeController();
        $data['sections'] =  $ctrl->getWidgets('brand-search-screen');

        return   $data;
    }



     
}


