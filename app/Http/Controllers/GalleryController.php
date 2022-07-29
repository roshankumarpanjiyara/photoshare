<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Album;
use App\Models\User;
class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $albumBelongsToUser = Album::where('user_id', auth()->user()->id)->where('id',$id)->exists(); //particular id belong to the user id can only upload otherwise redirect back to the page
        if($albumBelongsToUser){
            $album_id = $id;
            session()->put('id',$id);
            return view('image.create',compact('album_id'));
        }else{
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = Image::find($id);
        return $image->delete();
    }

    public function upload(Request $request){
        $this->validate($request,[
            'files' => 'required',
            'files.*' => 'mimes:png,jepg,jpg'
        ]);
        foreach($request->file('files') as $file){
            $name = $file->hashName();
            $file->move(public_path().'/images/',$name);
            $file = new Image;
            $file->album_id = $request->album_id;
            $file->image = $name;
            $file->save();
        }
        return response()->json(['success'=> 'Your Image successfully uploaded']);
    }

    public function images(){
        return Image::where('album_id',session()->get('id'))->get();
    }

    public function viewAlbum($slug,$id){
        $albums = Album::with('albumimages')->where('slug',$slug)->where('id',$id)->get();
        if(\Auth::check()){
            $userId = Album::where('id',$id)->first()->user_id;
            $follows = (new User)->amIfollowing($userId);
            return view('album.show',compact('albums','follows','userId'));
        }
        return view('album.show',compact('albums'));
    }
}
