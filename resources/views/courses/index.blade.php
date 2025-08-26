<!DOCTYPE html>
<html>
<head>
    <title>Courses</title>
</head>
<body>
    <h1>Courses</h1>
    <a href="{{ route('courses.create') }}">Create Course</a>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Instructor</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($courses as $course)
                <tr>
                    <td>{{ $course->title }}</td>
                    <td>{{ $course->description }}</td>
                    <td>{{ $course->instructor }}</td>
                    <td>
                        <a href="{{ route('courses.show', $course->id) }}">View</a>
                        <a href="{{ route('courses.edit', $course->id) }}">Edit</a>
                        <form action="{{ route('courses.destroy', $course->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
