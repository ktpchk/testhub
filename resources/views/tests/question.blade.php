<x-layout>
  <x-slot name="title">{{ $test->name }}</x-slot>
  <x-slot name="left">
    <div class="space-y-4 mb-12">
      <p class="">Осталось времени: {{ $test->time }}:00</p>
    </div>
    @php
      $i = 0;
      $questions = $test->questions()->get();
    @endphp
    <form method="POST">
      @csrf
      @foreach ($questions as $question)
        <div {{ $i != 0 ? 'hidden' : '' }} class="question">
          <div class="mb-6 space-y-4">
            <p>Вопрос {{ $i + 1 }} из {{ count($questions) }}</p>
            <p>
              {{ $question->text }}
            </p>
          </div>
          <div>

            <div class="flex flex-col mb-2 answers">

              @if ($question->type == 'text')
                <input type="text" class="w-full border-2 rounded-sm outline-none p-0.5"
                  name="answers[{{ $i }}][]" />
              @else
                @foreach ($question->answers()->get() as $answer)
                  <label>
                    <input type="{{ $question->type == 'oneVariant' ? 'radio' : 'checkbox' }}"
                      value="{{ $answer->text }}" name="answers[{{ $i }}][]" />
                    <span>{{ $answer->text }}</span>
                  </label>
                @endforeach
              @endif
            </div>
            <div class="mb-2">
              <p class="text-gray-600 text-opacity-50 text-sm">
                За ответ на этот вопрос дается {{ $question->points }} баллов.
              </p>
            </div>
            <div class="flex justify-end">
              <div class="flex space-x-4 items-center">
                @if ($i == 1)
                  <button disabled class="underline text-classicBlue-700 text-opacity-50">
                    <i class="fa-solid fa-arrow-left-long"></i>
                    Вернуться
                  </button>
                @else
                  <button type="button"
                    class="hover:text-classicBlue-200 underline hover:no-underline text-classicBlue-700 backward">
                    <i class="fa-solid fa-arrow-left-long"></i>
                    Вернуться
                  </button>
                @endif

                @if ($i == count($questions) - 1)
                  <button type="submit"
                    class="py-1.5 px-3 rounded-full bg-classicBlue-300 text-classicPink-300 hover:bg-classicBlue-50">
                    Отправить
                  </button>
                @else
                  <button type="button"
                    class="py-1.5 px-3 rounded-full bg-classicBlue-300 text-classicPink-300 hover:bg-classicBlue-50 forward">
                    Далее
                  </button>
                @endif

              </div>
            </div>

          </div>
        </div>
        @php($i++)
      @endforeach
    </form>
  </x-slot>
  <x-slot name="right">
    <div class="mt-2 pb-2 space-y-2" id="navPanel">
      <h3 class="text-xl text-center border-black border-b-2">Навигация по вопросам</h3>
      <ul class="navContainer grid grid-cols-10 gap-2 justify-items-center">
      </ul>
    </div>
  </x-slot>
  <x-slot name="scripts">
    <script src="{{ asset('js/question/questionNav.js') }}"></script>
  </x-slot>
</x-layout>
