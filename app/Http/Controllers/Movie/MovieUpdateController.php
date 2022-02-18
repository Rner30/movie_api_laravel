<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;
use App\Http\Requests\Movie\MovieUpdateRequest;
use App\Http\Services\Movie\MovieUpdateService;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieUpdateController extends Controller
{
    private $movieUpdateService;

    public function __construct(MovieUpdateService $movieUpdateService) {
        $this->movieUpdateService = $movieUpdateService;
    }

    public function __invoke(Request $request, $movie)
    {
        $findMovie = Movie::query()->find($movie);

        if (!isset($findMovie)) {
            return response()->json([
                'msg' => 'Pelicula no existente con ese id'
            ],404);
        }
        return ($this->movieUpdateService)($request,$findMovie);
    }
}
