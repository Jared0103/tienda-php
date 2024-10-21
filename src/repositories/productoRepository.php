<?php
require_once '../config/database.php';
require_once '../interfaces/productoInterface.php';

class ProductoRepository implements IProducto
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function crearProducto($producto)
    {
        $sql = "INSERT INTO productos(nombre, descripcion, tipo, precio, imagen) 
                VALUES(:nombre, :descripcion, :tipo, :precio, :imagen)";
        $resultado = $this->conn->prepare($sql);
        $resultado->bindParam(':nombre', $producto->nombre);
        $resultado->bindParam(':descripcion', $producto->descripcion);
        $resultado->bindParam(':tipo', $producto->tipo);
        $resultado->bindParam(':precio', $producto->precio);
        $resultado->bindParam(':imagen', $producto->imagen);

        if ($resultado->execute()) {
            return ['mensaje' => 'Producto creado'];
        } else {
            return ['mensaje' => 'Error al crear producto'];
        }
    }

    public function actualizarProducto($producto)
    {
        $sql = "UPDATE productos 
                SET nombre = :nombre, descripcion = :descripcion, tipo = :tipo, precio = :precio, imagen = :imagen
                WHERE idproducto = :idproducto";
        $resultado = $this->conn->prepare($sql);
        $resultado->bindParam(':nombre', $producto->nombre);
        $resultado->bindParam(':descripcion', $producto->descripcion);
        $resultado->bindParam(':tipo', $producto->tipo);
        $resultado->bindParam(':precio', $producto->precio);
        $resultado->bindParam(':imagen', $producto->imagen);
        $resultado->bindParam(':idproducto', $producto->idproducto);

        if ($resultado->execute()) {
            return ['mensaje' => 'Producto actualizado'];
        } else {
            return ['mensaje' => 'Error al actualizar producto'];
        }
    }

    public function borrarProducto($idproducto)
    {
        $sql = "DELETE FROM productos WHERE idproducto = :idproducto";
        $resultado = $this->conn->prepare($sql);
        $resultado->bindParam(':idproducto', $idproducto);

        if ($resultado->execute()) {
            return ['mensaje' => 'Producto eliminado'];
        } else {
            return ['mensaje' => 'Error al eliminar producto'];
        }
    }

    public function obtenerProductos()
    {
        $sql = "SELECT * FROM productos";
        $resultado = $this->conn->query($sql);
        $resultado->execute();
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerProductoPorNombre($nombre)
    {
        $sql = "SELECT * FROM productos WHERE nombre = :nombre";
        $resultado = $this->conn->prepare($sql);
        $resultado->bindParam(':nombre', $nombre);
        $resultado->execute();
        return $resultado->fetch(PDO::FETCH_ASSOC);
    }
}
?>
