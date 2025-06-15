<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    protected function prepareForValidation()
    {
        $this->merge([
            'details' => $this->input('details', null), // ensure 'details' exists, even if null
        ]);
    }
public function rules()
{
    return [
        'report_id' => 'required|array',
        'report_id.*' => 'required|exists:reports,id',
        'mission_id' => 'required|exists:missions,id',
        'details' => [
            function ($attribute, $value, $fail) {
                $reportIds = $this->input('report_id', []);
                // هل تحتوي على 4؟
                if (in_array(4, $reportIds)) {
                    // هل لم يتم إرسال التفاصيل أو كانت فاضية؟
                    if (!$this->has('details') || empty($value)) {
                        $fail(__('The details field is required when report_id includes 4.'));
                    }
                }
            },
        ],
    ];
}

}
