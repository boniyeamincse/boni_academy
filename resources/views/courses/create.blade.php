<!DOCTYPE html>
<html>
<head>
    <title>Create Course</title>
</head>
<body>
    <h1>Create Course</h1>
    <form action="{{ route('courses.store') }}" method="POST">
        @csrf
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title"><br>
        <label for="description">Description:</label><br>
        <textarea id="description" name="description"></textarea><br>
        <label for="instructor">Instructor:</label><br>
        <input type="text" id="instructor" name="instructor"><br><br>
        <button type="submit">Create</button>
    </form>
</body>
</html>
