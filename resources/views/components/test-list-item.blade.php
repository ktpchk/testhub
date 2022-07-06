<li class="flex justify-between items-center">
  <div class="flex flex-col">
    <a href="" class="text-classicBlue-900 hover:text-classicBlue-100">
      {{ $test->name }}
    </a>
    <x-taglist :test=$test />
  </div>
  <div class="flex space-x-6 items-center">
    <div class="text-sm">
      {{ $test->passed }} / {{ $test->tried }}
    </div>
    <div class="">
      <a href=""
        class="inline-block px-2 py-1 rounded-full bg-classicBlue-300 text-classicPink-300 hover:bg-classicBlue-50 text-base">
        <i class="fa-solid fa-arrow-right-long"></i>
      </a>
    </div>
  </div>
</li>
