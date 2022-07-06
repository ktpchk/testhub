<x-layout>
  <x-slot name="left">
    <h2 class="text-4xl mb-6">Попробовать свои силы</h2>
    <x-test-list>
      @foreach ($tests as $test)
        <x-test-list-item :test=$test />
      @endforeach
    </x-test-list>
    <a href="test/list.html" class="inline-block text-classicBlue-900 hover:text-classicBlue-100">
      Смотреть все тесты
      <i class="fa-solid fa-arrow-right-long"></i>
    </a>
  </x-slot>
  <x-slot name="right">
    <h2 class="text-4xl">О сайте</h2>
    <div class="text-sm space-y-2">
      <p>
        TestHub — это сервис, который позволяет вам легко создавать
        тесты для проверки знаний и просматривать результаты в удобном
        интерфейсе. Для создания и прохождения теста не требуется
        регистрация, но мы советуем это сделать, так как в этом случае
        вы легко сможете управлять своими тестами.
      </p>
      <p>Присоединяйтесь к сообществу TestHub!</p>
    </div>
    <div class="flex justify-around">
      <a href=""
        class="inline-block p-2 rounded-full bg-classicBlue-300 text-classicPink-300 hover:bg-classicBlue-50">
        Создать тест
      </a>
    </div>
  </x-slot>
</x-layout>
