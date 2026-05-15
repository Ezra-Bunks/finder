<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Post
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div>
                        <x-input-label for="title" :value="__('Item Name')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $post->title)" required />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <!-- Description -->
                    <div class="mt-4">
                        <x-input-label for="description" :value="__('Description')" />
                        <textarea id="description" name="description" rows="4"
                            class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>{{ old('description', $post->description) }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <!-- Category -->
                    <div class="mt-4">
                        <x-input-label for="category_id" :value="__('Category')" />
                        <select id="category_id" name="category_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                            <option value="">-- Select Category --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                    </div>

                    <!-- Location Found -->
                    <div class="mt-4">
                        <x-input-label for="location_found" :value="__('Location Found')" />
                        <x-text-input id="location_found" class="block mt-1 w-full" type="text" name="location_found" :value="old('location_found', $post->location_found)" required />
                        <x-input-error :messages="$errors->get('location_found')" class="mt-2" />
                    </div>

                    <!-- Date Found -->
                    <div class="mt-4">
                        <x-input-label for="date_found" :value="__('Date Found')" />
                        <x-text-input id="date_found" class="block mt-1 w-full" type="date" name="date_found" :value="old('date_found', $post->date_found)" max="{{ date('Y-m-d') }}" required />
                        <x-input-error :messages="$errors->get('date_found')" class="mt-2" />
                    </div>

                    <!-- Contact Phone -->
                    <div class="mt-4">
                        <x-input-label for="contact_phone" :value="__('Contact Phone')" />
                        <x-text-input id="contact_phone" class="block mt-1 w-full" type="text" name="contact_phone" :value="old('contact_phone', $post->contact_phone)" required />
                        <x-input-error :messages="$errors->get('contact_phone')" class="mt-2" />
                    </div>

                    <!-- Photo -->
                    <div class="mt-4">
                        <x-input-label for="photo" :value="__('Photo (optional)')" />
                        @if($post->photo_path)
                            <img src="{{ Storage::url($post->photo_path) }}" class="mt-2 h-32 rounded" alt="Current photo" />
                            <p class="text-sm text-gray-500 mt-1">Upload a new photo to replace the current one.</p>
                        @endif
                        <input id="photo" type="file" name="photo" accept="image/jpg,image/png,image/webp"
                            class="block mt-1 w-full text-sm text-gray-500" />
                        <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                    </div>

                    <!-- Buttons -->
                    <div class="flex items-center justify-end mt-6 gap-4">
                        <a href="{{ route('posts.show', $post) }}" class="text-sm text-gray-600 underline">Cancel</a>
                        <x-primary-button>{{ __('Update') }}</x-primary-button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>