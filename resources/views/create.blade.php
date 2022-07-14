<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Написать сообщение</title>

</head>
<body>
<form action="{{route('store')}}" method="POST" class="w-25">
    @csrf
    <div class="form-group">
        <label>Сообщение</label>
        <input type="hidden" class="form-control" name="user_id" value="{{$user->id}}">
        <input type="text" class="form-control" name="message" placeholder="Сообщение">
    </div>
    @error('message')
    <div class="text-danger">Заполните поле</div>
    @enderror
    <input type="submit" class="btn-primary" value="Добавить">
</form>
</body>
</html>
