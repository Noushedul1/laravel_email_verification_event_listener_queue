<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>post edit </title>
</head>
<body>
    <form action="{{ route('post.update',$post->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input type="text" name="title" value="{{ $post->title }}">
    <input type="file" name="image">
    <div>
        <img src="{{ asset('images/'.$post->image) }}" height="100" width="100" alt="">
    </div>
    <input type="submit" value="update post">
    </form>
</body>
</html>
