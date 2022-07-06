<ul class="flex text-xs space-x-2 w-full">
  @foreach (explode(', ', $test->tags) as $tag)
    <li class="bg-black text-classicPink-500 p-1 rounded-full hover:underline">
      <a href="">
        {{ $tag }}
      </a>
    </li>
  @endforeach
</ul>
