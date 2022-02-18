<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;
use App\Http\Services\Movie\MovieIndexService;

class MovieIndexController extends Controller
{
    private $movieIndexService;

    public function __construct(MovieIndexService $movieIndexService)
    {
        $this->movieIndexService = $movieIndexService;
    }

    public function __invoke()
    {
        return ($this->movieIndexService);
    }
}
