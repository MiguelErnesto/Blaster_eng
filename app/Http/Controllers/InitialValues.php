<?php

use App\Models\main;
use App\Models\front_preview;
use App\Models\navbar;
use Illuminate\Support\Facades\Schema;

if (! Schema::hasTable('mains')) {
    return;
}

$main = main::first();
if (! $main) {
    return;
}

config(['app.nombre_principal' => $main->name]);

$frontPreview = front_preview::first();
$defaultPreview = rtrim((string) config('app.front_preview_url'), '/').'/';
$stored = trim((string) ($frontPreview->url ?? ''));
$useDefault = $stored === '' || str_contains($stored, 'localhost');
config(['app.front_url' => $useDefault ? $defaultPreview : $stored]);

$navbar = navbar::first();
if (! $navbar) {
    return;
}

config(['app.nav_section1' => $navbar->item1]);
config(['app.nav_section2' => $navbar->item2]);
config(['app.nav_section3' => $navbar->item3]);
config(['app.nav_section4' => $navbar->item4]);
config(['app.nav_section5' => $navbar->item5]);
config(['app.nav_section6' => $navbar->item6]);

config(['app.nav_chk1' => $navbar->chk1]);
config(['app.nav_chk2' => $navbar->chk2]);
config(['app.nav_chk3' => $navbar->chk3]);
config(['app.nav_chk4' => $navbar->chk4]);
config(['app.nav_chk5' => $navbar->chk5]);
config(['app.nav_chk6' => $navbar->chk6]);
