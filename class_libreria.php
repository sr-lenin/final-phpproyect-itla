<?php
include "./conexion_db.php";


class Cliente
{
    private $nombre;
    private $numero_telefono;
    private $db;
    public function __construct()
    {
        $this->db = ConexionDb::conexion_db();
    }

    public function crearCliente()
    {
        $this->nombre = $_POST['nombre'];
        $this->numero_telefono = $_POST['telefono'];
        $sql = "INSERT INTO clientes (nombre, numero_telefono) VALUES ('$this->nombre', '$this->numero_telefono')";
        if ($this->db->query($sql)) {
            echo "Nuevo cliente registrado con exito";
        } else {
            echo "Error: " . $this->db->error;
        }
        $this->db->close();
    }
}

class Prestamo
{
    private $id_cliente;
    private $id_libro;
    private $fecha_inicio;
    private $fecha_final;
    private $db;
    public function __construct()
    {
        $this->db = ConexionDb::conexion_db();
    }

    public function crearPrestamo()
    {
        $this->id_cliente = $_POST['id_cliente'];
        $this->id_libro = $_POST['id_libro'];
        $this->fecha_inicio = $_POST['fecha_inicio'];
        $this->fecha_final = $_POST['fecha_final'];

        if (!empty($this->id_cliente) && !empty($this->id_libro) && !empty($this->fecha_inicio) && !empty($this->fecha_final)) {
            
            $sql_check_vencido = "SELECT COUNT(*) 
                          FROM prestamos 
                          WHERE id_cliente = ? 
                          AND fecha_final < NOW() 
                          AND id_prestamo NOT IN (SELECT id_prestamo FROM devoluciones)";
            $stmt_check_vencido = $this->db->prepare($sql_check_vencido);
            $stmt_check_vencido->bind_param("i", $this->id_cliente);
            $stmt_check_vencido->execute();
            $stmt_check_vencido->bind_result($prestamos_vencidos);
            $stmt_check_vencido->fetch();
            $stmt_check_vencido->close();
            if ($prestamos_vencidos > 0) {
                echo "No puede realizar un nuevo préstamo. Tiene préstamos vencidos pendientes de devolución.";
            } else {
                $sql = "SELECT estado FROM libros WHERE id_libro = ?";
                $stmt = $this->db->prepare($sql);
                $stmt->bind_param("i", $this->id_libro);
                $stmt->execute();
                $stmt->bind_result($estado_libro);
                $stmt->fetch();
                $stmt->close();
            
            

            if ($estado_libro === 'disponible') {
                $sql = "INSERT INTO prestamos (id_cliente, id_libro, fecha_inicio, fecha_final)
                       VALUES (?, ?, ?, ?)";
                $stm = $this->db->prepare($sql);
                $stm->bind_param("iiss", $this->id_cliente, $this->id_libro, $this->fecha_inicio, $this->fecha_final);

                if ($stm->execute()) {
                    $sql = "UPDATE libros SET estado = 'prestado' WHERE id_libro = ?";
                    $stmt = $this->db->prepare($sql);
                    $stmt->bind_param("i", $this->id_libro);
                    $stmt->execute();
                    $stmt->close();

                    echo "Préstamo agregado correctamente. El libro ha sido marcado como prestado.";
                } else {
                    echo "Error al agregar el préstamo: " . $stm->error;
                }

                $stm->close();
            } else {
                echo "El libro seleccionado ya está prestado y no está disponible.";
            }
        }
        } else {
            echo "Todos los campos son obligatorios.";
        }
        $this->db->close();
    }

    public function getLibros()
    {
        $sql_libros = "SELECT id_libro, titulo FROM libros";
        $result_libros = $this->db->query($sql_libros);
        return $result_libros;
    }
    public function getClientes()
    {
        $sql_clientes = "SELECT id_cliente, nombre FROM clientes";
        $result_clientes = $this->db->query($sql_clientes);
        return $result_clientes;
    }
}

class Libro
{
    private $titulo;
    private $author;
    private $isbn;
    private $numero_edicion;
    private $costo_diario;
    private $db;
    public function __construct()
    {
        $this->db = ConexionDb::conexion_db();
    }

    public function crearLibro()
    {
        $this->titulo = $_POST['titulo'];
        $this->author = $_POST['author'];
        $this->isbn = $_POST['isbn'];
        $this->numero_edicion = $_POST['numero_edicion'];
        $this->costo_diario = $_POST['costo_diario'];
        $sql = "INSERT INTO libros (titulo, author, ISBN, numero_edicion, costo_diario) VALUES ('$this->titulo', '$this->author', '$this->isbn', '$this->numero_edicion', '$this->costo_diario')";

        if ($this->db->query($sql)) {
            echo "Nuevo libro registrado con exito";
        } else {
            echo "Error: " . $this->db->error;
        }

        $this->db->close();
    }
}

class Devolucion
{
    private $id_prestamo;
    private $fecha_devolucion;
    private $mora;
    private $db;
    public function __construct()
    {
        $this->db = ConexionDb::conexion_db();
    }

    public function devolverLibro()
    {
        $id_prestamo = $_POST['id_prestamo'];
        if (!empty($id_prestamo)) {
            $sql = "SELECT id_libro, fecha_final, id_cliente FROM prestamos WHERE id_prestamo = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("i", $id_prestamo);
            $stmt->execute();
            $stmt->bind_result($id_libro, $fecha_final, $id_cliente);
            $stmt->fetch();
            $stmt->close();

            $fecha_devolucion = date("Y-m-d"); 
            $mora = 0;
            $diff_dias = 0;
            $fecha_final_obj = new DateTime($fecha_final);
            $fecha_devolucion_obj = new DateTime($fecha_devolucion);
            if ($fecha_devolucion_obj > $fecha_final_obj) {
                $diff = $fecha_final_obj->diff($fecha_devolucion_obj); 
                $diff_dias = $diff->days; 
                $mora = $diff_dias * 5; 
            }

            $sql_insert_devolucion = "INSERT INTO devoluciones (id_prestamo, fecha_devolucion, mora) VALUES (?, ?, ?)";
            $stmt_insert_devolucion = $this->db->prepare($sql_insert_devolucion);
            $stmt_insert_devolucion->bind_param("isd", $id_prestamo, $fecha_devolucion, $mora);

            if ($stmt_insert_devolucion->execute()) {
                $sql_update_libro = "UPDATE libros SET estado = 'disponible' WHERE id_libro = ?";
                $stmt_update_libro = $this->db->prepare($sql_update_libro);
                $stmt_update_libro->bind_param("i", $id_libro);
                $stmt_update_libro->execute();
                $stmt_update_libro->close();
                $sql_update_prestamo = "UPDATE prestamos SET fecha_final = ?, estado_prestamo = 'finalizado' WHERE id_prestamo = ?";
                $stmt_update_prestamo = $this->db->prepare($sql_update_prestamo);
                $stmt_update_prestamo->bind_param("si", $fecha_devolucion, $id_prestamo);
                $stmt_update_prestamo->execute();
                $stmt_update_prestamo->close();

                echo "Libro devuelto correctamente, <br/>
              Días de atraso: " . $diff_dias . "<br/>
              Mora calculada: " . $mora . ".<br/>
              Libro marcado como disponible.";
            } else {
                echo "Error al registrar la devolución: " . $stmt_insert_devolucion->error;
            }

            $stmt_insert_devolucion->close();
        } else {
            echo "Debe seleccionar un préstamo para devolver.";
        }

        $this->db->close();
    }
}
