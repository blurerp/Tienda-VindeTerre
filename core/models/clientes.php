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


    //Set
    public function setId($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->id = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setNombre_cliente($value)
    {
        if ($this->validateAlphabetic($value, 1, 40)) {
            $this->nombre_cliente = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setApellido_cliente($value)
    {
        if ($this->validateAlphabetic($value, 1, 40)) {
            $this->apellido_cliente = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setUsuario_cliente($value)
    {
        if ($this->validateAlphabetic($value, 1, 40)) {
            $this->usuario_cliente = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setContrasena_cliente($value)
    {
        if ($this->validatePassword($value)) {
            $this->contrasena_cliente = $value;
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

    public function setTipo_cliente($value)
    {
        if ($this->validateAlphabetic($value, 1, 40)) {
            $this->tipo_cliente = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setDui_cliente($value)
    {
        if ($this->validateDui($value)) {
            $this->dui_cliente = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setEmail_cliente($value)
    {
        if ($this->validateEmail($value)) {
            $this->email_cliente = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setTelefono_cliente($value)
    {
        if ($this->validateTelefono($value)) {
            $this->telefono_cliente = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setNit_cliente($value)
    {
        return true;
    }
    
    //Get
    
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

    public function getContrasena_cliente()
    {
        return $this->contrasena_cliente;
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
    //end GET
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

    public function createRow()
    {
        // Se encripta la clave por medio del algoritmo bcrypt que genera un string de 60 caracteres.
        $hash = password_hash($this->contrasena_cliente, PASSWORD_DEFAULT);
        $this->estado_cliente = 'Activo';
        $sql = 'INSERT INTO Clientes(nombre_cliente, apellido_cliente, usuario_cliente, contrasena_cliente, foto_cliente, estado_cliente, tipo_cliente, dui_cliente, email_cliente, telefono_cliente, nit_cliente)
        VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $params = array($this->nombre_cliente, $this->apellido_cliente, $this->usuario_cliente, $hash,$this->imagen,$this->estado_cliente, $this->tipo_cliente, $this->dui_cliente, $this->email_cliente, $this->telefono_cliente, $this->nit_cliente);
        return Database::executeRow($sql, $params);
    }

    public function updateClientes()
    {

        $sql = 'UPDATE Clientes 
                    SET estado_cliente = ?
                    WHERE id_cliente = ?';
        $params = array($this->estado_cliente, $this->id);
        return Database::executeRow($sql, $params);
    }

    /*
    *   Métodos para gestionar la cuenta del cliente.
    */
    public function checkUser($email_cliente)
    {
        $sql = 'SELECT id_cliente, estado_cliente FROM clientes WHERE email_cliente = ?';
        $params = array($email_cliente);
        if ($data = Database::getRow($sql, $params)) {
            $this->id = $data['id_cliente'];
            $this->estado_cliente = $data['estado_cliente'];
            $this->email_cliente = $email_cliente;
            return true;
        } else {
            return false;
        }
    }

    public function checkPassword($contrasena_cliente)
    {
        $sql = 'SELECT contrasena_cliente FROM clientes WHERE id_cliente = ?';
        $params = array($this->id);
        $data = Database::getRow($sql, $params);
        if (password_verify($contrasena_cliente, $data['contrasena_cliente'])) {
            return true;
        } else {
            return false;
        }
    }

    public function changePassword()
    {
        $hash = password_hash($this->contrasena_cliente, PASSWORD_DEFAULT);
        $sql = 'UPDATE clientes SET contrasena_cliente = ? WHERE id_cliente = ?';
        $params = array($hash, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function editProfile()
    {
        $sql = 'UPDATE clientes
                SET nombre_cliente = ?, apellido_cliente  = ?, email_cliente = ?, dui_cliente = ?, telefono_cliente = ?, nit_cliente = ?
                WHERE id_cliente = ?';
        $params = array($this->nombre_cliente, $this->apellido_cliente, $this->email_cliente, $this->dui_cliente, $this->telefono_cliente, $this->nit_cliente, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function countTypeClientes()
    {
        $activo= 'Empresa';
        

        
        $sql = 'SELECT count(tipo_cliente) as tipo_cliente from clientes where tipo_cliente= ?';
        $params = array($activo);
        return Database::getRows($sql, $params);
    
    
}
    public function countTypeClientesI()
    {

    $inactivo= 'Persona Natural';
    $sql = 'SELECT count(tipo_cliente) as cant from clientes where tipo_cliente= ?';
        $params = array($inactivo);
        return Database::getRows($sql, $params);
    }

    public function readC()
    {
        $pn= 'Persona Natural';
        $sql = 'SELECT id_cliente, nombre_cliente, apellido_cliente, usuario_cliente, foto_cliente, estado_cliente, tipo_cliente, dui_cliente, email_cliente, telefono_cliente, nit_cliente
                    FROM Clientes
                    where tipo_cliente= ? ORDER BY estado_cliente';
        $params = array($pn);
        return Database::getRows($sql, $params);
    }

    public function readC2()
    {
        $pn= 'Empresa';
        $sql = 'SELECT id_cliente, nombre_cliente, apellido_cliente, usuario_cliente, foto_cliente, estado_cliente, tipo_cliente, dui_cliente, email_cliente, telefono_cliente, nit_cliente
                    FROM Clientes
                    where tipo_cliente= ? ORDER BY estado_cliente';
        $params = array($pn);
        return Database::getRows($sql, $params);
    }
    
}
