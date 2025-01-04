<?php

namespace Modules\Project\Http\Requests;

use Modules\Support\Http\Requests\Request;

class ProjectValidate extends Request
{
    public function rules(): array
    {
        return [
            'title' => 'required',
            'description' => 'required'
        ];
    }
}
