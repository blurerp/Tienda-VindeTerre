<?php
    class Clientes extends Validator
    {
        private $id = null;
        private $nombre_cliente = null;
        private $apellido_cliente = null;
        private $usuario_cliente = null;
        private $contrasena_cliente = null;
        private $imagen = null;
        private $archivo = null;
        private $ruta = '../../../resources/img/clientes/';
        private $estado_cliente = null;
        private $tipo_cliente = null;
        private $dui_cliente = null;
        private $email_cliente = null;
        private $telefono_cliente = null;
        private $nit_cliente = null;

        public function setId($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->id = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setEstado_cliente($value)
        {
            if ($this->validateAlphabetic($value, 1, 10)) {
                $this->estado_cliente = $value;
                return true;
            } else {
                return false;
            }
        } 
        public function getId()
        {
            return $this->id;
        }

        public function getNombre_cliente()
        {
            return $this->nombre_cliente;
        }

        public function getApellido_cliente()
        {
            return $this->apellido_cliente;
        }

        public function getUsuario_cliente()
        {
            return $this->usuario_cliente;
        }

        public function getImagen()
        {
            return $this->imagen;
        }

        public function getRuta()
        {
            return $this->ruta;
        }

        public function getEstado_cliente()
        {
            return $this->estado_cliente;
        }

        public function getTipo_cliente()
        {
            return $this->tipo_cliente;
        }

        public function getDui_cliente()
        {
            return $this->dui_cliente;
        }

        public function getEmail_cliente()
        {
            return $this->email_cliente;
        }

        public function getTelefono_cliente()
        {
            return $this->telefono_cliente;
        }

        public function getNit_cliente()
        {
            return $this->nit_cliente;
        }

        public function readAllClientes()
        {
            $sql = 'SELECT id_cliente, nombre_cliente, apellido_cliente, usuario_cliente, foto_cliente, estado_cliente, tipo_cliente, dui_cliente, email_cliente, telefono_cliente, nit_cliente
                    FROM Clientes
                    ORDER BY nombre_cliente';
            $params = null;
            return Database::getRows($sql, $params);
        }

        public function readOneClientes()
        {
            $sql = 'SELECT id_cliente, nombre_cliente, apellido_cliente, usuario_cliente, foto_cliente, estado_cliente, tipo_cliente, dui_cliente, email_cliente, telefono_cliente, nit_cliente
                    FROM Clientes
                    WHERE id_cliente = ?';
            $params = array($this->id);
            return Database::getRow($sql, $params);
        }

        public function updateClientes()
        {
                
            $sql = 'UPDATE Clientes 
                    SET estado_cliente = ?
                    WHERE id_cliente = ?';
            $params = array($this->estado_cliente, $this->id);             
            return Database::executeRow($sql, $params);
        }
    }
?>