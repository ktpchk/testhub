<x-layout>
  <x-slot name="title">{{ $test->name }}</x-slot>
  <x-slot name="left">
    <div class="space-y-4 mb-12">
      <p class="">{{ $test->description }}</p>
      @php
        $questions = $test
            ->questions()
            ->get()
            ->toArray();
        $questionCount = count($questions);
        $totalPoints = array_reduce($questions, fn($sum, $item) => $sum + $item['points'], 0);
      @endphp
      <p>
        В тесте {{ $questionCount }} вопросов, за которые можно набрать от 0 до {{ $totalPoints }}
        баллов, на весь тест дается {{ $test->time }} минут.
      </p>
      @if ($test->tried > 0)
        <p>Тест сдало {{ $test->passed }} человек ({{ ($test->passed / $test->tried) * 100 }}%) из {{ $test->tried }}
          сдавших.</p>
      @else
        <p>
          На данный момент вы первый сдающий.
        </p>
      @endif
      <p>
        Автор:
        <a href="" class="hover:text-classicBlue-200 underline hover:no-underline text-classicBlue-700">Иванов
          Иван</a>
      </p>
    </div>
    <div>
      <div class="flex justify-center">
        <a href="/tests/{{ $test->id }}/question"
          class="p-3 rounded-full bg-classicBlue-300 text-classicPink-300 hover:bg-classicBlue-50">Начать
          тест</a>
      </div>
    </div>
  </x-slot>
  <x-slot name="right">
    <div class="">
      <p class="mb-4 text-sm">
        Вы можете войти на сайт или зарегистрироваться, перед тем как
        сдавать тест.
      </p>
    </div>
  </x-slot>
</x-layout>
