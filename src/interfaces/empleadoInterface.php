<?php
interface IEmpleado {
    public function crearEmplado($empleado);
    public function acutualizarEmpleado($empleado);
    public function borrarEmplado($idempleado);
    public function obtenerEmpleado();
    public function obtenerEmpladoPorNombre($nombre);
    public function obtenerEmpleadoPorRol($rol);
}

?>