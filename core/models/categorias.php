<?php
    class Categorias extends Validator
    {
        private $id = null;
        private $nombre = null;
        private $imagen = null;
        private $archivo = null;
        private $ruta = '../../../resources/img/categorias/';

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
            if($this->validateAlphanumeric($value, 1, 50)) {
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

        public function searchCategorias($value)
            {
                $sql = 'SELECT id_categoria, categoria, imagen_categoria
                        FROM categorias
                        WHERE categoria ILIKE ?
                        ORDER BY categoria';
                $params = array("%$value%", "%$value%");
                return Database::getRows($sql, $params);
            }

        public function createCategoria()
            {
                if ($this->saveFile($this->archivo, $this->ruta, $this->imagen)) {
                    $sql = 'INSERT INTO categorias(categoria, imagen_categoria)
                            VALUES(?, ?, ?)';
                    $params = array($this->nombre, $this->imagen, $this->descripcion);
                    return Database::executeRow($sql, $params);
                } else {
                    return false;
                }
            }

        public function readAllCategorias()
            {
                $sql = 'SELECT id_categoria, categoria, imagen_categoria
                        FROM categorias
                        ORDER BY categoria';
                $params = null;
                return Database::getRows($sql, $params);
            }

        public function readOneCategoria()
            {
                $sql = 'SELECT id_categoria, categoria, imagen_categoria
                        FROM categorias
                        WHERE id_categoria = ?';
                $params = array($this->id);
                return Database::getRow($sql, $params);
            }

        public function updateCategoria()
            {
                if ($this->saveFile($this->archivo, $this->ruta, $this->imagen)) {
                    $sql = 'UPDATE categorias
                            SET imagen_categoria = ?, categoria = ?
                            WHERE id_categoria = ?';
                    $params = array($this->imagen, $this->nombre, $this->descripcion, $this->id);
                } else {
                    $sql = 'UPDATE categorias
                            SET categoria = ?
                            WHERE id_categoria = ?';
                    $params = array($this->nombre, $this->descripcion, $this->id);
                }
                return Database::executeRow($sql, $params);
            }

        public function deleteCategoria()
            {
                $sql = 'DELETE FROM categorias
                        WHERE id_categoria = ?';
                $params = array($this->id);
                return Database::executeRow($sql, $params);
            }
    }  
?>