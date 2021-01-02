<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ToDo;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ToDoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth:api');
    }

    public function index()
    {
        $loginUser = "";
        if (Auth::check()) {
            $loginUser = Auth::user();
            Log::alert('------------------------->'.$loginUser);
        }
        else {
            Log::alert('------------------------->1111'.Auth::user());
        }

        $todos = ToDo::latest()->where('user_id', '=', 1)->paginate(10);
        
        
        return $todos;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                "title" => ["required"],
                "description" => ["required"]
            ]
        );

        if ($validator->fails()) {
            return [
                "status" => false,
                "errors" => $validator->messages()
            ];
        }

        ToDo::create([
            'user_id' => 1,
            'title'=> $request['title'],
            'description'=> $request['description'],
        ]);

        return response()->json(['status' => true]);

    }
}
