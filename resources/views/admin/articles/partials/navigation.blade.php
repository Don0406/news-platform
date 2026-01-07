<!-- Sidebar -->
<aside class="fixed left-0 top-0 h-full w-64 bg-gray-900 text-white">
    <div class="p-6">
        <div class="flex items-center space-x-2 mb-8">
            <div class="w-8 h-8 bg-red-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-newspaper"></i>
            </div>
            <span class="text-xl font-bold">News<span class="text-red-600">Hub</span> Admin</span>
        </div>

        <nav class="space-y-2">
            <a href="/admin/dashboard" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-800 {{ request()->is('admin/dashboard*') ? 'bg-gray-800' : '' }}">
                <i class="fas fa-tachometer-alt w-5"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.articles.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-800 {{ request()->is('admin/articles*') ? 'bg-gray-800 bg-red-900/20' : '' }}">
                <i class="fas fa-newspaper w-5"></i>
                <span>Articles</span>
            </a>
            <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-800">
                <i class="fas fa-users w-5"></i>
                <span>Users</span>
            </a>
            <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-800">
                <i class="fas fa-chart-bar w-5"></i>
                <span>Analytics</span>
            </a>
            <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-800">
                <i class="fas fa-cog w-5"></i>
                <span>Settings</span>
            </a>
        </nav>

        <div class="mt-8 pt-8 border-t border-gray-800">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-user text-red-600"></i>
                </div>
                <div class="flex-1">
                    <p class="font-medium">{{ Auth::user()->name }}</p>
                    <p class="text-sm text-gray-400">Administrator</p>
                </div>
            </div>
            
            <div class="mt-6 space-y-2">
                <a href="/" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-800 text-gray-400 hover:text-white">
                    <i class="fas fa-external-link-alt w-5"></i>
                    <span>View Site</span>
                </a>
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="w-full flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-800 text-gray-400 hover:text-white">
                        <i class="fas fa-sign-out-alt w-5"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</aside>