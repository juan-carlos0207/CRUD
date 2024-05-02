<?php

include 'conexion.php';
class Alumno {
    public $codigo;
    public $apellido_paterno;
    public $apellido_materno;
    public $nombres;
    public $carrera;
    public $domicilio;
    public $fecha_nacimiento;
}

class AlumnoDAO {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function crearAlumno($alumno) {
        $sql = "INSERT INTO alumnos (codigo, apellido_paterno, apellido_materno, nombres, carrera, domicilio, fecha_nacimiento) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssssss", $alumno->codigo, $alumno->apellido_paterno, $alumno->apellido_materno, $alumno->nombres, $alumno->carrera, $alumno->domicilio, $alumno->fecha_nacimiento);
        $stmt->execute();
        $stmt->close();
    }

    public function leerAlumno($codigo) {
        $sql = "SELECT * FROM alumnos WHERE codigo = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $codigo);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $result;
    }
    public function modificarAlumno($codigo){
        $sql = "UPDATE alumnos WHERE codigo = '$codigo' ";

    }
    public function eliminarAlumno($codigo){
        $sql = "DELETE FROM alumnos WHERE codigo = '$codigo'";
    }
}

// Ejemplo
$alumnoDAO = new AlumnoDAO($conn);

// Crear un alumno
$alumno = new Alumno();
$alumno->codigo = "AL0001";
$alumno->apellido_paterno = "Ninahuanca";
$alumno->apellido_materno = "Choque";
$alumno->nombres = "Juan Carlos";
$alumno->carrera = "Ingeniería Informática";
$alumno->domicilio = "Independecia M -5";
$alumno->fecha_nacimiento = "2000-02-07";
$alumnoDAO->crearAlumno($alumno);

// Leer un alumno
$alumnoLeido = $alumnoDAO->leerAlumno("AL0001");
print_r($alumnoLeido);
// Elimninar un alumno
$alumnoEliminado = $alumnoDAO->leerAlumno("AL0001");
print_r($alumnoEliminado);

?>
