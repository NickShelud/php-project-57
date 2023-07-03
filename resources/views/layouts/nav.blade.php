<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf-param" content="_token" />
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" 
        crossorigin="anonymous">
    <title>{{__('trans.nav.name')}}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <nav class="">
        <div class="bg-gray-800 border-gray-200 py-2.5 dark:bg-gray-900 shadow-md">
            <div class="flex flex-wrap items-center justify-between max-w-screen-xl px-4 mx-autor">
                <a href="/" class="flex text-gray-300">{{__('trans.nav.name')}}</a>
                <div class="items-center justify-between lg:flex lg:w-auto lg:order-1">
                        <a href="{{ route('tasks.index') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">{{__('trans.nav.tasks')}}</a>
                        <a href=" {{ route('task_statuses.index') }} " class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">{{__('trans.nav.statuses')}}</a>
                        <a href="{{ route('labels.index') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">{{__('trans.nav.label')}}</a>
                </div>
                <div class="flex lg:order-2">
                @guest
                    <button><a href="{{route('login')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{__('trans.nav.login')}}</a></button>
                    <button name='registration'><a href="{{route('register')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">{{__('trans.nav.registration')}}</a></button>
                @endguest
                @auth

                <a href="https://php-task-manager-ru.hexlet.app/logout" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">
                                {{__('trans.nav.logout')}}
                            </a>
                    
                @endauth
                </div>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
            <h1 class="grid grid-cols-4 gap-4">@yield('header')</h1>
            <div>
                @yield('content')
            </div>
    </div>
</body>
</html>