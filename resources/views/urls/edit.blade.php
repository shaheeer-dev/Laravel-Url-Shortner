<div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">

    <form method="POST" action="{{ route('urls.update', $url) }}">
        @csrf
        @method('patch')
        <input type="text"
            name="title"
            required
            maxlength="255"
            placeholder="{{ __('Title') }}"
            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            value="{{ old('title', $url->title) }}"
        />
        {{-- Assuming x-input-error is a custom component for displaying errors --}}
        <div class="mt-2 text-red-500">{{ $errors->store->get('title') }}</div>
        <input type="text"
            name="original_url"
            required
            maxlength="255"
            placeholder="{{ __('Original Url') }}"
            class="block w-full border-gray-300 mt-5 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            value="{{ old('original_url', $url->original_url) }}"
        />
        <div class="mt-2 text-red-500">{{ $errors->store->get('original_url') }}</div>
        <div class="mt-4 space-x-2">
            <button type="submit" class="px-4 py-2 bg-indigo-500 text-white rounded-md hover:bg-indigo-700">{{ __('Save') }}</button>
            <a href="{{ route('urls.index') }}">{{ __('Cancel') }}</a>
        </div>
    </form>
</div>
