<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Task;

class SyncTasks extends Command
{
    protected $signature = 'tasks:sync';
    protected $description = 'Sync tasks from the API and update existing ones based on their status.';

    public function handle()
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/todos');
        $tasksFromApi = $response->json();

        foreach ($tasksFromApi as $taskApi) {
            if($taskApi['completed'] == true){
                $taskApi['completed'] = 1;
            }else{
                $taskApi['completed'] = 0;
            }
            Task::updateOrCreate(
                ['api_id' => $taskApi['id'],
                    'title' => $taskApi['title'],
                    'status' => $taskApi['completed'],
                    'description' => 'This is api description',
                ]

            );
        }

        $this->info('Tasks synchronized successfully.');
    }
}
