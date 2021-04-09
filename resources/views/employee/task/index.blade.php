<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Task List') }}
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
                    <th></th>
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
                            @if ($task->isInProgress())
                                <form action="{{route('employee.task.update',$task->id)}}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" name="delete-task"> Make done</button>
                                </form>
                            @else
                                {{ '---' }}
                            @endif
                        </td>

                        <td>

                        </td>
                    </tr>
                @empty
                    <p> You do not have any task yet!</p>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
