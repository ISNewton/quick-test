<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Quick test</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />


</head>

<body class="">
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>

        <div class="text-white text-center ">

            <p class="text-4xl mt-12">Dashboard</p>
            <p class="text-2xl my-6">Only authinticated users can see this page</p>

            @if (session()->has('message'))
                <div class="text-green-500 my-3">{{ session()->get('message') }}</div>
            @endif

            <form method="POST" enctype="multipart/form-data" action="{{ route('store') }}">
                @csrf
                <label for="">
                    Import product excel file
                </label>
                <input name="excel" type="file" required>
                @error('excel')
                    <div class="text-red-500  my-3">{{ $message }}</div>
                @enderror

                <button class="bg-white text-black p-3 block mx-auto my-3 rounded-lg" type="submit">Submit</button>
            </form>

            <div class="mt-12">
                    
                    
                <p class="text-4xl mt-12">or approve other accounts:</p>
                @forelse ($users as $user)
                    <div>

                        <span class="text-lg">{{ $user->email }}</span>
                        <form class="inline-block" action="{{ route('approve', $user) }}" method="post">
                            @csrf
                            <button class=" bg-green-500 text-white p-3 mx-auto my-3 rounded-lg"
                                type="submit">Approve</button>
                        </form>

                    </div>
                    @empty
                    <p>No accounts to approve</p>
                @endforelse

            </div>
        </div>

    </x-app-layout>

</body>

</html>
