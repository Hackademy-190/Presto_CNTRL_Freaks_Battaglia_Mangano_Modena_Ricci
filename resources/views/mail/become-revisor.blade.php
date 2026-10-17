<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kintsugi</title>
</head>

<body>
    <div>
        <h1>{{ __('ui.userRequestedToWorkWithUs') }}</h1>
        <h2>{{ __('ui.hereAreTheirDetails') }}</h2>
        <p>{{ __('ui.name') }}: {{ $user->name }}</p>
        <p>{{ __('ui.email') }}: {{ $user->email }}</p>
        <p>{{ __('ui.makeUserReviewer') }}</p>
        <a href="{{ route('make.revisor', compact('user')) }}">{{ __('ui.makeReviewer') }}</a>
    </div>
</body>

</html>
