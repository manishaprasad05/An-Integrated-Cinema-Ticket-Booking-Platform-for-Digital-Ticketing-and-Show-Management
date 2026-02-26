@extends('layouts.admin')

@section('content')

<style>

/* Responsive Scroll */
.table-responsive {
    overflow-x: auto;
    border-radius: 12px;
}

/* Gradient Table Header */
.table thead th {
    background: linear-gradient(135deg, #4f46e5, #06b6d4);
    color: #ffffff !important;
    font-weight: 600;
    text-transform: uppercase;
    border-color: #2c2f36;
    font-size: 14px;
}

/* Row Hover Effect */
.table tbody tr:hover {
    background-color: rgba(255,255,255,0.08);
    transition: 0.2s ease-in-out;
}

/* Role Colors */
.role-admin {
    color: #22c55e;
    font-weight: 600;
}

.role-user {
    color: #facc15;
    font-weight: 600;
}

/* Mobile Layout */
@media (max-width: 768px) {

    .page-title {
        font-size: 20px;
    }

    .title-icon {
        width: 26px;
        height: 26px;
    }

    table th, table td {
        font-size: 13px;
        white-space: nowrap;
    }

    .header-flex {
        flex-direction: column;
        text-align: center;
    }
}

</style>

<div class="container-fluid mt-4">

    <!-- Page Header -->
    <div class="d-flex justify-content-center align-items-center mb-4 gap-2 header-flex">

        <svg class="title-icon" xmlns="http://www.w3.org/2000/svg"
            fill="none" width="32" height="32"
            stroke="currentColor" stroke-width="2"
            viewBox="0 0 24 24">
            <circle cx="9" cy="7" r="4"/>
            <path d="M17 11v-1a4 4 0 0 0-4-4"/>
            <path d="M3 21v-2a4 4 0 0 1 4-4h4"/>
        </svg>

        <h1 class="mb-0 page-title fw-bold">All Users</h1>

    </div>

    <!-- Users Table -->
    <div class="table-responsive shadow">

        <table class="table table-dark table-bordered table-striped align-middle text-center mb-0">

            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                </tr>
            </thead>

            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>

                        <!-- Role Font Color -->
                        <td class="{{ $user->role == 'admin' ? 'role-admin' : 'role-user' }}">
                            {{ ucfirst($user->role ?? 'user') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-warning">
                            No Users Found
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>

    </div>

</div>

@endsection
