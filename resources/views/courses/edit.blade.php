<!DOCTYPE html>
<html>
<head>
    <title>Edit Course</title>
</head>
<body>
    <h1>Edit Course</h1>
    <form action="{{ route('courses.update', $course->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" value="{{ $course->title }}"><br>
        <label for="description">Description:</label><br>
        <textarea id="description" name="description">{{ $course->description }}</textarea><br>
        <label for="instructor">Instructor:</label><br>
        <input type="text" id="instructor" name="instructor" value="{{ $course->instructor }}"><br><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
