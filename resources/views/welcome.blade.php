<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <title>Blog List</title>
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">BLOGS</h1>
        <div class="text-right mb-3">
        <a href="{{ route('posts.create') }}" class="btn btn-primary">Create</a>
        </div>
        @if(Session::has('success'))
        <div class="alert alert-success">
        {{Session::get('success')}}
        </div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>AUTHOR</th>
                    <th>TITLE</th>
                    <th>SUMMARY</th>
                    <th>IMAGE</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody valign="middle">
                @if($posts->isNotEmpty())
                @foreach($posts as $post)
                <tr>
                    <td class="text-capitalize">{{$post->name}}</td>
                    <td class="text-capitalize">{{$post->title}}</td>
                    <td class="text-capitalize"><textarea  rows="3" cols="50">{{$post->summary}}</textarea></td>
                    <td><img src="{{url('uploads/posts',$post->image)}}" width="100" height="100"></td>
                    <td>
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info btn-sm">EDIT</a>

                        <a type="button" onclick="deletepost({{$post->id}})" class="btn btn-danger btn-sm">DELETE</a>
                        <form id="post-delete-action-{{$post->id}}" action="{{route('posts.destroy',$post->id)}}" method="post">
                            @csrf
                            @method('delete')
                      
                        </form>
                </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="5">RECORD NOT FOUND</td>
            </tr>
            @endif
            </tbody>
        </table>
    </div>
</body>
</html>
<script>
    function deletepost(id) {
        if (confirm("Are you sure you want to delete this post?")) {
            document.getElementById('post-delete-action-' +id).submit();
        }
    }
    </script>