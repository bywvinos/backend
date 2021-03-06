<?php

namespace App\Http\Controllers\Web\Barrica;

use App\Barrica;
use App\BarricaBodega;
use App\Bodega;
use App\Http\Controllers\Controller;
use App\Productor;
use App\Uva;
use App\Vinicola;
use Illuminate\Http\Request;

class BarricaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $barricas = Barrica::orderBy('uva','asc')->paginate(5);

        return view('barrica.index',['barricas'=>$barricas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $vinicolas = Vinicola::orderBy('nombre','asc')->get();
        $bodegas = Bodega::orderBy('nombre','asc')->get();
        $uvas = Uva::orderBy('title','asc')->get();
        $edit = false;
        return view('barrica.form',['vinicolas'=>$vinicolas,'bodegas'=>$bodegas,'edit'=>$edit, 'uvas'=>$uvas]);
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
        // 
        $rules = [
            'producido'=>'required',
            'productor'=>'required|integer',
            'tipo_bar'=>'required',
            'tostado'=>'required',
            'uva'=>'required',
            "costo_uva" => "required|numeric",
            "costo_barrica" => "required|numeric",
            "costo_prod" => "required|numeric",
            "anada" => "required",
            "fecha_inicio" => "required|date",
            "meses_barrica" => "required|integer",
            "fecha_embotellado" => "required|date",
            "meses_estabilizacion" => "required|integer",
            "fecha_envio" => "required|date",
            "costo_total" => "required|numeric"
        ];

        $this->validate($request,$rules);

        Barrica::create([
            // 'producido'=>$request->producido,
            'enologo_id'=>$request->productor,
            'tipo_bar'=>$request->tipo_bar,
            'tostado'=>$request->tostado,
            'uva'=>$request->uva,
            'bodega_id'=>$request->bodega_id,
            'vinicola_id'=>$request->vinicola_id,
            'fecha_inicio'=>$request->fecha_inicio,
            'fecha_embotellado'=>$request->fecha_embotellado,
            'meses_barrica'=>$request->meses_barrica,
            'meses_estabilizacion'=>$request->meses_estabilizacion,
            'costo_uva'=>$request->costo_uva,
            'costo_barrica'=>$request->costo_barrica,
            'costo_prod'=>$request->costo_prod,
            'costo_total'=>$request->costo_total,
            'fecha_envio'=>$request->fecha_envio,
            'anada'=>$request->anada,
            'utilidad'=>$request->utilidad,
            'precio_publico'=>$request->precio_final
        ]);
        $barrica_exist=BarricaBodega::where([
            ['bodega_id',$request->bodega_id],
            ['tipo',$request->tipo_bar],
            ['tostado',$request->tostado]
        ])->first();

        // if($barrica_exist->count() > 0){
        // // dd($barrica_exist);
        //     // dd($barrica_exist);
        //     $barrica_exist->cantidad = $barrica_exist->cantidad == 0 ? 0 : $barrica_exist->cantidad -1;
        //     $barrica_exist->save();
        // }
        // else{
            BarricaBodega::create([
                'bodega_id'=>$request->bodega_id,
                'tipo'=>$request->tipo_bar,
                'tostado'=>$request->tostado,
                'cantidad'=>0,
                'costo'=>$request->costo_barrica
            ]);
        // }
        return redirect()->route('barricas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Barrica  $barrica
     * @return \Illuminate\Http\Response
     */
    public function show(Barrica $barrica)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Barrica  $barrica
     * @return \Illuminate\Http\Response
     */
    public function edit(Barrica $barrica)
    {
        //
        // dd($barrica);
        $edit=true;
        return view('barrica.form',['edit'=>$edit,'barrica'=>$barrica]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Barrica  $barrica
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barrica $barrica)
    {
        //
        $rules = [
            "costo_uva" => "required|numeric",
            "costo_barrica" => "required|numeric",
            "costo_prod" => "required|numeric",
            "anada" => "required",
            "fecha_inicio" => "required|date",
            "meses_barrica" => "required|integer",
            "fecha_embotellado" => "required|date",
            "meses_estabilizacion" => "required|integer",
            "fecha_envio" => "required|date",
            "costo_total" => "required|numeric"
        ];

        $this->validate($request,$rules);
        $this->validate($request,$rules);
        $barrica->update([
            'fecha_inicio'=>$request->fecha_inicio,
            'fecha_embotellado'=>$request->fecha_embotellado,
            'meses_barrica'=>$request->meses_barrica,
            'meses_estabilizacion'=>$request->meses_estabilizacion,
            'costo_uva'=>$request->costo_uva,
            'costo_barrica'=>$request->costo_barrica,
            'costo_prod'=>$request->costo_prod,
            'costo_total'=>$request->costo_total,
            'fecha_envio'=>$request->fecha_envio,
            'anada'=>$request->anada,
            'utilidad'=>$request->utilidad,
            'precio_publico'=>$request->precio_final
        ]);
        return redirect()->route('barricas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Barrica  $barrica
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barrica $barrica)
    {
        //
        $barrica->delete();
        return redirect()->route('barricas.index');
    }
}
