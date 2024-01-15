<?php
class Auth_model extends CI_Model
{
    public function login($email=null,$password=null)
    {
        $query = $this->db->query("SELECT * FROM users");
        $hashed_password = md5($password);
        
        foreach($query->result() as $row){
            if($row->email == $email && $row->password == $hashed_password){
                return true;
            }
        }return false;
    }
    
    public function register($user_info)
    {
        $build_data = array(
            'firstname' => $user_info['firstname'],
            'lastname' => $user_info['lastname'],
            'email' => $user_info['email'],
            'password' => md5($user_info['password'])
        );
        
        $sql = $this->db->insert_string('users', $build_data);
        $this->db->query($sql);        
        return true;
    }
    
    public function check_email($user_info)
    {
        $this->db->get_where('users', array('email' => $user_info['email']), 1);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }
}