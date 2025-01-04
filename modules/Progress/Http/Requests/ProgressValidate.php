<?php

namespace Modules\Progress\Http\Requests;

use Modules\Support\Http\Requests\Request;

class ProgressValidate extends Request
{
    public function rules(): array
    {
        return [
            'count' => 'required',
            'date' => 'required',
        ];
    }
}
