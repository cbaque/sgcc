<?php 
namespace App\Controllers;

use App\Models\AreasModel;

class AreasController extends BaseController
{
    public function __construct(){

		$this->db =db_connect(); // loading database 
		helper('form');
	}
	public function index()
	{
		$builder = $this->db->table("areas");
		$builder->select('*');
		$areas = $builder->get()->getResult();
		$areas=array('areas'=>$areas);
		//metodo pager
		$model = new AreasModel();
        $data = [
            'areas' => $model->paginate(3),
            'pager' => $model->pager,
			'pagi_path' => 'sgcc/areas',
			'content' => 'Areas/AreasListar'
        ];
		//$estructura=view('Estructura/Encabezado').view('Areas/AreasListar',$areas).view('Estructura/pie');
		// $estructura=	view('Estructura/Header').
		// 				view('Estructura/Menu').
		// 				view('Areas/AreasListar',$data).
		// 				view('Estructura/Footer');

		$estructura=	view('Estructura/layout/index', $data);
        return $estructura;
	}

    public function nuevo()
	{
		$data = [
			'content' => 'Areas/AreasNuevo'
        ];
		// $estructura=	view('Estructura/Header').
		// 				view('Estructura/Menu').
		// 				view('Areas/AreasNuevo').
		// 				view('Estructura/Footer');

		//$estructura=view('Estructura/Encabezado').view('Areas/AreasNuevo').view('Estructura/pie');
		$estructura=	view('Estructura/layout/index', $data);
		return $estructura;
	}

    public function guardar(){
		$AreasModel= new AreasModel($db);
		$request=\Config\Services::request();
		$data=array(
			'ARENOMBRE'=>$request->getPostGet('txtAreas'),
		);
		//var_dump($data);
		if($AreasModel->insert($data)===false){
			var_dump($AreasModel->errors());
		}

		//redirige a metodo index
		return redirect()->to(site_url('/AreasController'));	
	}

	public function editar(){
		$request=\Config\Services::request();
		$id = $request->getPostGet('id');

		$AreasModel=new AreasModel($db);
		$areas=$AreasModel->find($id);
		$areas=array('areas'=>$areas);
		//var_dump($areas);
		$data = [
			'areas' => $areas,
			'content' => 'Areas/AreasEditar'
		];
		
		// $estructura=	view('Estructura/Header').
		// 				view('Estructura/Menu').
		// 				view('Areas/AreasEditar',$data).
		// 				view('Estructura/Footer');

		$estructura=	view('Estructura/layout/index', $data);
		//$estructura=view('Estructura/Encabezado').view('Areas/AreasEditar',$data).view('Estructura/pie');
		return $estructura;			
	}

	public function modificar(){
		$AreasModel= new AreasModel($db);
		$request=\Config\Services::request();
		$data=array(
			'AREID'=>$request->getPost('txtCodigo'),
			'ARENOMBRE'=>$request->getPost('txtArea'),
		);
		$AREID=$request->getPost('txtCodigo');
		if($AreasModel->update($AREID,$data)===false){
			var_dump($AreasModel->errors());
		}

		//redirige a metodo index
		return redirect()->to(site_url('/AreasController'));
	}
	
	public function borrar(){
		$request=\Config\Services::request();
		$id=$request->getPostGet('id');

		$AreasModel=new AreasModel($db);
		$areas=$AreasModel->find($id);
		$areas=array('areas'=>$areas);
		//var_dump($areas);
		$data['areas']=$areas;
		
		$estructura=	view('Estructura/Header').
		view('Estructura/Menu').
		view('Areas/AreasBorrar',$data).
		view('Estructura/Footer');
		//$estructura=view('Estructura/Encabezado').view('Areas/AreasBorrar',$data).view('Estructura/pie');
		return $estructura;		
	}
		
	public function eliminar(){
		$request=\Config\Services::request();
		$AreasModel=new AreasModel($db);
		$id=$request->getPostGet('txtCodigo');
		$areas=$AreasModel->find($id);
		$areas=array('areas'=>$areas);
		
		if($AreasModel->delete($id)===false){
			print_r($AreasModel->errors());
		}else{
			$AreasModel->purgeDeleted($id);
		}

		//redirige a metodo index
		return redirect()->to(site_url('/AreasController'));	
	}

}
