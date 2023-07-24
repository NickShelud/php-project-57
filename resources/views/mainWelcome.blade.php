<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{__('trans.nav.name')}}</title>
</head>
<body>
    @extends('layouts.nav')

    @section('content')
    <div class="mr-auto place-self-center lg:col-span-7">
        
    </div>
        <h1 class="max-w-2xl mb-4 text-4xl font-extrabold leading-none tracking-tight md:text-5xl xl:text-6xl dark:text-white">{{ __('trans.hello') }}</h1>
        <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">{{ __('trans.descriptionProject') }}</p>
        <div class="space-y-4 sm:flex sm:space-y-0 sm:space-x-4">
            <a href="https://github.com/NickShelud" target="_blank" 
            class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">{{ __('trans.clickMe') }}</a>
        </div>
    @endsection
</body>
</html>