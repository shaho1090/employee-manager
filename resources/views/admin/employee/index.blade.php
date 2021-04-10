<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Employee List
        </h2>
    </x-slot>

    <div class="max-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-4xl mt-4 px-6 py-6 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <table class="table-auto w-full justify-center text-center">
                <thead class="border">
                <tr>
                    <th class="p-3">Name</th>
                    <th>Email</th>
                    <th>has in-progress task</th>
                    <th>operation</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($employees as $employee)
                    <tr class="border">
                        <td class="p-2">
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
                    <p class="p-3"> You don not have any employee yet!</p>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
