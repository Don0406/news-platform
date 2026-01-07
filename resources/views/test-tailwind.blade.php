<!DOCTYPE html>
<html>
<head>
    <title>Tailwind CSS Test</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 p-8">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-4xl font-bold text-center text-blue-600 mb-8">
            Tailwind CSS Test Page
        </h1>
        
        <div class="mb-8 text-center">
            <a href="/" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                ← Back to Articles
            </a>
        </div>

        <!-- Test Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="bg-blue-500 text-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-bold mb-2">Card 1</h2>
                <p>Blue card with shadow</p>
            </div>
            <div class="bg-red-500 text-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-bold mb-2">Card 2</h2>
                <p>Red card with shadow</p>
            </div>
            <div class="bg-green-500 text-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-bold mb-2">Card 3</h2>
                <p>Green card with shadow</p>
            </div>
        </div>

        <!-- More Tailwind Tests -->
        <div class="space-y-8">
            <!-- Buttons -->
            <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Buttons</h2>
                <div class="flex flex-wrap gap-4">
                    <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Primary
                    </button>
                    <button class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                        Secondary
                    </button>
                    <button class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                        Success
                    </button>
                    <button class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                        Danger
                    </button>
                    <button class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                        Warning
                    </button>
                </div>
            </div>

            <!-- Alerts -->
            <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Alerts</h2>
                <div class="space-y-4">
                    <div class="p-4 bg-blue-100 border border-blue-400 text-blue-700 rounded">
                        Info alert
                    </div>
                    <div class="p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                        Success alert
                    </div>
                    <div class="p-4 bg-yellow-100 border border-yellow-400 text-yellow-700 rounded">
                        Warning alert
                    </div>
                    <div class="p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                        Danger alert
                    </div>
                </div>
            </div>

            <!-- Grid System -->
            <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Grid System</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="bg-purple-100 p-4 rounded text-center">Col 1</div>
                    <div class="bg-purple-200 p-4 rounded text-center">Col 2</div>
                    <div class="bg-purple-300 p-4 rounded text-center">Col 3</div>
                    <div class="bg-purple-400 p-4 rounded text-center">Col 4</div>
                </div>
            </div>

            <!-- Responsive Test -->
            <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Responsive Text</h2>
                <p class="text-sm sm:text-base md:text-lg lg:text-xl text-gray-700">
                    This text changes size based on screen width
                </p>
            </div>
        </div>

        <div class="mt-12 p-6 bg-gradient-to-r from-green-50 to-blue-50 rounded-xl border border-green-200">
            <h3 class="text-2xl font-bold text-green-700 mb-2">✅ Tailwind CSS Working!</h3>
            <p class="text-gray-700">
                All Tailwind CSS classes are functioning correctly. Your build is successful!
            </p>
            <div class="mt-4 flex gap-4">
                <a href="/" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Go to Articles
                </a>
                <a href="/login" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                    Login Page
                </a>
            </div>
        </div>
    </div>
</body>
</html>