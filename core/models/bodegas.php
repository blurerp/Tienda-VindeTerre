<?php
    class Bodegas extends Validator
    {
        private $id = null;
        private $capacidad = null;
        private $direccion_bodega = null;
        private $telefono_bodega = null;
        
        public function setId($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->id = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setcapacidad($value)
        {
            if($this->validateNaturalNumber($value, 1, 999999)) {
                $this->capacidad = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setDireccion_bodega($value)
        {
            if($this->validateString ($value, 1, 300)) {
                $this->direccion_bodega = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setTelefono_bodega($value)
        {
            if($this->validateTelefono($value)) {
                $this->telefono_bodega = $value;
                return true;
            } else {
                return false;
            }
        }

        public function getId()
        {
            return $this->id;
        }

        public function getcapacidad()
        {
            return $this->capacidad;
        }
        
        public function getDireccion_bodega()
        {
            return $this->direccion_bodega;
        }

        public function getTelefono_bodega()
        {
            return $this->telefono_bodega;
        }

        public function searchBodegas($value)
            {
                $sql = 'SELECT id_bodega, capacidad, direccion_bodega, telefono_bodega
                        FROM Bodegas 
                        WHERE direccion_bodega ILIKE ?
                        ORDER BY capacidad';
                $params = array("%$value%", "%$value%");
                return Database::getRows($sql, $params);
            }

        public function createBodegas()
            {
                    $sql = 'INSERT INTO Bodegas (capacidad, direccion_bodega, telefono_bodega)
                            VALUES(?, ?, ?)';
                    $params = array($this->capacidad, $this->direccion_bodega, $this->telefono_bodega);
                    return Database::executeRow($sql, $params);

            }

        public function readAllBodegas()
            {
                $sql = 'SELECT id_bodega, capacidad, direccion_bodega, telefono_bodega
                        FROM Bodegas 
                        ORDER BY capacidad';
                $params = null;
                return Database::getRows($sql, $params);
            }

        public function readOneBodegas()
            {
                $sql = 'SELECT id_bodega, capacidad, direccion_bodega, telefono_bodega
                        FROM Bodegas 
                        WHERE id_bodega = ?';
                $params = array($this->id);
                return Database::getRow($sql, $params);
            }

        public function updateBodegas()
            {
                $sql = 'UPDATE Bodegas 
                        SET capacidad = ?, direccion_bodega = ?, telefono_bodega = ?
                        WHERE id_bodega = ?';
                $params = array($this->capacidad, $this->direccion_bodega, $this->telefono_bodega, $this->id);
                return Database::executeRow($sql, $params);
            }

        public function deleteBodegas()
            {
                $sql = 'DELETE FROM Bodegas 
                        WHERE id_bodega = ?';
                $params = array($this->id);
                return Database::executeRow($sql, $params);
            }
    }
    
?>