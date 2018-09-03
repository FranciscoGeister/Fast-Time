<?php

namespace App\Http\Controllers;

use App\PersonalFile;
use App\Member;
use App\Size;
use Illuminate\Http\Request;

class PersonalFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize("view",PersonalFile::class);
        $members= Member::all();
        return view('operacion.personal_file_index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\PersonalFile  $personalFile
     * @return \Illuminate\Http\Response
     */
    public function show(PersonalFile $personalFile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PersonalFile  $personalFile
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $personalFile= PersonalFile::where('member_id',$id)->first();
        $this->authorize("update",$personalFile);
        $member= Member::find($id);
        $sizes= Size::all();
        return view('operacion.personal_file_edit', compact('member','sizes','personalFile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PersonalFile  $personalFile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $personalFile= PersonalFile::find($id);
        $this->authorize("update",$personalFile);
        $personalFile->fill($request->all());
        $personalFile->save();
        return redirect('fichaPersonal');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PersonalFile  $personalFile
     * @return \Illuminate\Http\Response
     */
    public function destroy(PersonalFile $personalFile)
    {
        //
    }
}
