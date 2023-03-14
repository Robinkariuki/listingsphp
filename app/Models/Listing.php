<?php
    namespace App\Models;

    class Listing {

        public static function all(){

            return [
        [
            'id'=>1,
            'title'=>'listing one',
            'description'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod quo velit blanditiis optio voluptates, et at, consequatur qui ad, rem sed provident! Sapiente quidem eius, culpa ipsa voluptatem aut impedit.',
            
        ],
        [
            'id'=>2,
            'title'=>'listing two',
            'description'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod quo velit blanditiis optio voluptates, et at, consequatur qui ad, rem sed provident! Sapiente quidem eius, culpa ipsa voluptatem aut impedit.',
            
        ]
        ];


        }



        public static function  find($id){
            $listings = self::all();

            foreach($listings as $listing){
                if($listing['id'] == $id){
                    return $listing;
                }
            }

        }

    

    }




