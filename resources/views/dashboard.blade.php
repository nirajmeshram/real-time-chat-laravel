<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <a class=" mt-4 px-2 btn btn-primary" href="{{ route('all-chats') }}"> Let's chat </a>
    </x-slot>


</x-app-layout>
