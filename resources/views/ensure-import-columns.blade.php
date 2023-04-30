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

            <p class="text-4xl mt-12">Choose columns:</p>

            @if (session()->has('message'))
                <div class="text-green-500 my-3">{{ session()->get('message') }}</div>
            @endif

            <form method="POST" enctype="multipart/form-data" action="{{ route('import') }}">
                @csrf
                <input type="file" name="excel" value="{{ $excel }}" id="">

                <div>

                    <label for="">products</label>
                    <select class="text-black" name="products" id="">
                        @foreach ($headings as $row)
                            <option
                                {{ $row == 'products' ? 'selected' : (!in_array('products', $headings) ? App\Helpers\ImportHelper::isUnknownHeadingShouldBeSelected($headings, 0, $row) : '') }}
                                value="{{ $row }}">{{ $row }}</option>
                        @endforeach
                    </select>
                </div>

                <div>


                    <label for="">type</label>
                    <select class="text-black" name="type" id="">
                        @foreach ($headings as $row)
                            <option
                                {{ $row == 'type' ? 'selected' : (!in_array('type', $headings) ? App\Helpers\ImportHelper::isUnknownHeadingShouldBeSelected($headings, 1, $row) : '') }}
                                value="{{ $row }}">{{ $row }}</option>
                        @endforeach
                    </select>
                </div>

                <div>

                    <label for="">qty</label>
                    <select class="text-black" name="qty" id="">
                        @foreach ($headings as $row)
                            <option
                                {{ $row == 'qty' ? 'selected' : (!in_array('qty', $headings) ? App\Helpers\ImportHelper::isUnknownHeadingShouldBeSelected($headings, 2, $row) : '') }}
                                value="{{ $row }}">{{ $row }}</option>
                        @endforeach
                    </select>
                </div>

                <button class="bg-white text-black p-3 block mx-auto my-3 rounded-lg" type="submit">Submit</button>
            </form>


        </div>

    </x-app-layout>

</body>

</html>
