<?php

/*
|--------------------------------------------------------------------------
| Validation Language Lines
|--------------------------------------------------------------------------
|
| The following language lines contain the default error messages used by
| the validator class. Some of these rules have multiple versions such
| as the size rules. Feel free to tweak each of these messages here.
|
*/

return [

    'array'                => 'Неверный формат.',
    'numeric'              => 'Неверный формат.',
    'string'               => 'Неверный формат.',

    'in'                   => 'Выбранное значение ошибочно.',

    'max'                  => [
        'numeric' => '":attribute" не может быть больше :max.',
        'string'  => 'Количество символов в ":attribute" не может превышать :max.',
    ],
    'min'                  => [
        'numeric' => '":attribute" должно быть не меньше :min.',
        'string'  => 'Количество символов в ":attribute" должно быть не меньше :min.',
    ],
    'required'             => 'Поле ":attribute" обязательно для заполнения.',

    'custom'               => [
        'name' => [
            'required' => 'Имя теста обязательно для заполнения.',
        ],

        'questions.*.answers' => [
            'required' => 'У вопроса должен быть хотя бы один ответ.',
        ],
        'questions.*.answers.*.text' => [
            'required' => 'Текст ответа не может быть пустым.',
            'max' => 'Текст ответа должен быть короче :max символов.',
        ],
        'questions.*.answers.*' => [
            'required' => 'У вопроса должен быть хотя бы один ответ.',
        ],

        'questions' => [
            'required' => 'В тесте должен быть хотя бы один вопрос.',
        ],
        'questions.*.text' => [
            'required' => 'Текст вопроса не может быть пустым.',
            'max' => 'Текст вопроса должен быть короче :max символов.',
        ],
        'questions.*.points' => [
            'required' => 'Количество баллов обязательно для заполнения.',
            'min' => 'Количество баллов не может быть меньше :min.',
            'max' => 'Количество баллов не может быть больше :max.',
        ],
        'questions.*.type' => [
            'required' => 'Необходимо выбрать тип вопроса.',
        ],
        'questions.*.correct' => [
            'required' => 'Должен быть выбран хотя бы один правильный ответ.',
            'min' => 'Неверный формат.',
        ],
        'questions.*.correct.*' => [
            'min' => 'Неверный формат.',
        ],


        'questions.*' => [
            'required' => 'В тесте должен быть хотя бы один вопрос.',
        ],

    ],
    'attributes'           => [
        'time' => 'Время',
        'name' => 'Имя теста',
        'description' => 'Предисловие',
        'tags' => 'Теги'
    ],
];
