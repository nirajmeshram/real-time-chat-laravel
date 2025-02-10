<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user-id" content="{{ auth()->id() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background-color: #eee;
        }

        /* .chat-container {
            height: 500px;
            overflow-y: scroll;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
        } */
        .chat-container {
            height: 500px;
            overflow-y: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            /* display: flex;
            flex-direction: column-reverse; */
        }

        .message {
            margin-bottom: 10px;
            max-width: 70%;
            /* Adjust as needed */
            clear: both;
            /* Important for alignment */
        }

        .message-sent {
            float: right;
            background-color: #e2ffc7;
            /* Light green */
            padding: 10px;
            border-radius: 10px 10px 0 10px;
            /* Rounded corners on the left */
        }

        .message-received {
            border: 1px solid #dbd2d2;
            float: left;
            background-color: #fff;
            padding: 10px;
            border-radius: 10px 10px 10px 0;
            /* Rounded corners on the right */
        }

        .message-text {
            word-wrap: break-word;
            /* Prevent long text from overflowing */
        }

        .message-time {
            font-size: small;
            color: gray;
            margin-top: 5px;
        }

        .input-area {
            background-color: #fff;
            padding: 10px;
            border-radius: 10px;
            margin-top: 10px;
        }

        .user-name {
            border-bottom: 1px solid rgb(229, 221, 221);
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
