<form action="{{ parse_url(url()->current(), PHP_URL_PATH) }}" class="mb-2" method="GET">
  <div class="relative flex items-center">
    <label for="search" class="absolute left-3 z-10">
      <i class="fa fa-search text-gray-400 z-20 hover:text-gray-500"></i>
    </label>
    <input id="search" type="text" name="search" value="{{ $searchValue ?? '' }}"
      class="w-full pl-9 pr-24 py-1 rounded-sm border-2 outline-none" placeholder="Название или тема..." />
    <div class="">
      <button type="submit"
        class="py-1.5 px-3 ml-2 rounded-full bg-classicBlue-300 text-classicPink-300 hover:bg-classicBlue-50">
        Поиск
      </button>
    </div>
  </div>
</form>
