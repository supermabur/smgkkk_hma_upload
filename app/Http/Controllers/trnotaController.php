<?php

namespace App\Http\Controllers;

use App\trnota;
use Illuminate\Http\Request;
use App\Photo;

class trnotaController extends Controller
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

        // $image_data = base64_decode(request()->input('input-file'));




        $form_data = [
            'kdproject' => 'xxx',
            'jenis' => $request->jenis,
            // 'nota' => $image_data
        ];

        
        $tmp = trnota::updateOrCreate(['id' => $request->hidden_id_detail], $form_data); 

        // $path = $request->file('input-file')->getRealPath();    
        // $logo = file_get_contents($path);
        // $base64 = base64_encode($logo);
        // $tmp->nota = $base64;
        // $tmp->save();

        $image = request()->file('input-file');
        $image_data = file_get_contents($image);
        $tmp->nota = $image_data;
        $tmp->save();


        return response()->json(['success' => 'oke', 'formdata' => $form_data]);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\trnota  $trnota
     * @return \Illuminate\Http\Response
     */
    public function show(trnota $trnota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\trnota  $trnota
     * @return \Illuminate\Http\Response
     */
    public function edit(trnota $trnota)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\trnota  $trnota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, trnota $trnota)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\trnota  $trnota
     * @return \Illuminate\Http\Response
     */
    public function destroy(trnota $trnota)
    {
        //
    }
}
