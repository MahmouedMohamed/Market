<x-app-layout>
    <x-slot name="header">
        @include('categories')
    </x-slot>

    @include('promoted-products')
    @include('best-selling-products')
    @include('brands')
    @include('most-viewed-products')
    @include('latest-products')

</x-app-layout>
