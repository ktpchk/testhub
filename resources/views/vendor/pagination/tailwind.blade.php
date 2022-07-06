@if ($paginator->hasPages())
  <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between items-center">
    {{-- Previous Page Link --}}
    <div class="flex">
      <div class="z-10">
        @if ($paginator->onFirstPage())
          <span
            class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-classicPink-300 bg-classicBlue-50 cursor-default leading-5 rounded-l-full">
            « Назад
          </span>
        @else
          <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
            class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-classicPink-300 bg-classicBlue-300 leading-5 rounded-l-full hover:bg-classicBlue-50 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
            « Назад
          </a>
        @endif
      </div>
      <div>
        <span
          class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-classicPink-300 bg-classicBlue-300 border-x border-classicPink-300 cursor-default leading-5">
          {{ $paginator->currentPage() }}
        </span>
      </div>
      <div class="z-10">
        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
          <a href="{{ $paginator->nextPageUrl() }}" rel="next"
            class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-classicPink-300 bg-classicBlue-300 leading-5 rounded-r-full hover:bg-classicBlue-50 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
            Вперед »
          </a>
        @else
          <span
            class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-classicPink-300 bg-classicBlue-50 cursor-default leading-5 rounded-r-full">
            Вперед »
          </span>
        @endif
      </div>
    </div>

    <div>
      <p class="text-sm text-gray-700 leading-5">
        {!! __('Найдено') !!}
        <span class="font-medium">{{ $paginator->total() }}</span>
        {!! __('тестов') !!}
      </p>
    </div>
  </nav>
@endif
