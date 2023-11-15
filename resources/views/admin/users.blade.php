@extends('layouts.admin_layout')

@section('title', 'Quản lý người dùng')

@section('content')
    <div class="container mt-5">
        <h1>User Management</h1>

        <table class="table mt-4">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Level</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                @if($user->level != 1)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->level }}</td>
                        <td>
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary">Edit</a>
                            <button class="btn btn-danger" onclick="deleteUser({{ $user->id }})">Delete</button>
                        </td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>

    <script>
        function deleteUser(userId) {
            // Thực hiện xử lý xóa người dùng với userId được chọn
            // Bạn có thể sử dụng AJAX để gửi yêu cầu xóa đến server
            // Sau khi xóa, có thể làm mới trang hoặc cập nhật nội dung bảng bằng JavaScript
            console.log('Deleting user with ID ' + userId);
        }
    </script>
@endsection

