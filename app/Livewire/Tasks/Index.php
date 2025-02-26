<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $search = '';

    public function deleteTask($taskId)
    {
        $task = Task::findOrFail($taskId);
        $task->delete();
        session()->flash('success', 'Task deleted successfully.');
    }


    public function render()
    {
        if (Auth::user()->user_type == 'admin') {
            $tasks = Task::paginate(5);
        } else{
            $tasks = Task::taskList($this->search)->where('user_id', Auth::id())->whereNull('deleted_at')->paginate(5);
        }

        return view('livewire.tasks.index', ['tasks' => $tasks]);
    }
}
