<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        dd($this->request->all());
        $rules = [
            'name' => 'required|max:255',
            'tags' => 'max:255',
            'time' => '',
        ];
        $request = $this->request->all();
        foreach ($request['questions'] as $questionKey => $questionVal) {
            $rules['questions.' . $questionKey . '.text'] = '';
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
        return ($rules);
    }
}
