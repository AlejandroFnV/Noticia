<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use App\Models\Comentario;
use App\Http\Requests\ComentarioCreateRequest;
use App\Http\Requests\ComentarioEditRequest;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comentarios = Comentario::all();
        return view('backend.comentario.index', ['comentarios' => $comentarios]);
    }
    
    function paginate(Request $request) {
        // $search = $request->input('search');
        // $rpp = 3;
        // if($request->has('rpp') && is_numeric($request->input('rpp'))){
        //     $rpp = $request->input('rpp');
        // }
        // $enterprises = Enterprise::paginate($rpp)->appends(['rpp' => $rpp, 'search' => $search]);
        $order = ['idnoticia', 'textoComentario', 'fecha', 'correo'];
        $comentarios = new Comentario();
        $search = $request->input('search');
        if($search != null) {
            $comentarios = $comentarios->where('idnoticia', 'like', '%' . $search . '%')
                                 ->orWhere('textoComentario', 'like', '%' . $search . '%')
                                 ->orWhere('fecha', 'like', '%' . $search . '%')
                                 ->orWhere('correo', 'like', '%' . $search . '%');
        }
        $orderby = $request->input('orderby');
        //$orderby = $order[$orderby];
        $sort = 'asc';
        if($orderby != null) {
            if(isset($order[$orderby])) {
                $orderby = $order[$orderby];
            }else {
                $orderby = $order[0];
            }
            if($sort != null) {
                $sort = $request->input('sort');
            }
            $comentarios = $comentarios->orderBy($orderby, $sort);
        }
        $paginationParameters = ['search' => $search, 'orderby' => $orderby, 'sort' => $sort];
        $comentarios = $comentarios->orderBy('idnoticia', 'asc')->paginate(10)->appends($paginationParameters);
        return view('backend.comentario.paginate', array_merge(['comentarios' => $comentarios], $paginationParameters));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $noticias = Noticia::all();
        return view('backend.comentario.create', ['noticias' => $noticias]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ComentarioCreateRequest $request)
    {
        $all = $request->validated();
        $comentario = new Comentario($all);
        //dd($comentario);
        try {
            $result = $comentario->save();
        } catch(\Exception $e) {
            $result = 0;
        }
        
        if($comentario -> id > 0) {
            $response = ['op' => 'store', 'r' => $result, 'id' => $comentario->id];
            return redirect('backend/comentario')->with($response);
        } else {
            return back() -> withInput()->with(['error' => 'algo ha fallado']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comentario  $comentario
     * @return \Illuminate\Http\Response
     */
    public function show(Comentario $comentario)
    {
        // $ticket->enterprise()->name;
        // $ticket->enterprise->name;
        $noticia = $comentario->noticia;
        return view('backend.comentario.show', ['comentario' => $comentario, 'noticia' => $noticia]);
    }
    
    public function verComentarios($idnoticia) {
        $comentarios = Comentario::where('idnoticia', $idnoticia)
                    ->orderBy('id', 'asc')
                    ->get();
        return view('backend.comentario.index', ['comentarios' => $comentarios]); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comentario  $comentario
     * @return \Illuminate\Http\Response
     */
    public function edit(Comentario $comentario)
    {
        $noticias = Noticia::all();
        return view('backend.comentario.edit', ['comentario' => $comentario, 'noticias' => $noticias]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comentario  $comentario
     * @return \Illuminate\Http\Response
     */
    public function update(ComentarioEditRequest $request, Comentario $comentario)
    {
        try {
            $result = $comentario->update($request->validated());
        } catch(\Exception $e) {
            $result = 0;
        }
        
        if($result > 0) {
            $response = ['op' => 'update', 'r' => $result, 'id' => $comentario->id];
            return redirect('backend/comentario')->with($response);
        } else {
            return back() -> withInput()->with(['error' => 'algo ha fallado']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comentario  $comentario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comentario $comentario)
    {
        $id = $comentario->id;
        try {
            $result = $comentario->delete();
        } catch(\Exception $e) {
            $result = 0;
        }

        $response = ['op' => 'destroy', 'r' => $result, 'id' => $id];
        return redirect('backend/comentario')->with($response);
    }
}
