<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function getMedia()
    {
        $medias = Media::orderBy('created_at', 'DESC')->paginate(20);
        return view('backend.media')->with('medias', $medias);
    }

    public function add()
    {
        return view('backend.addMedia');
    }

    public function del($id)
    {
        Media::where('id',$id)->delete();
        return redirect()->back();
    }

    public function changeStatus($id, $status)
    {
        Media::where('id', $id)->update(['status' => $status]);
        return redirect()->back();
    }

    

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'media' => "required|file"
        ]);
        $path = $request->file('media')->store('public');
        $url = Storage::url($path);
        $media = new Media();
        $media->title = $request->title;
        $media->url = $url;
        $media->uploaded_by = auth()->id();
        $media->language = $request->lang;
        $media->save();
        return redirect()->route('admin.media');
    }
}
