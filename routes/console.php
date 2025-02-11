<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('generate-sitemap')->everyFourHours();

Schedule::command('build-assets')->everyFourHours();
