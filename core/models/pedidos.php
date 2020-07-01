<?php 
    class Pedidos extends Validator
    {
        private $id = null;
        private $monto_total = null;
        private $estado_pedido = null;
        private $fecha_pedido = null;
        private $fecha_entrega = null;
        private $direccion_pedido = null;
        private $codigo_postal = null;
        private $numero_casa_direccion = null;
        private $id_detalle = null;
        private $cliente = null;
        private $producto = null;
        private $cantidad = null;
        private $precio = null;
        private $estado = null;

        public function setId($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->id = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setIdDetalle($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->id_detalle = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setCliente($value)
        {
            if($this->validateNaturalNumber($value)) {
                $this->cliente = $value;
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

        public function setCantidad($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->cantidad = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setPrecio($value)
        {
            if ($this->validateMoney($value)) {
                $this->precio = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setEstado($value)
        {
            if ($this->validateSatatus($value)) {
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

        public function getMonto_total()
        {
            return $this->monto_total;
        }

        public function getEstado_pedido()
        {
            return $this->estado_pedido;
        }

        public function getFecha_pedido()
        {
            return $this->fecha_pedido;
        }

        public function getFecha_entrega()
        {
            return $this->fecha_entrega;
        }

        public function getDireccion_pedido()
        {
            return $this->direccion_pedido;
        }

        public function getCodigo_postal()
        {
            return $this->codigo_postal;
        }

        public function getNumero_casa_direccion()
        {
            return $this->numero_casa_direccion;
        }

        public function readAllPedidos()
        {
            $sql = 'SELECT id_pedido, numero_orden, nombre_cliente, apellido_cliente, monto_total, estado_pedido, fecha_pedido, fecha_entrega, direccion_pedido, codigo_postal, numero_casa_direccion
                    FROM Pedidos INNER JOIN Clientes USING (id_cliente)
                    ORDER BY estado_pedido';
            $params = null;
            return Database::getRows($sql, $params);
        }

        public function readAllPedidosxCliente()
        {
            $sql = 'SELECT id_pedido, numero_orden, id_cliente, monto_total, estado_pedido, fecha_pedido, fecha_entrega, direccion_pedido, codigo_postal, numero_casa_direccion
                    FROM Pedidos
                    WHERE id_cliente = ?';
            $params = array($this->id);
            return Database::getRow($sql, $params);
        }

        public function readOnePedidos()
        {
            $sql = 'SELECT id_pedido, numero_orden, id_cliente, monto_total, estado_pedido, fecha_pedido, fecha_entrega, direccion_pedido, codigo_postal, numero_casa_direccion
                    FROM Pedidos
                    WHERE id_pedido = ?';
            $params = array($this->id);
            return Database::getRow($sql, $params);
        }

        public function readOneDetalle()
        {
            $sql = 'SELECT id_det_pedido, numero_orden, nombre_producto, precio_producto_det, cantidad_detalle
                    FROM Detalle_Pedido 
                    INNER JOIN Productos USING (id_producto)
                    INNER JOIN Pedidos USING (id_pedido)
                    WHERE id_pedido = ?';
            $params = array($this->id);
            return Database::getRow($sql, $params);
        }

        public function readOrder()
        {
            $sql = "SELECT id_pedido
                    FROM pedidos
                    WHERE estado_pedido = 'En carrito' AND id_cliente = ?";
            $params = array($this->cliente);
            if ($data = Database::getRow($sql, $params)) {
                $this->id_pedido = $data['id_pedido'];
                return true;
            } else {
                $sql = 'INSERT INTO pedidos(id_cliente)
                        VALUES(?)';
                $params = array($this->cliente);
                if (Database::executeRow($sql, $params)) {
                    // Se obtiene el ultimo valor insertado en la llave primaria de la tabla pedidos.
                    $this->id_pedido = Database::getLastRowId();
                    return true;
                } else {
                    return false;
                }
            }
        }
    
        // Método para agregar un producto al carrito de compras.
        public function createDetail()
        {
            $sql = 'INSERT INTO Detalle_Pedido(id_producto, precio_producto_det, cantidad_detalle, id_pedido)
                    VALUES(?, ?, ?, ?)';
            $params = array($this->producto, $this->precio, $this->cantidad, $this->id_pedido);
            return Database::executeRow($sql, $params);
        }
    
        // Método para obtener los productos que se encuentran en el carrito de compras.
        public function readCart()
        {
            $sql = 'SELECT id_det_pedido, nombre_producto, d.precio_producto_det, d.cantidad_detalle
                    FROM pedidos e, detalle_pedido d, productos p
                    WHERE e.id_pedido = d.id_pedido and p.id_producto = d.id_producto and d.id_pedido = ?';
            $params = array($this->id_pedido);
            return Database::getRows($sql, $params);
        }
    
        // Método para cambiar el estado de un pedido.
        public function updateOrderStatus()
        {
            $sql = 'UPDATE pedidos
                    SET estado_pedido = ?
                    WHERE id_pedido = ?';
            $params = array($this->estado, $this->id_pedido);
            return Database::executeRow($sql, $params);
        }
    
        // Método para actualizar la cantidad de un producto agregado al carrito de compras.
        public function updateDetail()
        {
            $sql = 'UPDATE detalle_pedido
                    SET cantidad_producto = ?
                    WHERE id_pedido = ? AND id_detalle = ?';
            $params = array($this->cantidad, $this->id_pedido, $this->id_detalle);
            return Database::executeRow($sql, $params);
        }
    
        // Método para eliminar un producto que se encuentra en el carrito de compras.
        public function deleteDetail()
        {
            $sql = 'DELETE FROM detalle_pedido
                    WHERE id_pedido = ? AND id_detalle = ?';
            $params = array($this->id_pedido, $this->id_detalle);
            return Database::executeRow($sql, $params);
        }
    }
?>