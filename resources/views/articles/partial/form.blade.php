@csrf

@if(isset($article) && $article->id)
    @method('PUT')
@endif

<div class="space-y-6">
    <!-- Title -->
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700">Title *</label>
        <input type="text" name="title" id="title" 
               value="{{ old('title', $article->title ?? '') }}"
               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
               required>
        @error('title')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Excerpt -->
    <div>
        <label for="excerpt" class="block text-sm font-medium text-gray-700">Excerpt</label>
        <textarea name="excerpt" id="excerpt" rows="3"
                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('excerpt', $article->excerpt ?? '') }}</textarea>
        @error('excerpt')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Content -->
    <div>
        <label for="content" class="block text-sm font-medium text-gray-700">Content *</label>
        <textarea name="content" id="content" rows="10"
                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('content', $article->content ?? '') }}</textarea>
        @error('content')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Category -->
    <div>
        <label for="category" class="block text-sm font-medium text-gray-700">Category *</label>
        <select name="category" id="category" 
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
            <option value="">Select Category</option>
            <option value="Technology" {{ old('category', $article->category ?? '') == 'Technology' ? 'selected' : '' }}>Technology</option>
            <option value="Business" {{ old('category', $article->category ?? '') == 'Business' ? 'selected' : '' }}>Business</option>
            <option value="Sports" {{ old('category', $article->category ?? '') == 'Sports' ? 'selected' : '' }}>Sports</option>
            <option value="Entertainment" {{ old('category', $article->category ?? '') == 'Entertainment' ? 'selected' : '' }}>Entertainment</option>
            <option value="Health" {{ old('category', $article->category ?? '') == 'Health' ? 'selected' : '' }}>Health</option>
            <option value="Science" {{ old('category', $article->category ?? '') == 'Science' ? 'selected' : '' }}>Science</option>
        </select>
        @error('category')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Featured Image -->
    <div>
        <label for="featured_image" class="block text-sm font-medium text-gray-700">Featured Image</label>
        @if(isset($article) && $article->featured_image)
            <div class="mt-2">
                <img src="{{ asset('storage/' . $article->featured_image) }}" 
                     alt="Current featured image" 
                     class="h-32 w-auto rounded-lg">
            </div>
        @endif
        <input type="file" name="featured_image" id="featured_image" 
               accept="image/*"
               class="mt-1 block w-full">
        @error('featured_image')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Status (for editors/admins) -->
    @can('publish', $article ?? null)
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
            <select name="status" id="status" 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                <option value="draft" {{ old('status', $article->status ?? '') == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="pending" {{ old('status', $article->status ?? '') == 'pending' ? 'selected' : '' }}>Pending Review</option>
                <option value="published" {{ old('status', $article->status ?? '') == 'published' ? 'selected' : '' }}>Published</option>
            </select>
        </div>
    @else
        <input type="hidden" name="status" value="draft">
    @endcan

    <!-- Actions -->
    <div class="flex justify-end space-x-3">
        <a href="{{ route('articles.index') }}" 
           class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400">
            Cancel
        </a>
        <button type="submit" 
                class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700">
            {{ isset($article) ? 'Update Article' : 'Create Article' }}
        </button>
    </div>
</div>