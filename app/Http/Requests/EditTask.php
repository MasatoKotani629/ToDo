<?php

namespace App\Http\Requests;

use App\Task;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EditTask extends CreateTask
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $rule = parent::rules();

        $status_rule = Rule::in(array_keys(Task::STATUS));
        // -> 'in(1, 2, 3)' を出力する

        return $rule + [
            'status' => 'required|' . $status_rule,
        ];
    }

    public function attributes()
    {
        $attributes = parent::attributes();

        return $attributes + [
            'status' => '状態',
        ];
    }

    public function messages()
    {
        $messages = parent::messages();

        $status_labels = array_map(function($item) {
            return $item['label'];
        }, Task::STATUS);

        //配列の要素を 第一引数 文字列で連結します。
        $status_labels = implode('、', $status_labels);

        return $messages + [
            'status.in' => ':attribute には ' . $status_labels. ' のいずれかを指定してください。',
        ];
    }
}
