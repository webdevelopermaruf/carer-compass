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
        <h1 class="my-3 text-center">Carers List</h1>
        <table class="container">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Location</th>
                <th>WhatsApp</th>
                <th>Experience</th>
                <th>Service Area</th>
                <th>Training</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach($carers as $carer)
                <tr>
                    <td>{{$carer->name}}</td>
                    <td>{{$carer->email}}</td>
                    <td>{{$carer->phone}}</td>
                    <td>{{$carer->location}}</td>
                    <td>{{$carer->whatsapp}}</td>
                    <td>{{$carer->experience}}</td>
                    <td>{{implode(',', json_decode($carer->service_area))}}</td>
                    <td>{{$carer->training}}</td>
                    @if($carer->status === 0)
                        <td class="text-primary">Pending</td>
                    @elseif($carer->status === 1)
                        <td class="text-success">Approved</td>
                    @else
                        <td class="text-danger">Canceled</td>
                    @endif
                    <td>
                        @if($carer->status === 0)
                            <a href="/update_status?status=approved&&carer={{$carer->id}}" class="btn btn-sm btn-success">Approve</a>
                            <a href="/update_status?status=rejected&&carer={{$carer->id}}" class="btn btn-sm btn-danger mt-2">Cancel</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
