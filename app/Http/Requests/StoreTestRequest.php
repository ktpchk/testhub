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
            'name' => 'required|string|max:255',
            'tags' => 'nullable|string|max:255',
            'time' => 'numeric|min:0|max:999',
            'description' => 'nullable|string|max:1500',
            'options' => 'array|in:detailedResults,publicResults|max:2',
            'questions' => 'required|array',
        ];

        $request = $this->request->all();
        foreach ($request['questions'] as $questionKey => $questionVal) {
            if ($questionKey === array_key_first($request['questions'])) {
                $rules['questions.' . $questionKey] = 'required|array';
            }
            $rules['questions.' . $questionKey . '.text'] = 'required|string|max:1500';
            $rules['questions.' . $questionKey . '.points'] = 'required|numeric|min:0|max:99';
            $rules['questions.' . $questionKey . '.type'] = 'required|string|in:oneVariant,multiVariant,text';
            $rules['questions.' . $questionKey . '.answers'] = 'required|array';


            if ($questionVal['type'] == 'oneVariant') {
                $rules['questions.' . $questionKey . '.correct'] = 'required|numeric|min:0';
            } elseif ($questionVal['type'] == 'multiVariant') {
                $rules['questions.' . $questionKey . '.correct'] = 'required|array';
                $rules['questions.' . $questionKey . '.correct.*'] = 'numeric|min:0';
            }

            foreach ($questionVal['answers'] as $answerKey => $answerVal) {
                if ($answerKey === array_key_first($questionVal['answers'])) {
                    $rules['questions.' . $questionKey . '.answers.' . $answerKey] = 'required|array';
                }
                $rules['questions.' . $questionKey . '.answers.' . $answerKey . '.text'] = 'required|string|max:255';
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
