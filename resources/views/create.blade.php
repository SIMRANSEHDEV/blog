<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <title>create</title>
</head>
<body>
<div class="container">
  <h2 class="mt-4">CREATE POST AT HERE</h2>
  <div class="text-right mb-3">
  <a href="{{ route('posts.welcome') }}" class="btn btn-primary">BACK</a>
</div>
  <form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" placeholder="Enter Name" name="name">
      @error('name')
                <p class="text-danger">{{ $message }}</p>
            @enderror
    </div>
    <div class="form-group">
      <label for="title">Title:</label>
      <input type="text" class="form-control" placeholder="Enter Title" name="title">
      @error('title')
                <p class="text-danger">{{ $message }}</p>
            @enderror
    </div>
    <div class="form-group">
    <label for="summary">Summary</label>
    <textarea type="text" class="form-control" placeholder="Enter Summary" name="summary"></textarea>
    @error('summary')
                <p class="text-danger">{{ $message }}</p>
            @enderror
    </div>
    <div class="form-group">
    <label for="image">Image</label>
    </br>
    <input type="file"  id="myFile" name="image">
    @error('image')
                <p class="text-danger">{{ $message }}</p>
            @enderror
    </div>
    <button type="submit" class="btn btn-primary">save post</button>
  </form>
</div>
</body>
</html>