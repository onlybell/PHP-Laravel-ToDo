<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ToDo;
use App\Models\User;

use Illuminate\Http\Request;
use Auth;
use Log;
use Validator;

class ToDoController extends BaseController
{
    protected $user_id = '';
    protected $todo = '';
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
    public function dashboard()
    {
        $this->user_id = Auth::id();

        $todos = ToDo::select()
                    ->where('user_id', '=', $this->user_id)
                    ->get();
        $totalCount = $todos->count();

        $todosC = ToDo::select()
                    ->where('user_id', '=', $this->user_id)
                    ->where('completed','=','Y')
                    ->get();
        $completeCount = $todosC->count();

        $todosP = ToDo::select()
                    ->where('user_id', '=', $this->user_id)
                    ->where('completed','=','N')
                    ->get();
        $progressCount = $todosP->count();

        return response()->json(['totalCount' => $totalCount, 'completeCount' => $completeCount, 'progressCount' => $progressCount]);
    }

    public function lastHour() {
        $this->user_id = Auth::id();
        
        $todosP = ToDo::groupBy('due_at')
                    ->selectRaw('count(*) as total, due_at')
                    ->where('user_id', '=', $this->user_id)
                    ->where('completed','=','N')
                    ->orderBy('due_at', 'ASC')
                    ->get();

       // $arrayValue = array(array('total' => 0, 'due_at' => 'Due Date'));
        
        foreach ($todosP as $todo)
        {
            Log::info($todo->total);
        }
        
        return $this->sendResponse($todosP, 'To Do Chart');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->user_id = Auth::id();
        $todos = ToDo::select()
                    ->where('user_id', '=', $this->user_id)
                    ->orderBy('due_at','DESC')
                    ->paginate(5);
        
        return $this->sendResponse($todos, 'To Do list');
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

        return $this->sendResponse($todo, 'Task Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $todo = ToDo::findOrFail($id);

        return $this->sendResponse($todo, 'Task Detail');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $todo = ToDo::findOrFail($id);

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

        $todo->update($request->all());

        return $this->sendResponse($todo, 'Task Updated Successfully');
    }
    
    /**
     * Update to complete type of the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateCompleted($id)
    {
        $todo = ToDo::find($id);

        $todo->completed = 'Y';
        $todo->completed_at = now();

        // Update to DB
        $todo->update();

        return $this->sendResponse($todo, 'Task Completed Successfully');
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

        return $this->sendResponse($todo, 'Task Deleted Successfully');
    }

}
