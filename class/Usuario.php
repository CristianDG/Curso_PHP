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

    function __construct($login = "", $senha = ""){
        $this->setLogin($login);
        $this->setSenha($senha);
    }

    public function loadById($id){
        $sql = new Sql();

        $res = $sql->select("SELECT * FROM tb_usuario WHERE id_usuario = :ID", array(
            ":ID"=>$id
        ));

        if(count($res)>0){
            $this->setData($res[0]);
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

    public static function getList(){
        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_usuario ORDER BY login");
    }

    static function search($login){
        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_usuario WHERE login LIKE :SEARCH ORDER BY login",array(
            ":SEARCH"=>"%{$login}%"
        ));
    }

    public function login($login,$senha){
        $sql = new Sql();

        $res = $sql->select("SELECT * FROM tb_usuario WHERE login = :LOGIN AND senha = :SENHA", array(
            ":LOGIN"=>$login,
            ":SENHA"=>$senha
        ));

        if(count($res)>0){
            $this->setData($res[0]);
        }else{
            throw new Exception("Login e/ou senha inválidos.");
        }
    }

    protected function setData($data){
        $this->setId_usuario($data->id_usuario);
        $this->setLogin($data->login);
        $this->setSenha($data->senha);
        $this->setData_cadastro(new DateTime($data->data_cadastro));
    }

    public function insert(){
        $sql = new Sql;

        $res = $sql->select("CALL sp_usuarios_insert(:LOGIN,:SENHA)", array(
            ':LOGIN'=>$this->getLogin(),
            ':SENHA'=>$this->getSenha()
        ));

        if(count($res)>0){
            $this->setData($res[0]);
        }

    }

    public function update($login,$senha){
        
        $sql = new Sql();

        $this->setLogin($login);
        $this->setSenha($senha);

        $sql->query("UPDATE tb_usuario SET login = :LOGIN, senha = :SENHA WHERE id_usuario = :ID",array(
            ":LOGIN"=>$this->getLogin(),
            ":SENHA"=>$this->getSenha(),
            ":ID"=> $this->getId_usuario()
        ));

    }

    public function delete(){
        $sql = new Sql();

        $sql->query("DELETE FROM tb_usuario WHERE id_usuario = :ID", array(
            ':ID'=>$this->getId_usuario()
        ));
    
        $this->setId_usuario(null);
        $this->setLogin(null);
        $this->setSenha(null);
        $this->setData_cadastro(new DateTime());
    }

}

?>