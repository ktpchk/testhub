<x-layout>
  <x-slot name="title">Создать новый тест</x-slot>
  <x-slot name="left">
    <form action="/tests/store" method="POST" class="flex flex-col" name="test">
      @csrf
      <div class="mb-2">
        <label for="testName">Название</label>
        <input type="text" placeholder="Тест по арифметике" class="w-full border-2 rounded-sm outline-none p-0.5"
          name="name" id="testName" required />
      </div>

      <div class="mb-4">
        <label for="testTags">Теги</label>
        <input type="text" placeholder="математика, начальная школа, числа"
          class="w-full border-2 rounded-sm outline-none p-0.5" name="tags" id="testTags" required />
      </div>

      <div class="flex justify-between text-sm mb-2">
        <div>
          <button type="button" class="text-classicBlue-700 underline hover:text-classicBlue-200 hover:no-underline"
            id="descriptionAdder">
            Добавить предисловие
          </button>
          <button hidden type="button"
            class="text-classicBlue-700 underline hover:text-classicBlue-200 hover:no-underline" id="descriptionDelete">
            Убрать предисловие
          </button>
        </div>
        <div class="flex items-baseline space-x-2">
          <label for="testTime">Ограничение по времени, минут</label>
          <input type="number" class="border-2 rounded-sm outline-none w-11" min="0" max="999"
            name="time" id="testTime" value="0" />
          <button type="button" class="text-classicBlue-700 underline hover:text-classicBlue-200 hover:no-underline">
            Убрать
          </button>
        </div>
      </div>

      <div class="mb-10">
        <ul>
          <li>
            <label>
              <input type="checkbox" name="options[]" value="detailedResults" />
              Разрешить смотреть список неправильных ответов после
              теста
            </label>
          </li>
          <li>
            <label>
              <input type="checkbox" name="options[]" value="publicResults" />
              Сделать все результаты прохождения публичными
            </label>
          </li>
        </ul>
      </div>

      <div class="flex flex-col mb-4">
        <h3 class="text-4xl my-4 text-center">Вопросы теста</h3>
        <template id="questionTemplate">
          <x-question-form />
        </template>
        <template id="oneVariant">
          <x-one-variant />
        </template>
        <template id="multiVariant">
          <x-multi-variant />
        </template>
        <template id="text">
          <x-text />
        </template>


        <button type="button"
          class="self-start hover:text-classicBlue-200 hover:underline text-classicBlue-900 cursor-pointer questionAdder">
          Добавить вопрос
        </button>
      </div>

      <button type="submit"
        class="p-2 w-1/2 rounded-full bg-classicBlue-300 text-2xl text-classicPink-300 hover:bg-classicBlue-50 self-center">
        Отправить
      </button>
    </form>

  </x-slot>
  <x-slot name="right">
    <div id="stickyContainer" class="h-full">
      <div class="flex flex-col space-y-6 sidebar" id="rightPanel">
        <div class="sidebar__inner">
          <div class="space-y-2 pb-2 border-black border-b-2">
            <p>
              Вы можете создавать тесты без регистрации, но если вы
              зарегистрируетесь, то легко сможете управлять своими тестами
              и просматривать результаты.
            </p>
            <p>
              Если вы сейчас перейдете к регистрации, то введенные вами
              данные не потеряются.
            </p>
            <p>
              Также, после создания теста вы сможете указать e-mail, чтобы
              получать уведомления о сдаче тестов и получите ссылку для
              просмотра результатов.
            </p>
          </div>
          <ul class="flex flex-col justify-around mt-2 pb-2 border-black border-b-2">
            <li>Всего вопросов: <span id="totalQuestions" class="bg-classicBlue-400 text-classicPink-300 px-2">0</span>
            </li>
            <li>Всего баллов: <span id="totalPoints" class="bg-classicBlue-400 text-classicPink-300 px-2">0</span></li>
            <li>Минут на вопрос: <span id="timePerQuestion"
                class="bg-classicBlue-400 text-classicPink-300 px-2">0</span>
            </li>
          </ul>

          <div class="mt-2 pb-2 border-black border-b-2 space-y-2" id="navPanel">
            <h3 class="text-xl text-center">Навигация по вопросам</h3>
            <ul class="navContainer grid grid-cols-10 gap-2 justify-items-center">

            </ul>
          </div>
          <div class="mt-2 flex flex-col space-y-2">
            <button type="button"
              class="p-1.5 rounded-full bg-classicBlue-300 text-classicPink-300 hover:bg-classicBlue-50 resetForm">
              Начать заполнение заново
            </button>
            <button type="button" class="p-1.5 rounded-full bg-classicBlue-50 bg-opacity-60 text-classicPink-300"
              id="saveForm" disabled>
              Сохранить тест
            </button>
          </div>
        </div>
      </div>
    </div>
  </x-slot>
  <x-slot name="scripts">
    <script src="{{ asset('js/ResizeSensor.js') }}"></script>
    <script src="{{ asset('js/sticky-sidebar.js') }}"></script>
    <script src="{{ asset('js/form-buttons.js') }}"></script>
    <script src="{{ asset('js/form-storing.js') }}"></script>
    <script src="{{ asset('js/form-interactive.js') }}"></script>

  </x-slot>
</x-layout>
