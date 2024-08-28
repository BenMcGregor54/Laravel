@extends('layouts.admin')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Adjust if using custom CSS -->
</head>
<body>
    <div class="container">
        <h1>Sent Messages</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>To</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Attachment</th>
                    <th>Sent At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($messages as $message)
                    <tr>
                        <td>{{ $message->id }}</td>
                        <td>{{ $message->to }}</td>
                        <td>{{ $message->subject }}</td>
                        <td>{{ $message->message }}</td>
                        <td>
                            @if($message->attachment)
                                <a href="{{ Storage::url($message->attachment) }}" target="_blank">Download</a>
                            @else
                                No attachment
                            @endif
                        </td>
                        <td>{{ $message->created_at->format('Y-m-d H:i:s') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
@endsection
