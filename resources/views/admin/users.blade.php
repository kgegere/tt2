<x-layout>
    <div class="container py-4">
        <x-slot name="title">
            {{ __('messages.user_management') }}
        </x-slot>
        <h1 class="mb-4">{{ __('messages.user_management') }}</h1>

        <form method="GET" class="row g-3 mb-4">
            <div class="col-md-6">
                <input type="text" name="search" class="form-control" placeholder="{{ __('messages.search_users') }}" value="{{ request('search') }}">
            </div>
            <div class="col-md-4">
                <select name="role" class="form-select">
                    <option value="">{{ __('messages.all_roles') }}</option>
                    @foreach($roles as $roleKey => $roleLabel)
                        <option value="{{ $roleKey }}" @if(request('role') == $roleKey) selected @endif>{{ $roleLabel }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">{{ __('messages.filter') }}</button>
            </div>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>{{ __('messages.user_id') }}</th>
                    <th>{{ __('messages.name') }}</th>
                    <th>{{ __('messages.email') }}</th>
                    <th>{{ __('messages.role') }}</th>
                    <th>{{ __('messages.view_profile') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ __('messages.' . $user->role) }}</td>
                    <td>
                        <a href="{{ route('user.admin.show', $user->id) }}" class="btn btn-sm btn-primary">{{ __('messages.view_profile') }}</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">{{ __('messages.no_users_found') }}</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layout>