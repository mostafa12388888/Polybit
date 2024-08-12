<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('generate-sitemap')->everyFourHours();
