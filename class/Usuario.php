<?php 

class Usuario{

    private $id_usuario;
    private $login;
    private $senha;
    private $data_cadastro;


    // getters e setters

    public function getId_usuario(){
        return $this->id_usuario;
    }

    public function setId_usuario($val){
        $this->id_usuario = $val;
    }

    public function getLogin(){
        return $this->login;
    }

    public function setLogin($val){
        $this->login = $val;
    }

    public function getSenha(){
        return $this->senha;
    }

    public function setSenha($val){
        $this->senha = $val;
    }

    public function getData_cadastro(){
        return $this->data_cadastro;
    }

    public function setData_cadastro($val){
        $this->data_cadastro = $val;
    }

    //metodos

    public function loadById($id){
        $sql = new Sql();

        $res = $sql->select("SELECT * FROM tb_usuario WHERE id_usuario = :ID", array(
            ":ID"=>$id
        ));

        if(count($res)>0){
            $row = $res[0];

            $this->setId_usuario($row->id_usuario);
            $this->setLogin($row->login);
            $this->setSenha($row->senha);
            $this->setData_cadastro(new DateTime($row->data_cadastro));

        }

    }

    public function __toString(){
        return json_encode(array(
            "id_usuario" => $this->getId_usuario(),
            "login"=> $this->getLogin(),
            "senha"=> $this->getSenha(),
            "data_cadastro"=> $this->getData_cadastro()->format("d/m/Y H:i:s")
        ));
    }


}

?>