<?php

class bd{

    private $db;
  
    public function __construct() {
      $this->db = new PDO('mysql:host=localhost;dbname=alquiler_carro', 'root', '');
      $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function CrearCuenta($nombre, $apellido, $ti, $gmail, $password) {
      // Generar un hash seguro de la contraseña
      $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        
      // Insertar el nombre de usuario y la contraseña hash en la base de datos
      $query = $this->db->prepare("INSERT INTO usuario (nombre, apellido, ti, gmail ,password) VALUES (:nombre, :apellido, :ti, :gmail, :password)");
      $query->bindParam(':nombre', $nombre);
      $query->bindParam(':apellido', $apellido);
      $query->bindParam(':ti',$ti);
      $query->bindParam(':gmail',$gmail);
      $query->bindParam(':password', $passwordHash);
      $query->execute();
    }

    public function validarUsuario($nombre, $password) {

      $query = $this->db->prepare("SELECT * FROM usuario WHERE nombre = :nombre LIMIT 1");
      $query->bindParam(':nombre', $nombre);
      $query->execute();
      $result = $query->fetch(PDO::FETCH_ASSOC);
    
      if ($result !== false) {
        if (password_verify($password, $result['password'])) {
          
          $_SESSION['usuario'] = $result['nombre'];
          // se crea la session de exito si todo esta correcto  
          return $_SESSION['exito'] = true; 

        }else{
          $_SESSION['errorLogin'] =  "usuario y/o contraseña son incorrectas";
        }
  
      }else {
        $_SESSION['errorLogin'] = "No existe usuario";   
      }
    }

    public function alquilar($nombreUser, $nombreCarro) {
      $query1 = $this->db->prepare("SELECT id FROM usuario WHERE nombre = :nombreUser LIMIT 1");
      $query1->bindParam(':nombreUser', $nombreUser);
      $query1->execute();
      $result1 = $query1->fetch(PDO::FETCH_ASSOC);
      
      $query2 = $this->db->prepare("SELECT id_carro FROM carro WHERE modelo_carro = :nombreCarro LIMIT 1");
      $query2->bindParam(':nombreCarro', $nombreCarro);
      $query2->execute();
      $result2 = $query2->fetch(PDO::FETCH_ASSOC);
    
      if ($result1 !== false && $result2 !== false) {
        $idUser = $result1['id'];
        $idCarro = $result2['id_carro'];
    
        $query3 = $this->db->prepare("INSERT INTO pedidos (idUser, idCarro) VALUES (:idUser, :idCarro)");
        $query3->bindParam(':idUser', $idUser);
        $query3->bindParam(':idCarro', $idCarro);
        $query3->execute();
    
        $_SESSION['exito'] = true;
      } else {
        $_SESSION['error'] = "Nombre de usuario o modelo de carro no existe en la base de datos";
      }
    }

    public function obtenerCarroAlquilado($nombreUsuario) {
      $query = $this->db->prepare("
        SELECT c.modelo_carro, c.precio_carro, u.nombre
        FROM pedidos p
        INNER JOIN carro c ON p.idCarro = c.id_carro
        INNER JOIN usuario u ON p.idUser = u.id AND u.nombre = :nombreUsuario
      ");
    
      $query->bindParam(':nombreUsuario', $nombreUsuario);
      $query->execute();
      $result = $query->fetchAll(PDO::FETCH_ASSOC);
    
      return $result;
    }
    
    public function eliminarCuenta($nombre) {
      $query = $this->db->prepare("DELETE FROM usuario WHERE nombre = :nombre");
      $query->bindParam(':nombre', $nombre);
      $query->execute();
    }
    
    public function eliminarPedido($idPedido) {
      $query = $this->db->prepare("DELETE FROM pedidos WHERE id = :idPedido");
      $query->bindParam(':idPedido', $idPedido);
      $query->execute();
    }
    
    
}