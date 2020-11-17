<?php

namespace App\Http\Controllers;

use App\Models\registro;

use App\Http\Requests\CreateregistroRequest;
use App\Http\Requests\UpdateregistroRequest;
use App\Repositories\registroRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Http\JsonResponse;
use Response;

class registroController extends AppBaseController
{
    /** @var  registroRepository */
    private $registroRepository;

    public function __construct(registroRepository $registroRepo)
    {
        $this->registroRepository = $registroRepo;
    }

    /**
     * Display a listing of the registro.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index()
    {
        // dd($request);
        $registros = $this->registroRepository->all();

        return view('registros.index')
            ->with('registros', $registros);
    }

    /**
     * Show the form for creating a new registro.
     *
     * @return Response
     */
    public function create()
    {
        return view('registros.create');
    }

    /**
     * Store a newly created registro in storage.
     *
     * @param CreateregistroRequest $request
     *
     * @return Response
     */
    public function store(CreateregistroRequest $request)
    {
            $this->validate($request,[
            'id_detalle_concepto'=> 'required',
            'debe' => 'required',
            'haber'=> 'required',
            'id_rubro'=> 'required',
            'id_asiento' => 'required'
            ]
        ); 
        $input = $request->only("id_detalle_concepto","id_rubro","debe","haber","id_rubro","id_asiento","concepto_detallado","id_clasificacion");

        $registro = $this->registroRepository->create($input);

        if( $request->exists("json") && $request->get("json") == true ){
            return response()->json(
                [
                    "id_registro" => $registro->id_registro
                ],
                JsonResponse::HTTP_CREATED
            );
        }

        Flash::success('Registro saved successfully.');

        return redirect(route('registros.index'));
    }

    /**
     * Display the specified registro.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $registro = $this->registroRepository->find($id);

        if (empty($registro)) {
            Flash::error('Registro not found');

            return redirect(route('registros.index'));
        }

        return view('registros.show')->with('registro', $registro);
    }

    /**
     * Show the form for editing the specified registro.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $registro = $this->registroRepository->find($id);

        if (empty($registro)) {
            Flash::error('Registro not found');

            return redirect(route('registros.index'));
        }

        return view('registros.edit')->with('registro', $registro);
    }

    /**
     * Update the specified registro in storage.
     *
     * @param int $id
     * @param UpdateregistroRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateregistroRequest $request)
    {
        $registro = $this->registroRepository->find($id);

        if (empty($registro)) {
            Flash::error('Registro not found');

            return redirect(route('registros.index'));
        }

        $registro = $this->registroRepository->update($request->only("id_rubro", "id_registro", "id_detalle_concepto", "id_asiento", "debe", "haber", "concepto_detallado","id_clasificacion"), $id);

        if( $request->exists("json") && $request->get("json") == true ){
            return response()->json(["msg"=>"done"], JsonResponse::HTTP_OK );
        }

        Flash::success('Registro updated successfully.');

        return redirect(route('registros.index'));
    }

    /**
     * Remove the specified registro from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        $registro = $this->registroRepository->find($id);

        if (empty($registro)) {
            if( $request->exists("json") && $request->get("json") == true ){
                return response()->json(["msg"=>"no se encontro ese ID"], JsonResponse::HTTP_INTERNAL_SERVER_ERROR );
            }
            Flash::error('Registro not found');
            
            return redirect(route('registros.index'));
        }

        $this->registroRepository->delete($id);

        if( $request->exists("json") && $request->get("json") == true ){
            return response()->json(["msg"=>"done"], JsonResponse::HTTP_OK );
        }

        Flash::success('Registro deleted successfully.');

        return redirect(route('registros.index'));
    }
}
