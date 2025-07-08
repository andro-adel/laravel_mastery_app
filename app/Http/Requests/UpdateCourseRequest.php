<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateCourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * تحديد ما إذا كان المستخدم مخولاً لتنفيذ هذا الطلب
     */
    public function authorize(): bool
    {
        // Only admin or instructor can update a course | فقط المدير أو المدرس يمكنهم تعديل دورة
        return Auth::user() && Auth::user()->hasRole(['admin', 'instructor']);
    }

    /**
     * Get the validation rules that apply to the request.
     * جلب قواعد التحقق المطلوبة لهذا الطلب
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255', // Course title | عنوان الدورة
            'description' => 'required|string', // Course description | وصف الدورة
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Featured image | صورة الدورة
            'status' => 'required|in:draft,published', // Course status | حالة الدورة
        ];
    }
}
