<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;
use App\Http\Requests\MovieShowRequest;
use App\Http\Services\Movie\MovieShowService;

class MovieShowController extends Controller
{
    private $movieShowService;

    // public function __construct(MovieShowService $movieShowService)
    // {
    //     $this->movieShowService = $movieShowService;
    // }

    public function __invoke(MovieShowRequest $movie)
    {
        return ($this->movieShowService)($movie);
    }
}
