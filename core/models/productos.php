<?php

class Productos extends Validator
{
    private $id = null;
    private $nombre = null;
    private $imagen = null;
    private $archivo = null;
    private $ruta = '../../../resources/img/productos/';
    private $precio_venta = null;
    private $precio_compra = null;
    private $categoria = null;
    private $codigo_producto = null;
    private $descripcion_producto = null;
    private $bodega = null;
    private $cosecha = null;
    private $alcohol = null;
    private $stock_activo = null;
    private $stock_minimo = null;
    private $estado = null;
    private $puntuacion = null;   

    public function setId($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->id = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setNombre($value)
    {
        if ($this->validateAlphanumeric($value, 1, 60)) {
            $this->nombre = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setImagen($file)
    {
        if ($this->validateImageFile($file, 500, 500)) {
            $this->imagen = $this->getImageName();
            $this->archivo = $file;
            return true;
        } else {
            return false;
        }
    }

    public function setPrecio_venta($value)
    {
        if ($this->validateMoney($value)) {
            $this->precio_venta = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setPrecio_compra($value)
    {
        if ($this->validateMoney($value)) {
            $this->precio_compra = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setCategoria($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->categoria = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setCodigo_producto($value)
    {
        if ($this->validateString($value, 1, 10)) {
            $this->codigo_producto = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setDescripcion_producto($value)
    {
        if ($this->validateString($value, 1, 200)) {
            $this->descripcion_producto = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setBodega($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->bodega = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setCosecha($value)
    {
        if ($this->validateYear($value)) {
            $this->cosecha = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setAlcohol($value)
    {
        if ($this->validatePercentage($value)) {
            $this->alcohol = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setStock_activo($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->stock_activo = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setStock_minimo($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->stock_minimo = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setEstado($value)
    {
        if ($this->validateAlphabetic($value, 1, 15)) {
            $this->estado = $value;
            return true;
        } else {
            return false;
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function getRuta()
    {
        return $this->ruta;
    }

    public function getPrecio_venta()
    {
        return $this->precio_venta;
    }

    public function getPrecio_compra()
    {
        return $this->precio_compra;
    }

    public function getCategoria()
    {
        return $this->categoria;
    }

    public function getCodigo_producto()
    {
        return $this->codigo_producto;
    }

    public function getDescripcion_producto()
    {
        return $this->descripcion_producto;
    }

    public function getBodega()
    {
        return $this->bodega;
    }

    public function getCosecha()
    {
        return $this->cosecha;
    }

    public function getAlcohol()
    {
        return $this->alcohol;
    }

    public function getStock_activo()
    {
        return $this->stock_activo;
    }

    public function getStock_minimo()
    {
        return $this->stock_minimo;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function getPuntuacion()
    {
        return $this->puntuacion;
    }

    public function searchProductos($value)
    {
        $sql = 'SELECT id_producto, nombre_producto, imagen_producto, precio_venta, precio_compra, categoria, descripcion_producto, id_bodega, cosecha, alcohol, stock_activo, stock_minimo, estado_producto
                    FROM productos INNER JOIN Categoria USING (id_categoria)
                    WHERE nombre_producto ILIKE ?
                    ORDER BY nombre_producto';
        $params = array("%$value%", "%$value%");
        return Database::getRows($sql, $params);
    }

    public function createProductos()
    {
        $stock_act = 0;
        if ($this->saveFile($this->archivo, $this->ruta, $this->imagen)) {
            $sql = 'INSERT INTO Productos (nombre_producto, imagen_producto, precio_venta, precio_compra, id_categoria, descripcion_producto, id_bodega, cosecha, alcohol, stock_activo, stock_minimo, estado_producto)
                        VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
            $params = array($this->nombre, $this->imagen, $this->precio_venta, $this->precio_compra, $this->categoria, $this->descripcion_producto, $this->bodega, $this->cosecha, $this->alcohol, $stock_act, $this->stock_minimo, $this->estado);
            return Database::executeRow($sql, $params);
        } else {
            return false;
        }
    }

    public function readAllProductos()
    {
        $sql = 'SELECT id_producto,codigo_producto, nombre_producto, imagen_producto, precio_venta, precio_compra, categoria, descripcion_producto, id_bodega, cosecha, alcohol, stock_activo, stock_minimo, estado_producto
                    FROM Productos INNER JOIN Categoria USING (id_categoria)
                    ORDER BY nombre_producto';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readOneProductos()
    {
        $sql = 'SELECT id_producto,codigo_producto, nombre_producto, imagen_producto, precio_venta, precio_compra, id_categoria, descripcion_producto, id_bodega, cosecha, alcohol, stock_activo, stock_minimo, estado_producto
        FROM Productos 
        WHERE id_producto = ?
        group by id_producto order by nombre_producto';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function readProductosCategoria()    
    {
        $sql = "SELECT p.id_producto,p.nombre_producto,p.imagen_producto,c.categoria,p.descripcion_producto,p.precio_venta,p.estado_producto
        FROM productos p 
        INNER JOIN categoria c ON p.id_categoria = c.id_categoria	
        WHERE c.id_categoria = ? AND p.estado_producto = 'Agotado' ORDER BY nombre_producto
        ";
        $params = array($this->categoria);
        return Database::getRows($sql, $params);
    }
    
    public function updateProductos()
    {
        if ($this->saveFile($this->archivo, $this->ruta, $this->imagen)) {
            $sql = 'UPDATE Productos 
                        SET codigo_producto = ?, nombre_producto = ?, imagen_producto = ?, precio_venta = ?, precio_compra = ?, id_categoria = ?, descripcion_producto = ?, id_bodega = ?, cosecha = ?, alcohol = ?, stock_minimo = ?, estado_producto = ?
                        WHERE id_producto = ?';
            $params = array($this->codigo_producto,$this->nombre, $this->imagen, $this->precio_venta, $this->precio_compra, $this->categoria, $this->descripcion_producto, $this->bodega, $this->cosecha, $this->alcohol, $this->stock_minimo, $this->estado, $this->id);
        } else {
            $sql = 'UPDATE Productos 
                        SET codigo_producto = ?, nombre_producto = ?, precio_venta = ?, precio_compra = ?, id_categoria = ?, descripcion_producto = ?, id_bodega = ?, cosecha = ?, alcohol = ?, stock_minimo = ?, estado_producto = ?
                        WHERE id_producto = ?';
            $params = array($this->codigo_producto,$this->nombre, $this->precio_venta, $this->precio_compra, $this->categoria, $this->descripcion_producto, $this->bodega, $this->cosecha, $this->alcohol, $this->stock_minimo, $this->estado, $this->id);
        }
        return Database::executeRow($sql, $params);
    }

    public function deleteProductos()
    {
        $sql = 'DELETE FROM Productos
                    WHERE id_producto = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }
}
