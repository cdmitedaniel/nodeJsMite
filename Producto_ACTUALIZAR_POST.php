<?php
	require 'SQLGlobal.php';

	if($_SERVER['REQUEST_METHOD']=='POST'){
		try{
			$datos = json_decode(file_get_contents("php://input"),true);

            $codigo = $datos["codigo"]; // obtener parametros GET
            $descripcion = $datos["descripcion"];
            $precio = $datos["precio"];
            $categoria = $datos["categoria"];
			$respuesta = SQLGlobal::cudFiltro(
				"UPDATE Producto SET descripcion = ?, precio = ?, categoria = ? WHERE id = ?",
				array($descripcion,$precio,$categoria,$codigo)
            );//con filtro ("El tamaño del array debe ser igual a la cantidad de los '?'")
            if($respuesta>0){
                echo json_encode(array(
                    'respuesta'=>'200',
                    'estado' => 'Se actualizo correctamente el producto',
                    'data'=>'Numero de filas afectadas: '.$respuesta,
                    'error'=>''
                ));
            }else{
                echo json_encode(array(
                    'respuesta'=>'100',
                    'estado' => 'El codigo del producto no existe',
                    'data'=>'Numero de filas afectadas: '.$respuesta,
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