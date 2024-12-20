<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
    <div class="flex justify-end pt-6">
        <a href="{{ route('dishes.create') }}"
            class="bg-transparent hover:bg-gray-500 text-gray-400 font-semibold hover:text-white py-2 px-4 border border-gray-500 hover:border-transparent rounded cursor-pointer">
            {{ __('Add') }}
        </a>
    </div>
    @foreach ($paginateDishes as $paginateDish)
        <div class="pt-6">
            <div
                class="flex flex-col sm:flex-row sm:items-center bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 gap-4 text-gray-900 dark:text-gray-300">
                <div class="md:w-40 relative">
                    <img class="block xl:block mx-auto rounded-lg w-full h-[7rem] object-cover"
                        src="{{ str_contains($paginateDish->image, 'dishes') ? Storage::url($paginateDish->image) : $paginateDish->image }}"
                        alt="item.dishimg" />
                </div>
                <div class="flex flex-col md:flex-row justify-between md:items-center flex-1 gap-6">
                    <div class="flex flex-row md:flex-col justify-between items-start gap-2">
                        <div class="flex items-center gap-5">
                            <h1 class="text-xl">{{ $paginateDish->name }}</h1>
                            <form method="POST" action="{{ route('dish.add.favorite', ['dish' => $paginateDish->id]) }}">
                                @csrf
                                <button type="submit" class="cursor-pointer">
                                    @if ($paginateDish->is_favorite)
                                        <svg style="fill: #eab308;" width="24px" height="24px"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 576 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                            <path
                                                d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                        </svg>
                                    @else
                                        <svg style="fill: #eab308;" width="24px" height="24px"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 576 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                            <path
                                                d="M287.9 0c9.2 0 17.6 5.2 21.6 13.5l68.6 141.3 153.2 22.6c9 1.3 16.5 7.6 19.3 16.3s.5 18.1-5.9 24.5L433.6 328.4l26.2 155.6c1.5 9-2.2 18.1-9.7 23.5s-17.3 6-25.3 1.7l-137-73.2L151 509.1c-8.1 4.3-17.9 3.7-25.3-1.7s-11.2-14.5-9.7-23.5l26.2-155.6L31.1 218.2c-6.5-6.4-8.7-15.9-5.9-24.5s10.3-14.9 19.3-16.3l153.2-22.6L266.3 13.5C270.4 5.2 278.7 0 287.9 0zm0 79L235.4 187.2c-3.5 7.1-10.2 12.1-18.1 13.3L99 217.9 184.9 303c5.5 5.5 8.1 13.3 6.8 21L171.4 443.7l105.2-56.2c7.1-3.8 15.6-3.8 22.6 0l105.2 56.2L384.2 324.1c-1.3-7.7 1.2-15.5 6.8-21l85.9-85.1L358.6 200.5c-7.8-1.2-14.6-6.1-18.1-13.3L287.9 79z" />
                                        </svg>
                                    @endif
                                </button>
                            </form>
                        </div>
                        <div>
                            <p class="text-gray-200">{{ $paginateDish->recette }}</p>
                        </div>
                    </div>
                    <div class="flex flex-col gap-5">
                        <a href="{{ route('dishes.edit', ['dish' => $paginateDish->id]) }}">
                            <svg style="fill: #acaeb3;" width="24px" height="24px" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512">
                                <path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160L0 416c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-96c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 96c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l96 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 64z" />
                            </svg>
                        </a>
                        <form method="POST" action="{{ route('dishes.destroy', ['dish' => $paginateDish->id]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="cursor-pointer">
                                <svg style="fill: #b16a6d;" width="24px" height="24px"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 448 512">
                                    <path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
    @endforeach
    <div class="pt-6">
        {{ $paginateDishes->links() }}
    </div>
    </div>
</x-app-layout>
