<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class MailSendCheckRequest extends FormRequest
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
        return [
            'email' => 'required|email',
            'captcha' => 'required',
            'scene' => 'required|in:signup,bind,reset',
        ];
    }

    /**
     * @return string[]
     * @author:阿文
     * @date:2024/3/7 23:41
     */
    public function messages()
    {
        return [
            'email.required' => '邮箱不能为空',
            'email.regex' => '邮箱格式不正确',
            'captcha.required' => '验证码不能为空',
            'scene.required' => '类型不能为空',
            'scene.in' => '类型值不合法',
        ];
    }

    /**
     * @param Validator $validator
     * @return \Illuminate\Http\JsonResponse|void
     * @author:阿文
     * @date:2024/3/7 23:58
     */
    protected function failedValidation(Validator $validator)
    {
        throw  new HttpResponseException(response()->json([
            'code'=>500,
            'message' => $validator->errors()->first(),
        ]));
    }
}
