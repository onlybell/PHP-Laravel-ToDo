<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ToDo;
use App\Models\User;

use Illuminate\Http\Request;
use Auth;
use Log;
use Validator;

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
        $loginUser = Auth::user();

        // $user = Auth::user();

        Log::alert('------------------------->'.$loginUser);

        // dd(
        //     auth()->id() ?? '?',
        //     Auth::id() ?? '?',
        //     $request->user()->id ?? '?',
        //     auth()->check(),
        //     get_class(auth()->guard())
        // );
        
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
                "description" => ["required"],
                "due_at" => ["required"]
            ]
        );

        if ($validator->fails()) {
            return [
                "status" => false,
                "errors" => $validator->messages()
            ];
        }

        $id = $request->user()->id;

        ToDo::create([
            'user_id' => $id,
            'title'=> $request['title'],
            'description'=> $request['description'],
            'due_at'=> $request['due_at'],
        ]);

        return response()->json(['status' => true]);
    }
}
