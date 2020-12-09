<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use App\Models\Comentario;
use Illuminate\Http\Request;

use App\Http\Requests\ComentarioCreateRequest;

use Illuminate\Support\Facades\DB;

class ComentarioNoticiaController extends Controller
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
    public function store(ComentarioCreateRequest $request, $id)
    {
        $noticias = Noticia::all();
        $noticia = $noticias->where('id', $id);
        $comentario = new Comentario($request->validated());
        try {
            $comentario->idnoticia = $id;
            
            $result = $comentario->save();
        } catch(\Exception $e) {
            $result = 0;
        }
        // dd($result);
        if($comentario -> id > 0) {
            $response = ['op' => 'store', 'r' => $result, 'id' => $comentario->id];
            return redirect('single/' . $id)->with($response);
        } else {
            return back() -> withInput()->with(['error' => 'algo ha fallado']);
            //return back() -> withInput()->withErrors(['error' => 'algo ha fallado']);
        }
        
        
        
        
        // $noticias = Noticia::all();
        // $noticia = $noticias->where('id', $id);
        // $comentario = new Comentario($request->all());
        // // $comentario->name = $request->get('ticketname');
        // dd([$noticia, $comentario]);
        // try {
            
        //     DB::beginTransaction();
            
        //     $noticia->save();
        //     dd('he hecho comit');
        //     if($id > 0) { //while...
                
        //         $comentario->idnoticia = $id;
        //         $result = $comentario->save();
        //         if(!$result) {
        //             DB::rollBack();
        //         }
        //         return redirect('single/' . $id);
        //     }
        //     DB::commit(); //si todo
            
        // } catch(\Exception $e) {
        //     DB::rollBack(); //no todo
        // }
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
        //
    }
}
