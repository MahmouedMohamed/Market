<div class="scrollbar sm:top-0 sm:right-0 p-1 m-1 text-center overflow-x-auto overflow-y-hidden z-10 md-card-content table-wrapper scroll"
>
    @foreach ($categories as $category)
    <a href="{{ route('register') }}"
        class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
        {{ $category->name }}
    </a>
    @endforeach
</div>
