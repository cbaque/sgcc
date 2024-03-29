<?php 
namespace App\Controllers;

use App\Models\CursosModel;

class CursosController extends BaseController
{
    public function __construct(){
		$this->db =db_connect(); // loading database 
		helper('form');
	}
	public function index(){
		$model = new CursosModel();

		$data = [
			'cursos' => $model->paginateCustom(10),
			'pager' => $model->pager,
			'pagi_path' => 'sgcc/cursos',
			'content' => 'Cursos/CursoListar'
		];

		$estructura=	view('Estructura/layout/index', $data);

        return $estructura;

	}

	public function nuevo(){
		$builder = $this->db->table("areas");
		$builder->select('AREID,ARENOMBRE');
		$areas = $builder->get()->getResult();
		$data = [
			'content' => 'Cursos/CursoNuevo',
			'areas'=>$areas
		];

		$estructura=	view('Estructura/layout/index', $data);
		return $estructura;
	}

	public function guardar(){
		$CursosModel= new CursosModel($db);
		$request=\Config\Services::request();
		$data=array(
			'AREID'=>$request->getPostGet('cmbAreas'),
			'CURNOMBRE'=>$request->getPostGet('txtNombre'),
			'CURFECINICIO'=>$request->getPostGet('txtFecha_Inicio'),
			'CURFECFINAL'=>$request->getPostGet('txtFecha_Final'),
			'CURPRECIO'=>$request->getPostGet('txtPrecio'),
			'CURNUMESTUDIANTES'=>$request->getPostGet('txtNº_Estudiantes'),
			'CURMODALIDAD'=>$request->getPostGet('txtModalidad'),
			'CURESTADO'=>$request->getPostGet('txtEstado'),
			
		);
		if($CursosModel->save($data)===false){
			var_dump($CursosModel->errors());
		}
		return redirect()->to(site_url('/CursosController'));	
	}

    public function editar(){
		$request=\Config\Services::request();

		if($request->getPostGet('id')){
        $id=$request->getPostGet('id');
		}else{
			$id=$request->uri->getSegment(3);	
		}

		$CursosModel=new CursosModel($db);
        $cursos=$CursosModel->find($id);
		// $cursos=array('cursos'=>$cursos);
		
		$builder = $this->db->table("areas");
		$builder->select('AREID,ARENOMBRE');
		$areas = $builder->get()->getResult();
		$builder = $this->db->table("areas");
		$builder->select('AREID,ARENOMBRE');
		$areas = $builder->get()->getResult();
			
		$data = [
			'content' => 'Cursos/CursoEditar',
			'areas'=>$areas,
			'cursos'=>$cursos
		];

		$estructura=	view('Estructura/layout/index', $data);
		return $estructura;
	}

	public function modificar(){
		$CursosModel= new CursosModel($db);
		$request=\Config\Services::request();
		$data=array(
			'CURID'=>$request->getPostGet('txtCodigo'),
			'AREID'=>$request->getPostGet('cmbAreas'),
			'CURNOMBRE'=>$request->getPostGet('txtNombre'),
			'CURFECINICIO'=>$request->getPostGet('txtFecha_Inicio'),
			'CURFECFINAL'=>$request->getPostGet('txtFecha_Final'),
			'CURPRECIO'=>$request->getPostGet('txtPrecio'),
			'CURNUMESTUDIANTES'=>$request->getPostGet('txtNº_Estudiantes'),
			'CURMODALIDAD'=>$request->getPostGet('txtModalidad'),
			'CURESTADO'=>$request->getPostGet('txtEstado'),
			
		);
		
		if($CursosModel->save($data)===false){
			var_dump($CursosModel->errors());
		}
		return redirect()->to(site_url('/CursosController'));
		
	}
	
	public function borrar(){
		$request=\Config\Services::request();
		$id=$request->getPostGet('id');

		$CursosModel=new CursosModel($db);
		$cursos=$CursosModel->find($id);

		$builder = $this->db->table("areas");
		$builder->select('AREID,ARENOMBRE');
		$areas = $builder->get()->getResult();
		$builder = $this->db->table("areas");
		$builder->select('AREID,ARENOMBRE');
		$areas = $builder->get()->getResult();
		$data = [
			'content' => 'Cursos/CursoEliminar',
			'areas'=>$areas,
			'cursos'=>$cursos
		];

		$estructura=	view('Estructura/layout/index', $data);
		return $estructura;							
	}	
		
	public function eliminar(){
		$request=\Config\Services::request();
		$CursosModel=new CursosModel($db);
		$id=$request->getPostGet('txtCodigo');
		$cursos=$CursosModel->find($id);
		$cursos=array('cursos'=>$cursos);
		
		if($CursosModel->delete($id)===false){
			print_r($CursosModel->errors());
		}else{
			$CursosModel->purgeDeleted($id);
		}
		
		return redirect()->to(site_url('/CursosController'));

		}
		
}