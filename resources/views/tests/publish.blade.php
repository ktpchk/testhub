<x-layout>
  <x-slot name="title">
    Публикация теста
  </x-slot>
  <x-slot name="left">
    <div class="mb-12">
      <div class="mb-4">
        <p class="text-sm">
          Тест успешно создан. Вы можете ввести свой e-mail, чтобы
          получать на него уведомления о прохождении тестов, а также
          придумать себе пароль для входа на сайт.
        </p>
      </div>
      <form action="" class="w-full mb-2 flex">
        <label class="flex w-full space-x-2 items-center">
          <p>Email:</p>
          <input type="text" placeholder="" class="w-full border-2 rounded-sm outline-none p-0.5" />
        </label>
        <button class="p-1.5 rounded-full bg-classicBlue-300 text-classicPink-300 hover:bg-classicBlue-50 mr-0 ml-2"
          type="buttons">
          Сохранить
        </button>
      </form>
      <div>
        <a href="" class="hover:text-classicBlue-200 underline hover:no-underline text-classicBlue-700">Ввести
          пароль, имя и зарегистрироваться</a>
      </div>
    </div>
    <div class="mb-12">
      <div class="mb-4">
        <div class="flex justify-between text-sm">
          <p>Ссылка для прохождения теста</p>
          <p>
            <a href="/tests/{{ $test->id }}"
              class="hover:text-classicBlue-200 underline hover:no-underline text-classicBlue-700">Посмотреть</a>
          </p>
        </div>
        <input type="text" class="w-full border-2 rounded-sm outline-none p-0.5"
          value="http://testhub.com/tests/{{ $test->id }}" />
      </div>
      <div class="flex flex-col items-center">
        <p class="mb-2">Поделиться ссылкой в соцсетях</p>
        <div class="flex space-x-6">
          <a href="" class="block rounded-full border-2 border-classicBlue-900 p-2">
            ВК
          </a>
          <a href="" class="block rounded-full border-2 border-classicBlue-900 p-2">
            TW
          </a>
          <a href="" class="block rounded-full border-2 border-classicBlue-900 p-2">
            FB
          </a>
          <a href="" class="block rounded-full border-2 border-classicBlue-900 p-2">
            OK
          </a>
        </div>
      </div>
    </div>
    <div>
      <div class="mb-6">
        <p>Ссылка для просмотра результатов тестов</p>
        <a href="/tests/{{ $test->id }}/byh7gy789"
          class="hover:text-classicBlue-200 underline hover:no-underline text-classicBlue-700">http://testhub.com/tests/{{ $test->id }}/byh7gy789</a>
      </div>

      <div>
        <a href=""
          class="hover:text-classicBlue-200 underline hover:no-underline text-classicBlue-700 text-sm">Перейти к списку
          моих тестов</a>
      </div>
    </div>
  </x-slot>
</x-layout>
