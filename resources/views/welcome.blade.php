<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Доска сообщений</title>

    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                        <a href="{{ url('/create') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Написать пост </a>
                        <form action="{{route('logout')}}" method="POST">
                            @csrf
                            <input type="submit" class="btn-outline-primary" value="Выйти">
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Войти</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Зарегистрироваться</a>
                        @endif
                    @endauth
                </div>
            @endif

                @foreach($desks as $desk)
                <figure>
                    <figcaption class="blockquote-footer">
                        {{$desk->user->name}} написал  <cite title="Source Title">{{$desk->created_at}}</cite>
                    </figcaption>
                    <blockquote class="blockquote">
                        <p>{{$desk->message}}</p>
                    </blockquote>
                    @auth()
                    @if ($desk->user_id == $user->id and (($desk->created_at->diffInDays($cur)) >= 0))

                        <form action="{{route('delete', $desk->id)}}"
                              method="POST">
                            @csrf
                            @method('Delete')
                            <button type="submit" >
                                Удалить
                            </button>
                        </form>
                        @endif
                    @endauth
                </figure>
                @endforeach
            <div>
                {{$desks->links()}}
            </div>
        </div>
    </body>
</html>
