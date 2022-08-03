<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;


class StoreTestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // dd($this->request->all());
        $rules =  [
            'name' => 'required|max:255',
            'tags' => 'max:255',
            'time' => '',
        ];

        $request = $this->request->all();
        foreach ($request['questions'] as $questionKey => $questionVal) {
            $rules['questions.' . $questionKey . '.text'] = 'required';
            $rules['questions.' . $questionKey . '.points'] = '';
            $rules['questions.' . $questionKey . '.type'] = '';
            if (array_key_exists('correct', $questionVal)) {
                if (is_array($questionVal['correct'])) {
                    $rules['questions.' . $questionKey . '.correct'] = 'array';
                } else {
                    $rules['questions.' . $questionKey . '.correct'] = 'max:255';
                }
            }
            foreach ($questionVal['answers'] as $answerKey => $answerVal) {
                $rules['questions.' . $questionKey . '.answers.' . $answerKey . '.text'] = '';
            }
        }
        // dd($rules);
        return ($rules);
    }

    protected function failedValidation(Validator $validator)
    {
        if ($validator->fails()) {
            $errors = $validator->errors();

            $response = [];
            foreach ($errors->messages() as $key => $value) {
                $newKey = explode('.', $key);
                $newKey = $newKey[0] . implode('', array_map(function ($item) {
                    return '[' . $item . ']';
                }, array_slice($newKey, 1)));
                $response[$newKey] = $value;
            }
            throw new HttpResponseException(
                response($response, 422)
            );
        }
    }
}
