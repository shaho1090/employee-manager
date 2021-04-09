<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employee List') }}
        </h2>
    </x-slot>

    <div class="max-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-4xl mt-4 px-6 py-6 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <table class="table-auto w-full justify-center text-center">
                <thead class="border ">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>has in-progress task</th>
                    <th>operation</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($employees as $employee)
                    <tr class="border">
                        <td>
                            {{ $employee->name }}
                        </td>
                        <td>
                            {{ $employee->email }}
                        </td>
                        <td>
                            {{ $employee->tasks()->where('status_id', \App\Models\TaskStatus::inProgress()->id)->first()
                               ? 'yes' : 'no'}}
                        </td>
                        <td>
                            <a href="{{ route('admin.employee.show', $employee->id) }}">
                                Show
                            </a>
                        </td>
                    </tr>
                @empty
                    <p> You don not define any employee yet!</p>
                @endforelse
                </tbody>
            </table>
            {{--            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">--}}
            {{--                <div class="p-6 bg-white border-b border-gray-200">--}}
            {{--                    <a href="{{ route('admin.employee.create') }}">--}}
            {{--                        {{ __('Create New Task') }}--}}
            {{--                    </a>--}}
            {{--                </div>--}}
            {{--            </div>--}}
        </div>
        {{--                <script src="{{ asset('js/myFunctions.js') }}"></script>--}}

    </div>
</x-app-layout>
