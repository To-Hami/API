<?php
namespace App\Http\Controllers\api;


use Illuminate\Support\Facades\Validator;

Trait apiResponseTrait{
     public  function apiResponse ($data=null,$error=null,$status=200){
        $array =[
            'data' => $data,
            'error' => $error,
            'status' => in_array($status,$this-> successCode()) ? true : false,

        ];
        return response($array);



     }


     public  function successCode(){
         return [ 200,201,202];
     }

     public  function  notFoundResponse(){
         return $this->apiResponse(null, 'no found response !', 404);

     }

     /****************************  validation ************************************/


     public function apiValidation ($request ,$array){
         $validate = Validator::make($request->all(),$array);
         if ($validate->fails()) {
             return $this->apiResponse(null, $validate->errors(), 404);
         }
     }

}
