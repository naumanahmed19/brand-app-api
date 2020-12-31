<?php

class BrandUserController{


    public function get($id){
        $user  = get_userdata($id);
      
        $data['id'] =$user->ID;
        $data['email'] = $user->user_email;
        $data['firstName'] = $user->first_name;
        $data['lastName'] = $user->last_name;
        $data['avatar'] =get_avatar_url( $current_user->ID, 64 ) ; 
      //  $data['roles'] = (array ) $user->roles ; 

        //return $data;

        return $data;

    }
    public function update($request){

         global $current_user;
    //    return  $current_user;


        $request['ID'] = $current_user->ID;
        wp_update_user($request); 

       return [
        'data' => $this->get($current_user->ID),
        'status' => 200
    ];
    }
}