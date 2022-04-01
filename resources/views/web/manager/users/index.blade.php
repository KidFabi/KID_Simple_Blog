@extends('layouts.manager')

@section('pageTitle')
    {{ __('Users') }}
@endsection

@section('pageContent')
    <h1 class="mt-4">{{ __('Users') }}</h1>
    <x-breadcrumbs>
        <li class="breadcrumb-item active" aria-current="page">{{ __('Users') }}</li>
    </x-breadcrumbs>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <x-status-alert/>
            <div class="card">
                <div class="card-header">{{ __('Users') }}</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Joined At') }}</th>
                                <th>{{ __('Username') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('First Name') }}</th>
                                <th>{{ __('Last Name') }}</th>
                                <th>{{ __('Role') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <th scope="row">{{ $user->id }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>{{ $user->username }}</td>
                                    @can ('viewSensitiveData', $user)
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->first_name }}</td>
                                        <td>{{ $user->last_name }}</td>
                                    @endcan
                                    <td><x-user-role :role="$user->role"/></td>
                                    <td>
                                        @can ('view', App\Models\User::class)
                                            <a href="{{ route('manager.users.show', $user->id) }}" class="btn btn-info" data-bs-title="tooltip" title="{{ __('Show account') }}"><i class="fas fa-eye"></i></a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <ul class="pagination pagination-rounded justify-content-center mt-3 mb-0">
                {{ $users->links() }}
            </ul>
        </div>
    </div>
@endsection

