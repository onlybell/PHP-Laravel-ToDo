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
    protected $user_id;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
        
    }

    public function index()
    {
        $this->user_id = Auth::id();

        $todos = ToDo::latest()->where('user_id', '=', $this->user_id)->paginate(10);
        
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
        $this->user_id = Auth::id();

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

        $todo = ToDo::create([
            'user_id' => $this->user_id,
            'title'=> $request['title'],
            'description'=> $request['description'],
            'due_at'=> $request['due_at'],
        ]);

        return response()->json(['status' => true]);
    }
}
