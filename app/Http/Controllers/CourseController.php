<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        // Logic to display a list of courses
    }

    public function create()
    {
        // Logic to show the form for creating a new course
    }

    public function store(Request $request)
    {
        // Logic to store a new course
    }

    public function show($id)
    {
        // Logic to display a specific course
    }

    public function edit($id)
    {
        // Logic to show the form for editing a course
    }

    public function update(Request $request, $id)
    {
        // Logic to update a course
    }

    public function destroy($id)
    {
        // Logic to delete a course
    }
}
