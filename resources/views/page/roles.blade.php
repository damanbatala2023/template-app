@extends("page.dashboard")
@section('content')


<!-- Add your dashboard content here -->

<div class="card">
    <div class="card-header">
        <h4>Users Role</h4>
        @if(Session::has('Success'))
        <div class="alert alert-success">{{Session::get('Success')}}</div>
        @endif
        @if(Session::has('Failed'))
        <div class="alert alert-danger">{{Session::get('Failed')}}</div>
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
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td> {{ $user->role }}</td>
                    <td>
                        <a href="{{route('edit-role', $user->id)}}" class="btn btn-primary btn-sm">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="changeRoleModal" tabindex="-1" role="dialog" aria-labelledby="changeRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- Modal content goes here -->
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('update-role', ['id' => $user->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <label for="role">New Role:</label>
                        <select name="role" id="role">
                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                            <!-- Add more role options as needed -->
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary col-6 mx-auto">Save</button>

                    </div>
                </form>


            </div>
        </div>
    </div>
</div>

@endsection