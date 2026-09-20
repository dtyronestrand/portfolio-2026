<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Media;

class MediaController extends Controller
{
  public function store(Request $request)
  {
    $file = $request->file('file');
    $file->store('media/' . now()->format('Y') . '/' . now()->format('m'), 'public');

    $media = Media::create([
        'filename' => $file->hashName(),
        'mime_type' => $file->getMimeType(),
        'size' => $file->getSize(),
    ]);

    return response()->json(['media' => $media->id], 201);
    // Create a new Media record in the database

  }

  public function destroy (Media $media)
  {
    Storage::disk('public')->delete('media/' . now()->format('Y') . '/' . now()->format('m') . '/' . $media->filename);
  $media -> delete();

  return response()->json(['message' => 'Media deleted successfully'], 200);
    }
}