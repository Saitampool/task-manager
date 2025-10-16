<x-layouts.layout :title="$title" :active="$active">
    <div class="max-w-4xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold mb-4">Your Tasks</h1>

        {{-- Filter & Sorting --}}
        <div class="flex flex-col sm:flex-row justify-between items-stretch sm:items-center mb-4 gap-3">
            <a href="{{ route('tasks.create') }}"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-center">
                + New Task
            </a>

            <form action="{{ route('tasks.index') }}" method="GET"
                class="flex flex-col sm:flex-row gap-2 items-stretch sm:items-center">
                <select name="status"
                    class="border rounded px-3 py-2 w-full sm:w-auto focus:outline-none focus:ring-2 focus:ring-gray-300">
                    <option value="">All Status</option>
                    <option value="To Do" {{ request('status') == 'To Do' ? 'selected' : '' }}>To Do</option>
                    <option value="In Progress" {{ request('status') == 'In Progress' ? 'selected' : '' }}>In Progress
                    </option>
                    <option value="Done" {{ request('status') == 'Done' ? 'selected' : '' }}>Done</option>
                </select>

                <select name="sort"
                    class="border rounded px-3 py-2 w-full sm:w-auto focus:outline-none focus:ring-2 focus:ring-gray-300">
                    <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Deadline ↑</option>
                    <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Deadline ↓</option>
                </select>

                <button type="submit"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded w-full sm:w-auto">
                    Apply
                </button>
            </form>
        </div>

        {{-- Mobile View --}}
        <div class="block md:hidden space-y-3">
            @forelse ($tasks as $task)
                <div class="bg-white border rounded-lg p-4 shadow-sm">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="font-semibold text-lg flex-1">{{ $task->title }}</h3>
                        <span class="ml-2 px-2 py-1 text-xs rounded bg-gray-100 whitespace-nowrap">
                            {{ $task->status }}
                        </span>
                    </div>
                    <p class="text-sm text-gray-600 mb-3">
                        📅 {{ \Carbon\Carbon::parse($task->deadline)->translatedFormat('d F Y') }}
                    </p>
                    <div class="flex gap-2">
                        <a href="{{ route('tasks.edit', $task->task_id) }}"
                            class="flex-1 text-center bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded text-sm">
                            Edit
                        </a>
                        <form action="{{ route('tasks.destroy', $task->task_id) }}" method="POST"
                            onsubmit="return confirm('Are you sure?');" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded text-sm">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="bg-white border rounded-lg p-8 text-center text-gray-500">
                    No tasks found.
                </div>
            @endforelse
        </div>

        {{-- Dekstop View --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="min-w-full border divide-y divide-gray-200 bg-white">
                <thead class="bg-gray-100">
                    <tr class="text-left">
                        <th class="p-3 font-semibold">Title</th>
                        <th class="p-3 font-semibold">Status</th>
                        <th class="p-3 font-semibold">Deadline</th>
                        <th class="p-3 font-semibold">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($tasks as $task)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="p-3">{{ $task->title }}</td>
                            <td class="p-3">
                                <span class="px-2 py-1 text-sm rounded bg-gray-100">
                                    {{ $task->status }}
                                </span>
                            </td>
                            <td class="p-3">
                                {{ \Carbon\Carbon::parse($task->deadline)->translatedFormat('d F Y') }}
                            </td>
                            <td class="p-3">
                                <div class="flex gap-2">
                                    <a href="{{ route('tasks.edit', $task->task_id) }}"
                                        class="text-blue-500 hover:text-blue-700 hover:underline">
                                        Edit
                                    </a>
                                    <form action="{{ route('tasks.destroy', $task->task_id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 hover:underline">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-8 text-center text-gray-500">No tasks found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.layout>
