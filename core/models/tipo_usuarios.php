<?php

    class Tipo_Usuarios extends Validator 
    {
        private $id = null;
        private $tipo_usuario = null;

        public function setId($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->id = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setTipo_usuario($value)
        {
            if ($this->validateAlphabetic($value, 1, 20)) {
                $this->tipo_usuario = $value;
                return true;
            } else {
                return false;
            }
        }

        public function getId()
        {
            return $this->id;
        }

        public function getTipo_usuario()
        {
            return $this->tipo_usuario;
        }

        public function readAllTipo_usuarios()
            {
                $sql = 'SELECT id_tipo_usuario, tipo_usuario
                        FROM Tipo_Usuario 
                        ORDER BY tipo_usuario';
                $params = null;
                return Database::getRows($sql, $params);
            }
        public function readOneTipo_usuarios()
            {
                $sql = 'SELECT id_tipo_usuario, tipo_usuario
                        FROM Tipo_Usuario 
                        WHERE id_tipo_usuario = ?';
                $params = array($this->id);
                return Database::getRow($sql, $params);
            }
    }
?>