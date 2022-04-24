<?php

namespace App\Rules;

use App\Models\Comment;
use Illuminate\Contracts\Validation\Rule;

class IsCommentHasTwoAncestors implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // auto pass if it's root comment.
        if (is_null($value)) {
            return true;
        }

        return (Comment::find($value)->ancestors()->get()->count() < 2);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Unable to add comment';
    }
}
