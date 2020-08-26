<?php
class Entradas extends Validator
{
    private $id = null;
    private $producto = null;
    private $cantidad_ingresar = null;
    private $fecha_hora = null;
    private $proveedor = null;

    public function setId($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->id = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setProducto($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->producto = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setCantidad_ingresar($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->cantidad_ingresar = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setProveedor($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->proveedor = $value;
            return true;
        } else {
            return false;
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getProducto()
    {
        return $this->producto;
    }

    public function getCantidad_ingresar()
    {
        return $this->cantidad_ingresar;
    }

    public function getProveedor()
    {
        return $this->proveedor;
    }

    public function searchEntrada($value)
    {
        $sql = 'SELECT id_entrada, nombre_producto, cantidad_ingresar, fecha_hora, nombre_proveedor
                FROM Entradas INNER JOIN Productos USING (id_producto) INNER JOIN Proveedores USING (id_proveedor)
                WHERE nombre_producto ILIKE ?
                ORDER BY nombre_producto';
        $params = array("%$value%", "%$value%");
        return Database::getRows($sql, $params);
    }

    public function createEntrada()
    {
            $sql = 'INSERT INTO Entradas (id_producto, cantidad_ingresar, fecha_hora, id_proveedor)
                    VALUES(?, ?, current_timestamp, ?)';
            $params = array($this->producto, $this->cantidad_ingresar, $this->proveedor);
            return Database::executeRow($sql, $params);

    }

    public function readAllEntrada()
    {
        $sql = 'SELECT id_entrada, nombre_producto, cantidad_ingresar, fecha_hora, nombre_proveedor
                FROM Entradas INNER JOIN Productos USING (id_producto) INNER JOIN Proveedores USING (id_proveedor)
                ORDER BY nombre_producto';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readOneEntrada()
    {
        $sql = 'SELECT id_entrada, nombre_producto, cantidad_ingresar, fecha_hora, nombre_proveedor
                FROM Entradas INNER JOIN Productos USING (id_producto) INNER JOIN Proveedores USING (id_proveedor)
                WHERE id_entrada = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function updateEntrada()
    {
        $sql = 'UPDATE Entradas 
                SET id_producto = ?, cantidad_ingresar = ?, id_proveedor = ?
                WHERE id_entrada = ?';
        $params = array($this->producto, $this->cantidad_ingresar, $this->proveedor, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function deleteEntrada()
    {
        $sql = 'DELETE FROM Entradas 
                WHERE id_entrada = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }
}
