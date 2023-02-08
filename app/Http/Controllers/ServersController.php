<?php

namespace App\Http\Controllers;

use App\Imports\ServerImport;
use App\Models\Server;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use League\Csv\Reader;
use Log;
use Maatwebsite\Excel\Facades\Excel;

class ServersController extends Controller
{
    public function index()
    {
        try {
            $servers = Server::
            storage(request('storage'))
                ->ram(request('ram'))
                ->location(request('location'))
                ->paginate(request('per_page'));

            return response()->json([$servers]);
        } catch (Exception $exception) {
            Log::error($exception);
            throw new ModelNotFoundException();
        }
    }

    /**
     * @throws Exception
     */
    public function import(Request $request){
        try {
            Excel::import(new ServerImport(),
                $request->file('file')->store('files'));
            return response()->json(['response' => 'xlxs imported'], 201);
        } catch (Exception $exception) {
            Log::error($exception);
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function clear()
    {
        try {
            Server::truncate();
            return response()->json(['response' => 'files cleared'], 204);
        } catch (Exception $exception) {
            Log::error($exception);
            throw new Exception($exception->getMessage());
        }
    }
}
