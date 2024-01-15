<?php
class Auth extends CI_Controller 
{
    public function index()
    {
        echo '5555';
    }
    public function login()
    {
       $email = $this->input->post('email');
       $password = $this->input->post('password');
        
       $this->load->model('auth_model');
        
       $this->form_validation->set_rules('email','Email','required');
       $this->form_validation->set_rules('password','Password','required');
       
       if ($this->form_validation->run())
       {
           $check_login = $this->auth_model->login($email,$password);
           
           if($check_login)
           {
               echo 'yess';
           }else{
               echo 'nooo';
           }
       }
       
       $this->load->view('auth/login');
    }
    
    public function register()
    {
        $this->load->model('auth_model');
        
        $this->form_validation->set_rules('firstname','Firstname','required');
        $this->form_validation->set_rules('lastname','Lastname','required');
        $this->form_validation->set_rules('email','E-mail','required');
        $this->form_validation->set_rules('password','Password','required|min_length[3]');
        $this->form_validation->set_rules('confirm_password','Confirm_Password','required|matches[password]');
        
        $user_info = array();
        
        $user_info['firstname'] = $this->input->post('firstname');
        $user_info['lastname'] = $this->input->post('lastname');
        $user_info['email'] = $this->input->post('email');
        $user_info['password'] = $this->input->post('password');
        
        if ($this->form_validation->run())
        {
            if($this->auth_model->check_email($user_info))
            {
                echo '555555';
            } else {
                $add_user = $this->auth_model->register($user_info);
                if($add_user)
                {
                    echo 'model success'; 
                }
            }
        } 
        $this->load->view('auth/register');
    }
}