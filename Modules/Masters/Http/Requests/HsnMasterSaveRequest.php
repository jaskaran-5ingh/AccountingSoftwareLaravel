<?php

namespace Modules\Masters\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HsnMasterSaveRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'hsn_code' => ['required','unique:hsn_master,hsn_code'],
            'hsn_description' => '',
            'min_amount' => ['required'],
            'gst_min_percentage' => ['required'],
            'gst_max_percentage' => ['required']
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }
}
