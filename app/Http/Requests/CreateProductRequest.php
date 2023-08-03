<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    //O clasa reprezentativa requestului de formular
    //A class reprezentative of a request made through a form

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //If the user is logged in then he can make this request
        //Daca utilizatorul este autentificat, atunci poate face requestul 
        return \Auth::check();
    }

    //regulile dupa care se face validarea
    //rules used in validation
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "name" => "string|min:1|max:255",
            "description" => "string|min:1|max:255",
            "price" => "numeric|min:1|max:999",
            "quantity" => "numeric|min:1|max:999",
            "productImages" => "nullable|array",
            "productImages.*" => "file|image"
        ];
    }
}