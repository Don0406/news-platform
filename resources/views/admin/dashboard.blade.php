@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Admin Dashboard
    </h2>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <!-- Stats cards -->
            <div class="bg-white p-6 rounded-lg shadow">
                <div class="flex items-center">
                    <div class="bg-blue-500 p-3 rounded-full">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.67 3.913a4 4 0 01-3.67 2.284v-6m3.67 3.913l-3.67-2.284m0 0l-3.67 2.284M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h4 class="text-sm font-medium text-gray-500">Total Users</h4>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalUsers ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <!-- Add 3 more stat cards similarly -->
        </div>

        <div class="bg-white shadow-sm rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4">Quick Admin Actions</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('admin.users.index') }}" class="p-4 border rounded-lg hover:bg-gray-50">
                    Manage Users
                </a>
                <a href="{{ route('admin.articles.all') }}" class="p-4 border rounded-lg hover:bg-gray-50">
                    Manage Articles
                </a>
                <a href="{{ route('home') }}" class="p-4 border rounded-lg hover:bg-gray-50">
                    View Public Site
                </a>
            </div>
        </div>
    </div>
</div>
@endsection