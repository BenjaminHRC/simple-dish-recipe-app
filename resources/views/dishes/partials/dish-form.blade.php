<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Dish recipe') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Add your favorite dish recipes') }}
        </p>
    </header>

    <form method="post" action="{{ isset($dish) ? route('dishes.update', ['dish' => $dish->id]) : route('dishes.store') }}"
        enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method(isset($dish) ? 'PUT' : 'POST')

        <x-text-input name="user_id" type="hidden" value="{{ Auth::id() }}" />

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                value="{{ isset($dish) ? $dish->name : '' }}" required autofocus />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="recette" :value="__('Recipe')" />
            <x-text-input id="recette" name="recette" type="text" class="mt-1 block w-full"
                value="{{ isset($dish) ? $dish->recette : '' }}" required />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div>
            <x-input-label for="image" :value="__('Upload image')" />
            <input name="image"
                class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                id="file_input" type="file" accept="image/*">
        </div>


        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>
