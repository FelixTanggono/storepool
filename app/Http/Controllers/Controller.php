<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function retrievePages(String $role)
    {

        $pages = []  ; 
       
        if(!strcmp($role , 'admin')){
            $pages = [['name'=>'View All Shoe' , 'url' =>'/home'] , 
            ['name'=>'Add Shoe' , 'url' =>'/addShoe'] , 
            ['name'=>'View Transaction' , 'url' =>'/transaction']] ; 
        }else if(!strcmp($role , 'member')){
            $pages = [['name'=>'View All Shoe' , 'url' =>'/home'] , 
            ['name'=>'View Cart' , 'url' =>'/cart'] , 
            ['name'=>'View Transaction' , 'url' =>'/transaction']] ; 
        }else{
            $pages = [['name'=>'View All Shoe' , 'url' =>'/home']] ; 

        }

        

        return $pages;
    }
}
