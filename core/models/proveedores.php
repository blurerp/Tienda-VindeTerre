<?php
    class Proveedores extends Validator
    {
        private $id = null;
        private $nombre_proveedor = null;
        private $correo_proveedor = null;
        private $telefono_proveedor = null;
        private $direccion_proveedor = null;
        private $url_proveedor = null;
        private $tipo_documento = null;
        private $numero_documento = null;
        
        public function setId($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->id = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setNombre_proveedor($value)
        {
            if($this->validateString ($value, 1, 40)) {
                $this->nombre_proveedor = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setCorreo_proveedor($value)
        {
            if($this->validateEmail ($value)) {
                $this->correo_proveedor = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setTelefono_proveedor($value)
        {
            if($this->validateString($value, 1, 15)) {
                $this->telefono_proveedor = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setDireccion_proveedor($value)
        {
            if($this->validateString ($value, 1, 400)) {
                $this->direccion_proveedor = $value;
                return true;
            } else {
                return false;
            }
        }
        
        public function setUrl_proveedor($value)
        {
            if($this->validateUrl ($value)) {
                $this->url_proveedor = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setTipo_documento($value)
        {
            if($this->validateString ($value, 1, 40)) {
                $this->tipo_documento = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setNumero_documento($value)
        {
            if($this->validateNumerodocumento ($value, 1, 40)) {
                $this->numero_documento = $value;
                return true;
            } else {
                return false;
            }
        }

        public function getId()
        {
            return $this->id;
        }

        public function getNombre_proveedor()
        {
            return $this->nombre_proveedor;
        }

        public function getCorreo_proveedor()
        {
            return $this->correo_proveedor;
        }

        public function getTelefono_proveedor()
        {
            return $this->telefono_proveedor;
        }

        public function getDireccion_proveedor()
        {
            return $this->direccion_proveedor;
        }

        public function getUrl_proveedor()
        {
            return $this->url_proveedor;
        }

        public function getTipo_documento()
        {
            return $this->tipo_documento;
        }

        public function getNumero_documento()
        {
            return $this->numero_documento;
        }

        public function searchProveedores($value)
            {
                $sql = 'SELECT id_proveedor, nombre_proveedor, correo_proveedor, telefono_proveedor, direccion_proveedor, url_proveedor, tipo_documento, numero_documento
                        FROM Proveedores
                        WHERE nombre_proveedor ILIKE ?
                        ORDER BY nombre_proveedor';
                $params = array("%$value%", "%$value%");
                return Database::getRows($sql, $params);
            }

        public function createProveedores()
            {
                    $sql = 'INSERT INTO Proveedores (nombre_proveedor, correo_proveedor, telefono_proveedor, direccion_proveedor, url_proveedor, tipo_documento, numero_documento)
                            VALUES(?, ?, ?, ?, ?, ?, ?)';
                    $params = array($this->nombre_proveedor, $this->correo_proveedor, $this->telefono_proveedor, $this->direccion_proveedor, $this->url_proveedor, $this->tipo_documento, $this->numero_documento);
                    return Database::executeRow($sql, $params);

            }

        public function readAllProveedores()
            {
                $sql = 'SELECT id_proveedor, nombre_proveedor, correo_proveedor, telefono_proveedor, direccion_proveedor, url_proveedor, tipo_documento, numero_documento
                        FROM Proveedores 
                        ORDER BY nombre_proveedor';
                $params = null;
                return Database::getRows($sql, $params);
            }

        public function readOneProveedores()
            {
                $sql = 'SELECT id_proveedor, nombre_proveedor, correo_proveedor, telefono_proveedor, direccion_proveedor, url_proveedor, tipo_documento, numero_documento
                        FROM Proveedores 
                        WHERE id_proveedor = ?';
                $params = array($this->id);
                return Database::getRow($sql, $params);
            }

        public function updateProveedores()
            {
                $sql = 'UPDATE Proveedores 
                        SET nombre_proveedor = ?, correo_proveedor = ?, telefono_proveedor = ?, direccion_proveedor = ?, url_proveedor = ?, tipo_documento = ?, numero_documento = ?
                        WHERE id_proveedor = ?';
                $params = array($this->nombre_proveedor, $this->correo_proveedor, $this->telefono_proveedor, $this->direccion_proveedor, $this->url_proveedor, $this->tipo_documento, $this->numero_documento, $this->id);
                return Database::executeRow($sql, $params);
            }

        public function deleteProveedores()
            {
                $sql = 'DELETE FROM Proveedores 
                        WHERE id_proveedor = ?';
                $params = array($this->id);
                return Database::executeRow($sql, $params);
            }
    }
    
?>