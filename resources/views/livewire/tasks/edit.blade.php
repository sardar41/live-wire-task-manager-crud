<div class="max-w-lg mx-auto p-6 bg-white rounded-lg shadow-lg">
    <h2 class="text-xl font-bold mb-4">Edit Task</h2>

    @if (session()->has('success'))
        <div class="bg-green-100 text-green-700 p-2 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="updateTask">
        <div class="mb-4">
            <label class="block font-medium">Task Title</label>
            <input type="text" wire:model="title" class="w-full border border-gray-300 rounded-lg p-2" required>
            @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block font-medium">Task Description</label>
            <input type="text" wire:model="description" class="w-full border border-gray-300 rounded-lg p-2" required>
            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block font-medium">Status</label>
            <select wire:model="status" class="w-full border border-gray-300 rounded-lg p-2">
                @foreach ($statuses as $status)
                    <option value="{{ $status }}">{{ $status }}</option>
                @endforeach
            </select>
            @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-500 font-semibold rounded-lg hover:bg-blue-600">
            Update Task
        </button>
    </form>
</div>
