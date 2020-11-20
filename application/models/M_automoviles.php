<?php

class M_automoviles extends CI_Model{
    
    public function marcas(){
        $sql="select distinct marca from automovil";
        return $this->db->query($sql)->result();
    }
    
    public function cochesPorMarca($marca){
        $sql="select id, marca, modelo, matricula, anio, combustible, precio_base_dia as precio, devuelto"
                . " from automovil"
                . " where upper(marca)=upper('$marca')";
        $coches=$this->db->query($sql)->result();
        $ret=array();
        foreach ($coches as $coche) {
            $imagenes= $this->imagenesCoche($coche->id);
            if(count($imagenes)>0){
                $coche->imagen=$imagenes[0]->imagen;
            }
            else{
                $coche->imagen="img/generico.jpg";
            }
            $ret[]=$coche;
        }
        return $ret;
    }
    
    public function todosLosCoches(){
        $sql="select id, marca, modelo, matricula, anio, combustible, precio_base_dia as precio, devuelto"
                . " from automovil";
        $coches=$this->db->query($sql)->result();
        $ret=array();
        foreach ($coches as $coche) {
            $imagenes= $this->imagenesCoche($coche->id);
            if(count($imagenes)>0){
                $coche->imagen=$imagenes[0]->imagen;
            }
            else{
                $coche->imagen="img/generico.jpg";
            }
            $ret[]=$coche;
        }
        return $ret;
    }
    public function pillarBuga($idcoche){
        $sql="select id, marca, modelo, matricula, anio, combustible, precio_base_dia as precio"
                . " from automovil"
                . " where id=$idcoche";
        return $this->db->query($sql)->row();
    }
    public function imagenesCoche($idcoche){
        $sql="select idautomovil, imagen from imagenes where idautomovil=$idcoche";
        return $this->db->query($sql)->result();
    }
    public function login($user, $pass){
        $sql_pass="select password from cliente where username='$user'";
        $pss="";
        $rs= $this->db->query($sql_pass);
         if($rs->num_rows()>0){
             $pss=$rs->row()->password;
         }
         else{
             return null;
         }
        $sql="select id, nombre, dni, username, password, email, premium, cuenta_bancaria"
                . " from cliente"
                . " where username='$user'"
                . " and '$pass'='".$this->encryption->decrypt($pss)."'";
        $rs= $this->db->query($sql);
        if($rs->num_rows()>0)
            return $rs->row();
        else
            return null;
    }
    public function calcularPrecio($idcliente, $precio_base){
        $sql="select premium from cliente where id=$idcliente";
        $premium= $this->db->query($sql)->row()->premium;
        if($premium==1){
            return $precio_base*0.9;
        }
        else
            return $precio_base;
    }
    
    public function confirmarAlquiler($iduser, $alquileres){
        $con=1;
        $values="";
        $where="";
        foreach ($alquileres as $id => $arr){
            $tiempo= now();
            $entrega=now()+$arr['dias']*24*3600;
            $ahora= date_create();
            date_timestamp_set($ahora, $tiempo);
            $fecha_entrega= date_create();
            date_timestamp_set($fecha_entrega, $entrega);
            $seguro=1;
            $precio=$arr['precio'];
            if($arr['seguro']!=1){
                $seguro=0;
            }
            else{
                $precio*=1.3;
            }
            $where.="id=$id";
            $values.="(null, $iduser, $id, STR_TO_DATE('".$ahora->format('Y-m-d H:i:s')."', '%Y-%m-%d %h:%i:%s'), STR_TO_DATE('". $fecha_entrega->format('Y-m-d H:i:s')."', '%Y-%m-%d %h:%i:%s'), $seguro, ".$precio.")";
            if($con!=count($alquileres)){
                $values.=", ";
                $where.=" or ";
            }
            $con++;
        }
        $sql="insert into alquiler (id, idcliente, idautomovil, fecha_desde, fecha_hasta, seguro, precio_final)"
                . " values ".$values;
        $this->db->query($sql);
        $sql2="update automovil set devuelto=0 where $where";
        $this->db->query($sql2);
    }
    
    public function devolverAuto($idcoche){
        $sql="update automovil set devuelto=1 where id=$idcoche";
        $sql1="select TIMESTAMPDIFF(DAY, now(), fecha_hasta) as restante from alquiler where idautomovil=$idcoche and fecha_hasta>now()";
        $restante=$this->db->query($sql1)->row()->restante;
        if($restante>1){
            $sql2="select precio_final as precio, fecha_desde, fecha_hasta from alquiler where idautomovil=$idcoche and fecha_hasta>now()";
            $alq=$this->db->query($sql2)->row();
            $tiempo= (strtotime($alq->fecha_hasta)-strtotime($alq->fecha_desde))/(3600*24);
            $precio=$alq->precio - (($alq->precio)/$tiempo*$restante);
            $sql2="update alquiler set precio_final=$precio where idautomovil=$idcoche and fecha_hasta>now()";
            $this->db->query($sql2);
        }
        $sql3="update alquiler set fecha_hasta=now() where idautomovil=$idcoche and fecha_hasta>now()";
        $this->db->query($sql);
        $this->db->query($sql3);
    }
    public function registrarUsuario($nom, $dni, $usr, $pass, $mail, $iban, $premium){
        $pass=$this->encryption->encrypt($pass);
        if($premium)
            $premium=1;
        else
            $premium=0;
        $sql="insert into cliente(id, nombre, dni, username, password, email, premium, cuenta_bancaria)"
                . " values(null, '$nom', '$dni', '$usr', '$pass', '$mail', $premium, '$iban')";
        $this->db->query($sql);
        if ($this->db->affected_rows()==1)
            return true;
        else
            return false;
    }
}
    
?>