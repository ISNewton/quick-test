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
    <h1>Dashboard</h1>
    <h2>Only authinticated users can see this page</h2>

    @if (session()->has('message'))
        <div style="color:green">{{ session()->get('message') }}</div>
    @endif

    <form method="POST" enctype="multipart/form-data" action="{{ route('store') }}">
        @csrf
        <label for="">
            Excel file
        </label>
        <input name="excel" type="file" required>
        @error('excel')
            <span style="color:red">{{ $message }}</span>
        @enderror

        <button type="submit">Submit</button>
    </form>

</body>

</html>
