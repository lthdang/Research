<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    function list()
    {
        return Blog::all();
    }

    function add(Request $request)
    {
        $blog = new Blog();
        $blog->title = $request->title;
        $blog->body = $request->body;
        $request = $blog->save();
        if($request){
            return ["Result" => "Data has been saved"];
        }else{
            return ["Result" => "Operation failed"];
        }

    }

    /**
     * Update the specified resource in storage.
     */
    function update(Request $request, $id)
    {
        $blog = Blog::find($id);
        $blog->title = $request->title;
        $blog->body = $request->body;
        $result =$blog->save();
        if($result){
            return["Result"=>"data has been updated"];
        }
        else{
            return["Result"=>"update operation has been failed"];
        }
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::latest()->paginate(10);
        return [
            "status" => 1,
            "data" => $blogs
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $blog = Blog::create($request->all());
        return [
            "status" => 1,
            "data" => $blog
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return [
            "status" => 1,
            "data" => $blog
        ];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        //
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return [
            "status" => 1,
            "data" => $blog,
            "msg" => "Blog deleted successfully"
        ];
    }


    public function saveuser(){
        $records=Storage::json('/public/users.json');
        foreach( $records as $record){
            $user=new User;
            $user->id=$record['id'];
            $user->name=$record['name'];
            $user->email=$record['email'];
            $user->password=bcrypt(Str::password());
            $user->save();
        }

        return 'user created succesfully';

    }
}
