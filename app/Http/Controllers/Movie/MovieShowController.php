<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;
use App\Http\Requests\MovieShowRequest;
use App\Http\Resources\MovieResource;
use App\Http\Services\Movie\MovieShowService;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieShowController extends Controller
{
    private $movieShowService;

    public function __construct(MovieShowService $movieShowService)
    {
        $this->movieShowService = $movieShowService;
    }

    public function __invoke(Movie $movie)
    {
        return MovieResource::make($movie);
    }
}
