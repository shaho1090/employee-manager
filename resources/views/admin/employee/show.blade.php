<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $employee->name }}
        </h2>
    </x-slot>

    <div class="object-contain sm:justify-center items-center">

    </div>

    <div class="max-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-4xl mt-4 px-6 py-6 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <table class="table-auto w-full justify-center items-center text-center">
                    <thead>
                    <tr>
                        <th>Task name</th>
                        <th>Note</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>operation</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($tasks as $task)
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
                            {{  $task->status }}
                        </td>
                        <td>
                            <form action="{{route('assign-task.destroy')}}" method="post">
                                @csrf
                                <input type="hidden" name="employee_id" value=" {{ $employee->id}}">
                                <x-button class="ml-1" type="submit" name="task_id" value="{{$task->id}}">
                                    {{ __('unassign') }}
                                </x-button>
                            </form>
                        </td>
                    </tr>
                    @empty
                        <p> There is no task yet!</p>
                    @endforelse
                    </tbody>
                </table>
        </div>
    </div>
</x-app-layout>
