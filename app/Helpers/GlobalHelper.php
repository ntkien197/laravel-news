<?php

namespace App\Helpers;

use App\Services\LanguageService;
use Illuminate\Support\Facades\File;

class GlobalHelper
{
    public static function getMessageErrorCode($code)
    {
        $messages = json_decode(File::get(app_path('/Helpers/error_code.json')), true);
        return $messages[$code];
    }


    public static function formatLocale($locale) {
        $lang = (new LanguageService())->getByCode($locale);
        return $lang->id;
    }
}
