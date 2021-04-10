<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Task List
        </h2>
    </x-slot>

    <div class="max-h-screen flex flex-col lg:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-6xl mt-2 px-4 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <table class="table-auto w-full justify-center text-center">
                <thead class="border ">
                <tr>
                    <th>Name</th>
                    <th>Note</th>
                    <th>Time</th>
                    <th>status</th>
                    <th>operation</th>
                    <th>assigning</th>
                    <th></th>
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
                                <button type="submit" name="delete-task" >Delete </button>
                            </form>
                        </td>
                        <td>
                            @if (!$task->isAssigned() )
                            <form action="{{route('assign-task.store')}}" method="post">
                                @csrf
                                <select class="ml-1 sm:rounded-lg" size="1" name="employee_id">
                                    <option  value="" disabled selected>
                                        assign to
                                    </option>
                                    @foreach($employees as $employee)
                                        <option value="{{$employee->id}}">
                                            {{ $employee->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-button class="ml-1" type="submit" name="task_id" value="{{$task->id}}">
                                    {{ __('Assign') }}
                                </x-button>
                            </form>
                            @else
                                <x-button class="sm-1" disabled>
                                    {{ __('Assigned') }}
                                </x-button>
                            @endif
                        </td>
                        <td>

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
    </div>
</x-app-layout>
