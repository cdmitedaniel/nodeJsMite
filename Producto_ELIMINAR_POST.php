<?php
	require 'SQLGlobal.php';
	ini_set('display_errors', 1);

	if($_SERVER['REQUEST_METHOD']=='POST'){
		try{
			$datos = json_decode(file_get_contents("php://input"),true);

			$codigo = $datos["codigo"]; // obtener parametros GET
			$respuesta = SQLGlobal::cudFiltro(
				"DELETE FROM Producto WHERE id = ?",
				array($codigo)
            );//con filtro ("El tamaño del array debe ser igual a la cantidad de los '?'")
            if($respuesta>0){
                echo json_encode(array(
                    'respuesta'=>'200',
                    'estado' => 'Se elimino correctamente el producto.',
                    'data'=>'El numero de filas afectadas es: '.$respuesta,
                    'error'=>''
                ));
            }else{
                echo json_encode(array(
                    'respuesta'=>'100',
                    'estado' => 'El codigo del producto no existe.',
                    'data'=>'El numero de filas afectadas es: '.$respuesta,
                    'error'=>''
                ));
            }
		}catch(PDOException $e){
			echo json_encode(
				array(
					'respuesta'=>'-1',
					'estado' => 'Ocurrio un error, intentelo mas tarde',
					'data'=>'',
					'error'=>$e->getMessage())
			);
		}
	}

?>