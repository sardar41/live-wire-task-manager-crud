<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    public $title, $description, $status, $user_id;
    public $statuses = ['Pending', 'In Progress', 'Completed'];
    public $users;

    public function mount()
    {
        $this->users = User::where('user_type', 'customer')->get();
    }

    public function saveTask()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'status' => 'required',
            'user_id' => 'required|exists:users,id'
        ]);

        Task::create([
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'user_id' => $this->user_id,
        ]);

        session()->flash('success', 'Task created successfully.');

        return redirect()->route('tasks.shown');
    }

    public function render()
    {
        return view('livewire.tasks.create');
    }
}
