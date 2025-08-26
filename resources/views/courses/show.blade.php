<!DOCTYPE html>
<html>
<head>
    <title>Course Details</title>
</head>
<body>
    <h1>Course Details</h1>
    <p><strong>Title:</strong> {{ $course->title }}</p>
    <p><strong>Description:</strong> {{ $course->description }}</p>
    <p><strong>Instructor:</strong> {{ $course->instructor }}</p>
    <a href="{{ route('courses.index') }}">Back to Courses</a>
    <a href="{{ route('courses.edit', $course->id) }}">Edit</a>
</body>
</html>
