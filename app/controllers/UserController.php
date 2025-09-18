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
        $page = 1;
        if(isset($_GET['page']) && ! empty($_GET['page'])) {
            $page = $this->io->get('page');
        }

        $q = '';
        if(isset($_GET['q']) && ! empty($_GET['q'])) {
            $q = trim($this->io->get('q'));
        }

        $records_per_page = 5;

        $all = $this->UserModel->page($q, $records_per_page, $page);
        $data['all'] = $all['records'];
        $total_rows = $all['total_rows'];
        $this->pagination->set_options([
            'first_link'     => '⏮ First',
            'last_link'      => 'Last ⏭',
            'next_link'      => 'Next →',
            'prev_link'      => '← Prev',
            'page_delimiter' => '&page='
        ]);
        $this->pagination->set_theme('bootstrap'); // or 'tailwind', or 'custom'
        $this->pagination->initialize($total_rows, $records_per_page, $page, 'user/show?q='.$q);
        $data['page'] = $this->pagination->paginate();
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