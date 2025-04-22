@extends('app')
@section('css')
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-family: Arial, sans-serif;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
@endsection
@section('page')
    <div style="margin-bottom: 150px;">
        <h1 class="my-3 text-center">Parent List</h1>
        <table class="container">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Location</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($parents as $parent)
                <tr>
                    <td>{{$parent->id}}</td>
                    <td>{{$parent->name}}</td>
                    <td>{{$parent->email}}</td>
                    <td>{{$parent->phone}}</td>
                    <td>{{$parent->address}}</td>
                    <td>
                        <a class="btn btn-danger"
                           href="/delete/parent/{{$parent->id}}"
                           onclick="return confirm('Are you sure you want to delete this parent?');">
                            Delete
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
