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
        <h1>{{ __('trans.hello') }}</h1>
        <p>{{ __('trans.descriptionProject') }}</p>
        <div>
            <a href="https://github.com/NickShelud" target="_blank">{{ __('trans.clickMe') }}</a>
        </div>
    @endsection
</body>
</html>