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
            'name' => 'required|string|max:255', // Check
            'tags' => 'nullable|string|max:255', // Check
            'time' => 'numeric|min:0|max:999', // Check
            'description' => 'nullable|string|max:1500', // Check
            'options' => 'array|in:detailedResults,publicResults|max:2', // Check
            'questions' => 'required|array', // Check
        ];

        $request = $this->request->all();
        if (!array_key_exists('questions', $request)) {
            return ($rules);
        }
        foreach ($request['questions'] as $questionKey => $questionVal) {
            if ($questionKey === array_key_first($request['questions'])) {
                $rules['questions.' . $questionKey] = 'required|array'; // Check
            }
            $rules['questions.' . $questionKey . '.text'] = 'required|string|max:1500'; // Check
            $rules['questions.' . $questionKey . '.points'] = 'required|numeric|min:0|max:99'; // Check
            $rules['questions.' . $questionKey . '.type'] = 'required|string|in:oneVariant,multiVariant,text'; // Check
            $rules['questions.' . $questionKey . '.answers'] = 'required|array';


            if ($questionVal['type'] == 'oneVariant') {
                $rules['questions.' . $questionKey . '.correct'] = 'required|numeric|min:0';
            } elseif ($questionVal['type'] == 'multiVariant') {
                $rules['questions.' . $questionKey . '.correct'] = 'required|array|min:1';
                $rules['questions.' . $questionKey . '.correct.*'] = 'numeric|min:0';
            } // Check

            if (!array_key_exists('answers', $questionVal)) {
                return ($rules);
            }
            foreach ($questionVal['answers'] as $answerKey => $answerVal) {
                if ($answerKey === array_key_first($questionVal['answers'])) {
                    $rules['questions.' . $questionKey . '.answers.' . $answerKey] = 'required|array'; // Check
                }
                $rules['questions.' . $questionKey . '.answers.' . $answerKey . '.text'] = 'required|string|max:255'; //Check
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
