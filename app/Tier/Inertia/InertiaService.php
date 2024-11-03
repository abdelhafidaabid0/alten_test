<?php

namespace App\Tier\Inertia;

use Inertia\Inertia;
use Inertia\Response;

class InertiaService {

    public static function render_page($domaine, $name, $params = []) : Response {
        return Inertia::render("Pages/$domaine/$name", $params);
    }
}