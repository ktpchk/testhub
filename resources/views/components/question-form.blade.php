<div class="flex items-start space-x-2 mb-12 question" id="question_">
  <div class="flex flex-col space-y-2">
    <div class="w-6 h-6 border-2 border-classicBlue-300 flex items-center justify-center">
      <span class="questionNumber">0</span>
    </div>
    <div
      class="w-6 h-6 border-2 border-classicBlue-300 hover:bg-classicPink-700 flex items-center justify-center cursor-pointer deleteQuestion">
      <i class="fa-solid fa-trash-can"></i>
    </div>
    <div>
      <div
        class="w-6 h-6 -mb-0.5 border-2 border-classicBlue-300 hover:bg-classicPink-700 flex items-center justify-center cursor-pointer moveUp">
        <i class="fa-solid fa-angle-up"></i>
      </div>
      <div
        class="w-6 h-6 -mb-0.5 border-2 border-classicBlue-300 hover:bg-classicPink-700 flex items-center justify-center cursor-pointer moveDown">
        <i class="fa-solid fa-angle-down"></i>
      </div>
    </div>

  </div>
  <div class="w-full">
    <textarea class="w-full p-2 border-2 rounded-sm outline-none" rows="9" name="questions[][text]"
      placeholder="Текст вопроса..."></textarea>

    @error('questions.*.text')
      <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror

    <ul class="mb-3">
      <li class="my-2">
        <label class="flex justify-between">
          Число баллов:
          <input type="number" min="0" max="99" class="border-2 rounded-sm outline-none w-12"
            value="0" name="questions[][points]" />
        </label>
      </li>
      <li>
        <div class="flex justify-between">
          Тип ответа:
          <div class="space-x-2">
            <label>
              <input hidden checked type="radio" name="questions[][type]" value="oneVariant" class="peer" />
              <span
                class="text-classicBlue-200 text-sm peer-checked:underline peer-checked:text-classicBlue-900 cursor-pointer">Один
                ответ</span>
            </label>
            <label>
              <input hidden type="radio" name="questions[][type]" value="multiVariant" class="peer" />
              <span
                class="text-classicBlue-200 text-sm peer-checked:underline peer-checked:text-classicBlue-900 cursor-pointer">Несколько
                ответов</span>
            </label>
            {{-- <label>
              <input hidden type="radio" name="questions[][type]" value="number" class="peer" />
              <span
                class="text-classicBlue-200 text-sm peer-checked:underline peer-checked:text-classicBlue-900 cursor-pointer">Число</span>
            </label> --}}
            <label>
              <input hidden type="radio" name="questions[][type]" value="text" class="peer" />
              <span
                class="text-classicBlue-200 text-sm peer-checked:underline peer-checked:text-classicBlue-900 cursor-pointer">Текст</span>
            </label>
          </div>
        </div>
      </li>
    </ul>

    <div>
      <ul class="space-y-4 flex flex-col">

        <button
          class="self-end hover:text-classicBlue-200 hover:underline text-classicBlue-900 cursor-pointer answerAdder"
          type="button">
          Добавить ответ
        </button>
      </ul>
    </div>
  </div>
</div>
