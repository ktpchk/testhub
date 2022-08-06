<div class="flex items-start space-x-2 mb-12 question" id="question_">
  <div class="flex flex-col space-y-2">
    <div class="w-6 h-6 border-2 border-classicBlue-300 flex items-center justify-center">
      <span class="questionNumber">0</span>
    </div>
    <button type="button"
      class="w-6 h-6 border-2 border-classicBlue-300 hover:bg-classicPink-700 flex items-center justify-center cursor-pointer deleteQuestion">
      <i class="fa-solid fa-trash-can"></i>
    </button>
    <div>
      <button type="button"
        class="w-6 h-6 -mb-0.5 border-2 border-classicBlue-300 hover:bg-classicPink-700 flex items-center justify-center moveUp">
        <i class="fa-solid fa-angle-up"></i>
      </button>
      <button type="button"
        class="w-6 h-6 -mb-0.5 border-2 border-classicBlue-300 hover:bg-classicPink-700 flex items-center justify-center moveDown">
        <i class="fa-solid fa-angle-down"></i>
      </button>
    </div>

  </div>
  <div class="w-full">
    <div class="errorContainer mb-4">
      <textarea class="w-full p-2 border-2 rounded-sm outline-none" rows="9" name="questions[][text]"
        placeholder="Текст вопроса..."></textarea>
    </div>


    <ul class="mb-3">
      <li class="my-2 errorContainer">
        <label class="flex justify-between">
          Число баллов:
          <input type="number" min="0" max="99" class="border-2 rounded-sm outline-none w-12"
            value="5" name="questions[][points]" />
        </label>
      </li>
      <li class="errorContainer">
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
      <ul class="space-y-4 flex flex-col errorContainer">

        <button
          class="self-end hover:text-classicBlue-200 hover:underline text-classicBlue-900 cursor-pointer answerAdder"
          type="button">
          Добавить ответ
        </button>
      </ul>
    </div>
  </div>
</div>
