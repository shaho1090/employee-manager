<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Task') }}
        </h2>
    </x-slot>

    <div class="max-h-screen flex flex-col sm:justify-center items-center pt-2 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-md mt-2 px-6 py-6 bg-white shadow-md overflow-hidden sm:rounded-lg">

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors"></x-auth-validation-errors>

            <form method="POST" action="{{ route('admin.task.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- product Name -->
                <div>
                    <x-label for="name" :value="__('Task Name')"></x-label>

                    <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                             :value="old('name')" required autofocus></x-input>
                </div>

                <!-- Product Brand -->
                <div class="mt-4">
                    <x-label for="note" :value="__('Note')"></x-label>

                    <x-input id="note" class="block mt-1 w-full" type="text" name="note"
                             :value="old('Note')" required></x-input>
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-label for="time" :value="__('Time')"></x-label>

                    <x-input id="time" class="block mt-1 w-full"
                             type="number"
                             name="time"></x-input>
                </div>

                <!-- Product type -->
                {{--                <div class="mt-4">--}}
                {{--                    <x-label for="product_type" :value="__('Confirm Password')"/>--}}

                {{--                    <x-input id="password_confirmation" class="block mt-1 w-full"--}}
                {{--                             type="password"--}}
                {{--                             name="password_confirmation" required/>--}}
                {{--                </div>--}}

                <div class="flex items-center justify-end mt-4">
                    <x-button class="ml-4">
                        {{ __('Create') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

