<?php

namespace App\Rules;

use Illuminate\Validation\Rule;

class CustomEmailRule implements Rule
{
    public function passes($attribute, $value)
    {
        // Check if the email contains the "@student.gmi.edu.my" domain
        return strpos($value, '@student.gmi.edu.my') !== false;
    }

    public function message()
    {
        return 'The :attribute must be a valid email with @student.gmi.edu.my domain.';
    }
}


            /* <div class="mb-6">
              <label for="image_1" class="inline-block text-lg mb-2">
                Image 1
              </label>
              <input type="file" class="border border-gray-200 rounded p-2 w-full" name="image_1" />

              @error('image_1')
              <p class="text-red-500 text-xs mt-1">{{$message}}</p>
              @enderror
            </div> */