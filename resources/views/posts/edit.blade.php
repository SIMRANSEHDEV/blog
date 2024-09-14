<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <title>EDIT</title>
</head>
<body>
<div class="container">
  <h2 class="mt-4">Edit POST AT HERE</h2>
  <div class="text-right mb-3">
  <a href="{{ route('posts.welcome') }}" class="btn btn-primary">BACK</a>
</div>
  <form action="{{route('posts.update',$post->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" placeholder="Enter Name" name="name" value="{{ old('name', $post->name) }}">
      @error('name')
                <p class="text-danger">{{ $message }}</p>
            @enderror
    </div>
    <div class="form-group">
      <label for="title">Title:</label>
      <input type="text" class="form-control" placeholder="Enter Title" name="title" value="{{ old('title', $post->title) }}">
      @error('title')
                <p class="text-danger">{{ $message }}</p>
            @enderror
    </div>
    <div class="form-group">
    <label for="summary">Summary</label>
    <input type="text" class="form-control" placeholder="Enter Summary" name="summary" value="{{ old('summary', $post->summary) }}"></input>
    @error('summary')
                <p class="text-danger">{{ $message }}</p>
            @enderror
    </div>
    <div class="form-group">
    <label for="image">Image</label>
    </br>
    <input type="file"  id="myFile" name="image">
    <td><img src="{{url('uploads/posts',$post->image)}}" width="100" height="100"></td>
    @error('image')
                <p class="text-danger">{{ $message }}</p>
            @enderror
    </div>
    <button type="submit" class="btn btn-primary">Update post</button>
  </form>
</div>
</body>
</html>