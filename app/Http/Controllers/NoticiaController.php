<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;
use App\Http\Requests\NoticiaCreateRequest;
use App\Http\Requests\NoticiaEditRequest;

class NoticiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $noticias = Noticia::all();
        return view('backend.noticia.index', ['noticias' => $noticias]);
    }
    
    function paginate(Request $request) {
        // $search = $request->input('search');
        // $rpp = 3;
        // if($request->has('rpp') && is_numeric($request->input('rpp'))){
        //     $rpp = $request->input('rpp');
        // }
        // $enterprises = Enterprise::paginate($rpp)->appends(['rpp' => $rpp, 'search' => $search]);
        $order = ['titulo', 'textoNoticia', 'autor', 'fecha'];
        $noticias = new Noticia();
        $search = $request->input('search');
        if($search != null) {
            $noticias = $noticias->where('titulo', 'like', '%' . $search . '%')
                                 ->orWhere('textoNoticia', 'like', '%' . $search . '%')
                                 ->orWhere('autor', 'like', '%' . $search . '%')
                                 ->orWhere('fecha', 'like', '%' . $search . '%');
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
            $noticias = $noticias->orderBy($orderby, $sort);
        }
        $paginationParameters = ['search' => $search, 'orderby' => $orderby, 'sort' => $sort];
        $noticias = $noticias->orderBy('titulo', 'asc')->paginate(10)->appends($paginationParameters);
        //dd($noticias);
        return view('backend.noticia.paginate', array_merge(['noticias' => $noticias], $paginationParameters));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.noticia.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoticiaCreateRequest $request)
    {
        $all = $request->validated();
        $noticia = new Noticia($all);
        try {
            $result = $noticia->save();
        } catch(\Exception $e) {
            $result = 0;
        }
        
        if($noticia -> id > 0) {
            $response = ['op' => 'create', 'r' => $result, 'id' => $noticia->id];
            return redirect('backend/noticia')->with($response);
        } else {
            return back() -> withInput()->with(['error' => 'algo ha fallado']);
            //return back() -> withInput()->withErrors(['error' => 'algo ha fallado']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Noticia  $noticia
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $noticia = Noticia::find($id);
        $path = public_path('portada'); // /var/www/html/laraveles/Noticia/public/portada/
        $files = \File::files($path); // 2.jpg, 3, 4
        $portada = 'portada.png';
        foreach($files as $file) {
            $filename = pathinfo($file, PATHINFO_FILENAME); //2, 3, 4
            if($filename == $noticia->id){
                $logo = $file->getFileName();
                break;
            }
        }
        return view('backend.noticia.show', ['noticia' => $noticia, 'portada' => $portada]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Noticia  $noticia
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $noticia = Noticia::find($id);
        return view('backend.noticia.edit', ['noticia' => $noticia]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Noticia  $noticia
     * @return \Illuminate\Http\Response
     */
    public function update(NoticiaEditRequest $request, Noticia $noticia, $id)
    {
        $public = $this->uploadFile($request, $noticia->id);
        $noticia = Noticia::find($id);
        try {
            $result = $noticia->update($request->validated());
        } catch(\Exception $e) {
            $result = 0;
        }
        
        if($result > 0) {
            $response = [
                'op' => 'update',
                'r' => $result, 
                'id' => $noticia->id,
                'public' => $public,
                // 'private' => $private,
            ];
            return redirect('backend/noticia')->with($response);
        } else {
            return back() -> withInput()->withErrors(['error' => 'algo ha fallado']);
        }
    }
    
    private function uploadFile(Request $request, $id) {
        if($request->hasFile('portada') && $request->file('portada')->isValid()) {
            $file = $request->file('portada'); // $request->file    
            $target = 'portada/';
            
            //Extension
            $img = $file->getClientOriginalName();
            $extension = pathinfo($img, PATHINFO_EXTENSION);
            
            $name = $id . '.' . $extension; //date('YmdHis') . $file->getClientOriginalName();
            $file->move($target, $name);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Noticia  $noticia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Noticia $noticia, $id)
    {
        $noticia = Noticia::find($id);
        $id = $noticia->id;
        try {
            $result = $noticia->delete();
        } catch(\Exception $e) {
            $result = 0;
        }
        
        $response = ['op' => 'destroy', 'r' => $result, 'id' => $id];
        return redirect('backend/noticia')->with($response);
    }
}