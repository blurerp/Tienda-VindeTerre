<?php
/*
*	Clase para manejar la tabla usuarios de la base de datos. Es clase hija de Validator.
*/
class Usuarios extends Validator
{
    // Declaración de atributos (propiedades).
    private $id = null;
    private $usuario = null;
    private $nombres = null;
    private $apellidos = null;
    private $fecha = null;
    private $dui = null;
    private $correo = null;
    private $clave = null;
    private $estado = null;
    private $tipo = null;

    /*
    *   Métodos para asignar valores a los atributos.
    */
    public function setId($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->id = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setNombres($value)
    {
        if ($this->validateAlphabetic($value, 1, 50)) {
            $this->nombres = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setApellidos($value)
    {
        if ($this->validateAlphabetic($value, 1, 50)) {
            $this->apellidos = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setCorreo($value)
    {
        if ($this->validateEmail($value)) {
            $this->correo = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setAlias($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->usuario = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setClave($value)
    {
        if ($this->validatePassword($value)) {
            $this->clave = $value;
            return true;
        } else {
            return false;
        }
    }

    /*
    *   Métodos para obtener valores de los atributos.
    */
    public function getId()
    {
        return $this->id;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function getNombres()
    {
        return $this->nombres;
    }

    public function getApellidos()
    {
        return $this->apellidos;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function getDui()
    {
        return $this->dui;
    }

    public function getCorreo()
    {
        return $this->correo;
    }

    public function getClave()
    {
        return $this->clave;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function getTipo()
    {
        return $this->tipo;
    }


    /*
    *   Métodos para gestionar la cuenta del usuario.
    */
    public function checkAlias($usuario)
    {
        $sql = 'SELECT id_usuario FROM usuarios WHERE usuario = ?';
        $params = array($usuario);
        if ($data = Database::getRow($sql, $params)) {
            $this->id = $data['id_usuario'];
            $this->usuario = $usuario;
            return true;
        } else {
            return false;
        }
    }

    public function checkPassword($password)
    {
        $sql = 'SELECT contrasena_usuario FROM usuarios WHERE id_usuario = ?';
        $params = array($this->id);
        $data = Database::getRow($sql, $params);
        if (password_verify($password, $data['contrasena_usuario'])) {
            return true;
        } else {
            return false;
        }
    }

    public function changePassword()
    {
        // Se encripta la clave por medio del algoritmo bcrypt que genera un string de 60 caracteres.
        $hash = password_hash($this->clave, PASSWORD_DEFAULT);
        $sql = 'UPDATE usuarios SET contrasena_usuario = ? WHERE id_usuario = ?';
        $params = array($hash, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function editProfile()
    {
        $sql = 'UPDATE usuarios
                SET nombre_usuario = ?, apellido_usuario = ?, email_usuario = ?,fecha_nacimiento = ?,dui_usuario =?, usuario = ?
                WHERE id_usuario = ?';
        $params = array($this->nombres, $this->apellidos, $this->correo, $this->fecha, $this->dui, $this->usuario, $this->id);

        return Database::executeRow($sql, $params);
    }

    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    */
    public function searchUsuarios($value)
    {
        $sql = 'SELECT id_usuario, usuario, nombre_usuario, apellido_usuario, email_usuario,fecha_nacimiento, email_usuario, dui_usuario, estado_usuario FROM usuarios
                WHERE apellido_usuario ILIKE ? OR nombre_usuario ILIKE ?
                ORDER BY apellidos_usuario';
        $params = array("%$value%", "%$value%");
        return Database::getRows($sql, $params);
    }

    public function createUsuario()
    {
        // Se encripta la clave por medio del algoritmo bcrypt que genera un string de 60 caracteres.
        $hash = password_hash($this->clave, PASSWORD_DEFAULT);
        $estado = 'Activo';
        $tipo = '2';
        $sql = 'INSERT INTO usuarios(usuario, nombre_usuario, apellido_usuario, email_usuario,fecha_nacimiento, dui_usuario, contrasena_usuario, estado_usuario, tipo_usuario)
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $params = array($this->usuario, $this->nombres, $this->apellidos, $this->correo, $this->fecha, $this->dui, $hash, $estado, $tipo);
        return Database::executeRow($sql, $params);
    }


    public function readAllUsuarios()
    {
        $sql = 'SELECT id_usuario, nombre_usuario, apellido_usuario, email_usuario, usuario
                FROM usuarios
                ORDER BY apellido_usuario';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readOneUsuario()
    {
        $sql = 'SELECT id_usuario, nombre_usuario, apellido_usuario, email_usuario, usuario
                FROM usuarios
                WHERE id_usuario = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function updateUsuario()
    {
        $sql = 'UPDATE usuarios 
                SET nombre_usuario = ?, apellido_usuario = ?, email_usuario = ?
                WHERE id_usuario = ?';
        $params = array($this->nombres, $this->apellidos, $this->correo, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function deleteUsuario()
    {
        $sql = 'DELETE FROM usuarios
                WHERE id_usuario = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }
}
