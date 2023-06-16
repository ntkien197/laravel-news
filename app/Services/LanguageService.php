<?php

namespace App\Services;

use App\Models\Language;
use Illuminate\Support\Facades\Lang;

class LanguageService
{
    public function getList($request){
        return Language::all();
    }

    public function getByCode($code) {
        // đthấy sao cu em để chi d
        return Language::whereCode($code)->first();
}
}
