<x-layout>
  <x-slot name="title">Поиск тестов</x-slot>
  <x-slot name="left">
    @include('partials._search')
    @unless(count($tests) == 0)
      <x-test-list>
        @foreach ($tests as $test)
          <x-test-list-item :test=$test />
        @endforeach
      </x-test-list>
      <div class="mt-4">
        {{ $tests->withQueryString()->links() }}
      </div>
    @else
      @if ($searchValue)
        <div class="">Не найдены тесты по запросу "{{ $searchValue }}"</div>
      @else
        <div class="">Здесь пока нет тестов</div>
      @endif
    @endunless
  </x-slot>
  <x-slot name="right">
    <div class="text-sm space-y-2">
      <p>
        Чтобы найти нужный вам тест, введите тему, имя пользователя
        или ключевые слова в поле поиска. Тесты выводятся по убыванию
        популярности.
      </p>
    </div>
    <div class="flex justify-around">
      <a href="new.html"
        class="inline-block p-2 rounded-full bg-classicBlue-300 text-classicPink-300 hover:bg-classicBlue-50">
        Создать свой тест
      </a>
    </div>
  </x-slot>
</x-layout>
