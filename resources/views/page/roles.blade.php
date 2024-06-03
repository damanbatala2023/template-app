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

                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <button type="button" data-toggle="modal" data-target="#changeRoleModal" style="border: none; background: none; color:dodgerblue">{{ $user->role }}</button>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="changeRoleModal" tabindex="-1" role="dialog" aria-labelledby="changeRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Modal content goes here -->
            <form action="{{ route('update-role', ['id' => $user->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <label for="role">New Role:</label>
                    <select name="role" id="role">
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                        <!-- Add more role options as needed -->
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>


        </div>
    </div>
</div>

@endsection