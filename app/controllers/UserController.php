<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserController extends Controller {
	public function __construct() {
		parent::__construct();
	}

    public function profile($username, $name){
        $data['username'] = $username;
        $data['name'] = $name;
        $this->call->view('profile', $data);
    }
    
    public function show(){
       $data['users'] = $this->UserModel->all();
       $this->call->view('show', $data);
    }

    public function create(){
        if($this->io->method() == 'post'){
            $username = $this->io->post('username');
            $email = $this->io->post('email');
            $role = $this->io->post('role');
            $data = array(
                'username' => $username,
                'email' => $email,
                'role' => $role
            );
            if($this->UserModel->insert($data)){
                redirect('user/show');
            }
            else{
                echo 'Something went wrong.';
            }
        }else{
             $this->call->view('create');
        }
    }

    public function update($id){
        $data['user'] = $this->UserModel->find($id);
        if($this->io->method() == 'post'){
            $username = $this->io->post('username');
            $email = $this->io->post('email');
            $role = $this->io->post('role');
            $data = array(
              'username' => $username,
              'email' => $email,
              'role' => $role
            );
            if($this->UserModel->update($id, $data)){
                redirect('user/show');
            } else{
                echo 'Something went wrong.';
            }
        }
        $this->call->view('update', $data);
    }

    public function delete($id){
        if($this->UserModel->delete($id)){
            redirect('user/show');
        } else{
            echo 'Something went wrong';
        }
    }

    public function soft_delete($id){
       if($this->UserModel->soft_delete($id)){
            redirect('user/show');
        } else{
            echo 'Something went wrong';
        } 
    }

    public function restore($id){
        if($this->UserModel->restore($id)){
        redirect('user/show');
        } else{
            echo 'Something went wrong';
        } 
    }
}
?>