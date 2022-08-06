<tr>
  <td class="pt-2 text-xl">
    <a href="/tests/{{ $test->id }}" class="text-classicBlue-900 hover:text-classicBlue-100">
      {{ $test->name }}
    </a>
    @if ($test->tags)
      <x-taglist :test=$test />
    @endif
  </td>
  <td class="pt-2 text-center text-sm">
    {{ $test->passed }} / {{ $test->tried }}
  </td>
  <td class="text-center pt-2">
    <a href="/tests/{{ $test->id }}"
      class="inline-block px-2 py-1 rounded-full bg-classicBlue-300 text-classicPink-300 hover:bg-classicBlue-50 text-base">
      <i class="fa-solid fa-arrow-right-long"></i>
    </a>
  </td>
</tr>
