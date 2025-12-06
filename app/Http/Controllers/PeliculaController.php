<?php

namespace App\Http\Controllers;


// Importamos el modelo y clases necesarias
use App\Models\Pelicula; 
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PeliculaCreateRequest; 
// use App\Http\Requests\Rule;


class PeliculaController extends Controller {
    
    public function index():View{
        // Obtenemos todas las películas para visualizarlas
        $peliculas = Pelicula::all(); 
        return view('pelicula.index', ['peliculas' => $peliculas]);
    }

    
    public function create():View{
        // Devolvemos la vista create con el formulario
        return view('pelicula.create');
    }

   
    public function store(PeliculaCreateRequest $request):RedirectResponse{

        // Validando clave únnica compuesta

        // $rules = [
        //     'titulo' => [
        //         Rule::unique('pelicula')
        //             ->where(function ($query)use ($request) {
        //                 return $query->where('director', $request->titulo);
        //             }),
        //     ],
        // ];

        // $validator = Validator::make($request->all(), $rules. []);
        // if($validator->fails()) {
        //     $messages = [
        //         'titulo' => 'clave unica violada',
        //         'director' => 'clave unica violada'
        //     ];
        //     return back()->withInputs()->withErrors($messages);
        // }
        
        // Creamos un nuevo objeto Pelicula con los datos del request
        $pelicula = new Pelicula($request->all());
        $result = false;
        $txtmessage = "";

        // Intentamos guardar la película
        try {
            $result = $pelicula->save(); 
            $txtmessage = "La película se ha añadido correctamente.";

            // Si me llega la portada, la subo y la guardo
            if($request->hasFile('portada')) {
                $ruta = $this->uploadPortada($request, $pelicula);
                $pelicula->portada = $ruta;
                $pelicula->save();
            }
            
        } catch(UniqueConstraintViolationException $e){
            // Error por clave duplicada
            $txtmessage = "Clave duplicada: Ya existe una película con esa información.";
        } catch(QueryException $e){
            $txtmessage = "Error en la base de datos: Valor nulo o incorrecto.";
        }catch (\Exception $e){
            // Cualquier error no capturado
            $txtmessage = "Error Fatal al guardar la película";
        }

        $message = [
            "mensajeTexto" => $txtmessage,
        ];

        // Redirigimos con el mensaje
        if($result){
            return redirect()->route('main')->with($message);
        }else{
            return back()->withInput()->withErrors($message);
        }
    }

    private function uploadPortada(Request $request, Pelicula $pelicula):string {

        $portada = $request->file('portada');
        // Usamos el ID de la película como nombre de archivo para evitar duplicados
        $name = $pelicula->id . "." . $portada->getClientOriginalExtension();

        // Guardamos en la carpeta 'portadas'
        $ruta = $portada->storeAs('portadas', $name, 'public');

        return $ruta;
    }


   
    public function show(Pelicula $pelicula):View{
        return view('pelicula.show', ['pelicula' => $pelicula]);
    }

    /**
     * Muestra el formulario de edición con la información de la película.
     */
    public function edit(Pelicula $pelicula):View{
        return view('pelicula.edit', ['pelicula' => $pelicula]);
    }

    /**
     * Actualiza la información editada de una película.
     */
    public function update(Request $request, Pelicula $pelicula): RedirectResponse{

        // Validando clave únnica compuesta

        // $rules = [
        //     'titulo' => [
        //         Rule::unique('pelicula')
        //             ->where(function ($query)use ($request) {
        //                 return $query->where('director', $request->titulo);
        //             }),
        //     ],
        // ];

        // $validator = Validator::make($request->all(), $rules. []);
        // if($validator->fails()) {
        //     $messages = [
        //         'titulo' => 'clave unica violada',
        //         'director' => 'clave unica violada'
        //     ];
        //     return back()->withInputs()->withErrors($messages);
        // }

        // Lógica para eliminar portada existente
        if($request->deleteImage == 'true' && $pelicula->portada) {
            // Borrado del archivo de portada
            Storage::delete($pelicula->portada);
            
            // La ponemos como nula en la base de datos
            $pelicula->portada = null;
        }

        $result = false;
        $pelicula->fill($request->all());
        $txtmessage = "";

        // Intentamos actualizar y manejar archivos
        try {
            // Subir nueva portada si se proporciona
            if($request->hasFile('portada')) {
                // Opcional: Eliminar la portada antigua antes de subir la nueva
                if ($pelicula->portada) {
                    $ruta = $this->uploadPortada($request, $pelicula);
                    $pelicula->portada = $ruta;
                }
                
            }

            $result = $pelicula->save();
            $txtmessage = "La película se ha actualizado correctamente.";
        } catch(UniqueConstraintViolationException $e) {
            $txtmessage = "Clave duplicada: Ya existe una película con esa información.";
        } catch(QueryException $e) {
            $txtmessage = "Error en la base de datos: Valor nulo o incorrecto.";
        }catch (\Exception $e) {
            $txtmessage = "Error fatal al actualizar la película.";
        }

        $message = [
            "mensajeTexto" => $txtmessage,
        ];

        if($result){
            return redirect()->route('main')->with($message);
        }else{
            return back()->withInput()->withErrors($message);
        }
    }

    public function destroy(Pelicula $pelicula): RedirectResponse {

        try{
            // Opcional: Borrar portada de storage antes de eliminar el registro
            if ($pelicula->portada) {
                 Storage::delete($pelicula->portada);
            }

            $result = $pelicula->delete();
            $textmessage='La película se ha eliminado.';
        }
        catch(\Exception $e){
            $result = false;
            $textmessage='Error al eliminar la película.';
        }
        
        $message = [
            'mensajeTexto' => $textmessage,
        ];
        
        if($result){
            return redirect()->route('main')->with($message);
        } else {
            return back()->withInput()->withErrors($message);
        }
    }
}