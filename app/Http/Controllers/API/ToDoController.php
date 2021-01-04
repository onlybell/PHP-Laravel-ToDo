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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }
    
    /**
     * Update to complete type of the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateCompleted($id)
    {

    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $todo = Todo::find($id);

        $todo->delete();

        return response()->json(['status' => true]);
    }

}
