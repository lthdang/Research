@extends('layouts.admin.admin_layout')

@section('title', 'Quản lý người dùng')

@section('content')
    <div class="container mt-5">
        <h1>Admin Dashboard</h1>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2>Users Management</h2>
                    </div>
                    <div class="card-body">
                        <p>View and manage users on the platform.</p>
                        <a href="{{ route('admin.users') }}" class="btn btn-primary">Go to Users</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2>Categories Management</h2>
                    </div>
                    <div class="card-body">
                        <p>View and manage categories for the blog.</p>
                        <a href="{{ route('admin.categories') }}" class="btn btn-primary">Go to Categories</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Posts Statistics</h2>
                    </div>
                    <div class="card-body">
                        <p>View statistics for posts on the platform.</p>
                        <a href="{{ route('admin.statistics') }}" class="btn btn-primary">Go to Statistics</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

