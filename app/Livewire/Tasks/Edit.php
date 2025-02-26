<?php

namespace App\Livewire\Tasks;

use Livewire\Component;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class Edit extends Component
{
    public $taskId, $description, $title, $status;
    public $statuses = ['Pending', 'In Progress', 'Completed'];

    public function mount($taskId)
    {
        $this->taskId = $taskId;
        $task = Task::where('id', $taskId)->where('user_id', Auth::id())->firstOrFail();
        $this->title = $task->title;
        $this->description = $task->description;
        $this->status = $task->status;
    }

    public function updateTask()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|string|in:Pending,In Progress,Completed',
        ]);

        $task = Task::findOrFail($this->taskId);
        $task->update([
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
        ]);

        session()->flash('success', 'Task updated successfully!');
        return redirect()->route('tasks.shown');
    }

    public function render()
    {
        return view('livewire.tasks.edit');
    }
}
