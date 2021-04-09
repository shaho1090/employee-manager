<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Task Details')}}
        </h2>
    </x-slot>

    <div class="object-contain sm:justify-center items-center">

    </div>

    <div class="max-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-2xl mt-4 px-6 py-6 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form action="{{route('admin.task.update', $task->id)}}" method="post">
                @csrf
                @method('PATCH')
                <table class="table-auto w-full justify-center items-center text-center">
                    <thead>
                    <tr>
                        <th>Task name</th>
                        <th>Note</th>
                        <th>Time</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            {{ $task->name }}
                        </td>
                        <td>
                            {{ $task->note }}
                        </td>
                        <td>
                            {{  $task->time }}
                        </td>
                        <td>
                            <x-input id="task_quantity" class="w-2/3"
                                     type="number"
                                     value="{{ $task->time }}"
                                     min="1"
                                     name="time" required></x-input>
                        </td>
                        <td>
                            <button type="submit" class="btn btn-outline-danger"
                                    name="task_id"
                                    value="{{$task->id}}">Update</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</x-app-layout>
