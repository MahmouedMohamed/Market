<h1 class="dark:text-white" style=" margin: 10px"> Promoted Products </h1>
<div class="scrollbar overflow-x-auto overflow-y-hidden z-10 md-card-content container text-center">
    <div class="row align-items-center">
        <div class="col flex">
            @forelse($promotedProducts as $promotion)
            @if($promotion->product)
            <div class="card m-2 " style="width: 25vw; text-align:center">
                <img src="{{ $promotion->product->images->first()->path }}" class="card-img-top w-100 h-100" alt="...">
                <div class="card-body">
                    <p class="card-text">{{ $promotion->product->title }}</p>
                </div>
            </div>
            @endif
            @empty
            <a href="{{ route('register') }}"
                class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                Announcement
            </a>
            @endforelse
        </div>
    </div>
</div>
