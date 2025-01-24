<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
<<<<<<< HEAD
})->purpose('Mostrar una frase inspiradora');
=======
})->purpose('Display an inspiring quote')->hourly();
>>>>>>> f7ce9542c7d24e9ef74ada78f0cf3d8fae0bfe31
