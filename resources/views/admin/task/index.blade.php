<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Task List') }}
        </h2>
    </x-slot>

    <div class="max-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-2xl mt-4 px-6 py-6 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <table class="table-auto w-full justify-center text-center">
                <thead class="border ">
                <tr>
                    <th>Name</th>
                    <th>Note</th>
                    <th>Time</th>
                    <th>status</th>
                    <th>operation</th>
                </tr>
                </thead>

                <tbody>
                @forelse ($tasks as $task)
                    <tr class="border">
                        <td>
                            {{ $task->name }}
                        </td>
                        <td>
                            {{ $task->note }}
                        </td>
                        <td>
                            {{ $task->time }}
                        </td>
                        <td>
                            {{ $task->status }}
                        </td>
                        <td>
                            <form action="{{route('admin.task.destroy',$task->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete /</button>
                                <a href="{{ route('admin.task.show', $task->id) }}">
                                    {{ __('Show') }}
                                </a>
                            </form>
                        </td>
                    </tr>
                @empty
                    <p> You don not define any task yet!</p>
                @endforelse
                </tbody>
            </table>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('admin.task.create') }}">
                        {{ __('Create New Task') }}
                    </a>
                </div>
            </div>
        </div>
        {{--                <script src="{{ asset('js/myFunctions.js') }}"></script>--}}

    </div>
</x-app-layout>
