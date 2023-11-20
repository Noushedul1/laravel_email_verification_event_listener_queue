<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>post</title>
</head>
<body>
    @if (Session::has('insertMsg'))
    <span>{{ Session::get('insertMsg') }}</span>
    @endif
    @if (Session::has('msgDelete'))
    <span>{{ Session::get('msgDelete') }}</span>
    @endif
    <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="text" name="title">
    <input type="file" name="image">
    <input type="submit" value="post create">
    </form>

    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Title</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $key=>$post)
            <tr>
                <td>{{ $key+1; }}</td>
                <td>{{ $post->title }}</td>
                <td>
                    <img src="{{ asset('images/'.$post->image) }}" height="100" width="100" alt="">
                </td>
                <td>
                    <a href="{{ route('post.edit',$post->id) }}">edit</a>
                    <a href="{{ route('post.delete',$post->id) }}">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
