<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg">
    <div class="flex justify-between items-center mb-4">
        <!-- Search Input Field -->
        <input type="text" wire:model.live.debounce.300ms="search" class="border border-gray-300 rounded-lg p-2 w-1/3" placeholder="Search tasks by title...">

        @if(Auth::user()->user_type == 'admin')
            <a href="{{ route('tasks.create') }}" class="px-4 py-2 bg-blue-500 font-semibold rounded-lg hover:bg-blue-600">
            {{ __('Add Task') }}
            </a>
        @endif
    </div>

    @if (session()->has('success'))
        <div class="bg-green-100 text-green-700 p-2 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-gray-100 p-4 rounded-lg">
        @if($tasks->isEmpty())
            <p class="text-gray-500 text-center">No tasks found.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700">
                            <th class="border border-gray-300 px-4 py-2 text-left">Title</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Description</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
                            @if (Auth::user()->user_type == 'admin')
                                <th class="border border-gray-300 px-4 py-2 text-left">Username</th>
                                <th class="border border-gray-300 px-4 py-2 text-center">Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr class="bg-white border border-gray-300">
                                <td class="border border-gray-300 px-4 py-2">{{ $task->title }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ Str::limit($task->description, 50) }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-gray-600">{{ ucfirst($task->status) }}</td>
                                @if (Auth::user()->user_type == 'admin')
                                    <td class="border border-gray-300 px-4 py-2">{{ $task->user->name ?? 'N/A' }}</td>
                                    <td class="border border-gray-300 px-4 py-2 flex justify-center space-x-2">
                                        <a href="{{ route('tasks.edit', $task->id) }}" class="px-3 py-1 bg-yellow-500 rounded-lg hover:bg-yellow-600">
                                            Edit
                                        </a>
                                        <button wire:click="deleteTask({{ $task->id }})" class="px-3 py-1 bg-red-500 rounded-lg hover:bg-red-600">
                                            Delete
                                        </button>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $tasks->links() }}
            </div>
        @endif
    </div>
</div>
