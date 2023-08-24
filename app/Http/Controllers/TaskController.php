<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $client = new Client();

        $response = $client->get('https://jsonplaceholder.typicode.com/todos');

        $tasksFromApi = json_decode($response->getBody(), true);


        foreach ($tasksFromApi as $taskApi) {
            if ($taskApi['completed'] == true) {
                $taskApi['completed'] = 1;
            } else {
                $taskApi['completed'] = 0;
            }
            $tasks = Task::updateOrCreate(
                ['api_id' => $taskApi['id'],
                    'title' => $taskApi['title'],
                    'status' => $taskApi['completed'],
                    'description' => 'This is api description',
                ]
            );
        }

        $tasks = Task::orderBy('id','desc')->get();
        return view('tasks.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',

        ]);
        $data = $request->all();

        $task = Task::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'status' => $request->has('status'),

        ]);


        $request->session()->flash('message', 'Task is successfully Created!');

        return redirect('/tasks');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.show', get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        $data = $request->all();
        $task = ([
            'title' => $data['title'],
            'description' => $data['description'],
            'status' => $request->has('status'),
//            'role' => $data['role'],

        ]);
        $tasks = Task::findOrFail($id);
        $tasks->update($task);

        $request->session()->flash('message', 'Task is successfully Updated!');

        return redirect('/tasks');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        $task = Task::findOrFail($id);

        if (!$task) {
            return response()->json(['error' => 'Something Went Wrong']);
        } else {
            $task->delete();

            $request->session()->flash('message', 'Task is successfully deleted!');

            return redirect('/tasks');
        }
    }

    public function status(Request $request, $status, $id)
    {
        $model = Task::find($id);
        $model->status = $status;
        $model->save();

        $request->session()->flash('message', 'Status Changed Successfully');
        return redirect('tasks');

    }


}
