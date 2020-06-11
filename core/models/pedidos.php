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

        public function setId($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->id = $value;
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
    }
?>