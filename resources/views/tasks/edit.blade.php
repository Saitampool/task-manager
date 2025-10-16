<x-layouts.layout :title="$title" :active="$active">
    <div class="max-w-3xl mx-auto py-6 sm:py-10 px-4 sm:px-6 lg:px-8">
        <h1 class="text-xl sm:text-2xl font-bold mb-4 sm:mb-6">Edit Task</h1>

        @if ($errors->any())
            <div class="mb-4 sm:mb-6 p-3 sm:p-4 bg-red-100 text-red-700 rounded">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li class="text-sm sm:text-base">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tasks.update', $task->task_id) }}" method="POST"
            class="bg-white shadow-md rounded px-4 sm:px-8 pt-4 sm:pt-6 pb-6 sm:pb-8 mb-4">
            @csrf
            @method('PUT')

            <div class="mb-4 sm:mb-5">
                <label for="title" class="block text-gray-700 font-bold mb-2 text-sm sm:text-base">
                    Title:
                </label>
                <input type="text" id="title" name="title" value="{{ old('title', $task->title) }}"
                    class="shadow appearance-none border rounded w-full py-2 sm:py-2.5 px-3 text-gray-700 text-sm sm:text-base leading-tight focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                    required>
            </div>

            <div class="mb-4 sm:mb-5">
                <label for="description" class="block text-gray-700 font-bold mb-2 text-sm sm:text-base">
                    Description:
                </label>
                <textarea id="description" name="description" rows="4"
                    class="shadow appearance-none border rounded w-full py-2 sm:py-2.5 px-3 text-gray-700 text-sm sm:text-base leading-tight focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 resize-none sm:resize-y">{{ old('description', $task->description) }}</textarea>
            </div>

            <div class="mb-4 sm:mb-5">
                <label for="status" class="block text-gray-700 font-bold mb-2 text-sm sm:text-base">
                    Status:
                </label>
                <select id="status" name="status"
                    class="shadow appearance-none border rounded w-full py-2 sm:py-2.5 px-3 text-gray-700 text-sm sm:text-base leading-tight focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                    required>
                    <option value="To Do" {{ old('status', $task->status) == 'To Do' ? 'selected' : '' }}>To Do
                    </option>
                    <option value="In Progress" {{ old('status', $task->status) == 'In Progress' ? 'selected' : '' }}>In
                        Progress</option>
                    <option value="Done" {{ old('status', $task->status) == 'Done' ? 'selected' : '' }}>Done</option>
                </select>
            </div>

            <div class="mb-6 sm:mb-8">
                <label for="deadline" class="block text-gray-700 font-bold mb-2 text-sm sm:text-base">
                    Deadline:
                </label>
                <input type="date" id="deadline" name="deadline"
                    value="{{ old('deadline', \Carbon\Carbon::parse($task->deadline)->format('Y-m-d')) }}"
                    class="shadow appearance-none border rounded w-full py-2 sm:py-2.5 px-3 text-gray-700 text-sm sm:text-base leading-tight focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                    required>
            </div>

            <div class="flex flex-col-reverse sm:flex-row sm:items-center sm:justify-between gap-3">
                <a href="{{ route('tasks.index') }}"
                    class="text-center sm:inline-block font-bold text-sm sm:text-base text-gray-600 hover:text-gray-800 py-2 sm:py-0">
                    Cancel
                </a>
                <button type="submit"
                    class="w-full sm:w-auto bg-green-500 hover:bg-green-700 text-white font-bold py-2.5 sm:py-2 px-6 sm:px-4 rounded focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors">
                    Update Task
                </button>
            </div>
        </form>
    </div>
</x-layouts.layout>
