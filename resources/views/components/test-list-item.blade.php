<tr>
  <td class="pt-2 text-xl">
    <a href="" class="text-classicBlue-900 hover:text-classicBlue-100">
      {{ $test->name }}
    </a>
    <x-taglist :test=$test />
  </td>
  <td class="pt-2 text-center">
    {{ $test->passed }} / {{ $test->tried }}
  </td>
  <td class="text-center pt-2">
    <a href=""
      class="inline-block px-2 py-1 rounded-full bg-classicBlue-300 text-classicPink-300 hover:bg-classicBlue-50 text-base">
      <i class="fa-solid fa-arrow-right-long"></i>
    </a>
  </td>
</tr>
