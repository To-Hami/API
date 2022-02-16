<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\postRrsorce;
use App\Models\post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class apiController extends Controller
{
    use apiResponseTrait;

    public function index()
    {
        return response(User::all());
    }


    /************************  show all posts   *********************************/


    public function posts()
    {
        $posts = postRrsorce::collection(post::paginate(10));
        return $this->apiResponse($posts, null, 201);
    }

    /*******************************  show post by id   *****************************/


    public function show($id)
    {
        $posts = post::find($id);
        if (!$posts) {
            return $this->notFoundResponse();
        }
        $posts = new postRrsorce(post::find($id));

        return $this->apiResponse($posts, null, 201);
    }


    /*********************************  add new posts   **********************************/


    public function addPosts(Request $request)
    {

//        if(!$request->has('title') && $request->get('title') == ''){
//            return $this->apiResponse(null, 'title not found', 422);
//        }
//        if(!$request->has('body') && $request->get('body') == ''){
//            return $this->apiResponse(null, 'body not found', 422);
//        }



      $validation =   $this->apiValidation($request, [
            'title' => 'required|min:3|max:100',
            'body' => 'required|min:3|max:500',
        ]);
        if($validation instanceof Response){
            return  $validation;
        }

        $newPost = post::create($request->all());

        return $this->apiResponse(new postRrsorce($newPost, null, 201));
    }


    /*********************************  update  post   **********************************/


    public function updatePost($id, Request $request)
    {

//        if(!$request->has('title') && $request->get('title') == ''){
//            return $this->apiResponse(null, 'title not found', 422);
//        }
//        if(!$request->has('body') && $request->get('body') == ''){
//            return $this->apiResponse(null, 'body not found', 422);
//        }


        $post = post::find($id);
        if (!$post) {
            return $this->notFoundResponse();
        }

        $validation =   $this->apiValidation($request, [
            'title' => 'required|min:3|max:100',
            'body' => 'required|min:3|max:500',
        ]);
        if($validation instanceof Response){
            return  $validation;
        }

        $post->update($request->all());
        $post = new postRrsorce($post);
        return $this->apiResponse($post, null, 201);
    }



    /*******************************  delete post by id   *****************************/


    public function delete($id)
    {
        $posts = post::find($id);
        if (!$posts) {
            return $this->notFoundResponse();
        }
        $posts =$posts->delete();

        return $this->apiResponse('Deleted Done', null, 201);
    }


}
