<?php

namespace App\Http\Controllers;

use App\Models\FishRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TopController extends Controller
{

    public function __construct()
    {
    }

    public function index()
    {
        $records = FishRecord::query()->orderBy('created_at', 'desc')->get();
        foreach ($records as $record) {
            if ($record->fish_image != NULL) {
                $record->fish_image = Storage::disk('s3')->url($record->fish_image);
            }
        }
        return view('top', ['records' => $records, ]);
    }
}
