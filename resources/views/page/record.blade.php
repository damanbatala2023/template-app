@extends("page.dashboard")
@section('content')


<!-- Add your dashboard content here -->

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h4>Users Record</h4>
            <div>
                <a href="{{route('create')}}" class="btn btn-outline-primary">Add</a>
            </div>
        </div>

        @if($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <strong>{{$message}}</strong>
        </div>
        @endif
        @csrf
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Photo</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->photo)
                        <img src="{{asset('public/pictures/'.$user->photo) }}" alt="{{ $user->name }}" width="50" height="50" class="rounded-circle">
                        @else
                        No photo available
                        @endif
                    </td>
                    <td>{{ $user->role }}</td>
                    <td>
                        <a href="{{ route('edit', $user->id) }}" class="btn btn-primary btn-sm">Edit</a>

                        <form action="{{ route('delete', $user->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection