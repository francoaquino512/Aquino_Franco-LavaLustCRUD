<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserController extends Controller {
    public function __construct()
    {
        parent::__construct();

        //$this->call->model('UserModel');
        $this->call->library('pagination'); 
        $this->call->library('auth'); 

        // ✅ Require login
        if (!$this->auth->is_logged_in()) {
            redirect('auth/login');
        }
    }

 

    public function show()
    {
        $page = 1;
        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $page = $this->io->get('page');
        }

        $q = '';
        if (isset($_GET['q']) && !empty($_GET['q'])) {
            $q = trim($this->io->get('q'));
        }

        $records_per_page = 5;

        $all = $this->UserModel->page($q, $records_per_page, $page);
        $data['students'] = $all['records'];
        $total_rows = $all['total_rows'];

        // Pagination setup
        $this->pagination->set_options([
            'first_link'     => '⏮ First',
            'last_link'      => 'Last ⏭',
            'next_link'      => 'Next →',
            'prev_link'      => '← Prev',
            'page_delimiter' => '&page='
        ]);

        $this->pagination->set_theme('default');
        $this->pagination->initialize(
            $total_rows,
            $records_per_page,
            $page,
            site_url('/students') . '?q=' . urlencode($q)
        );
        $data['page'] = $this->pagination->paginate();

        $this->call->view('students/show', $data);
    }

    function create(){
        if ($_SESSION['role'] !== 'admin') {
    // redirect regular users to the dashboard
    redirect(site_url('auth/dashboard'));
    exit;
}


        if ($this->io->method() == 'post') {
            $firstname= $this->io->post('first_name');
            $lastname= $this->io->post('last_name');
            $email= $this->io->post('email');
             $role= $this->io->post('role');

            $data = array(
                'first_name' => $firstname,
                'last_name' => $lastname,
                'email' => $email,
                'Role' => $role
            );

            if ($this->UserModel->insert($data)) {
                redirect(site_url('/students'));
            } else {
                echo 'Error creating student.';
            }
        } else {
            $this->call->view('create');
        }
    }

     function update($id){
        if ($_SESSION['role'] !== 'admin') {
    // redirect regular users to the dashboard
    redirect(site_url('auth/dashboard'));
    exit;
}


        $students = $this->UserModel->find($id);
        if(!$students) {
            echo "Student not found.";
            return;
        }

        if ($this->io->method() == 'post') {
            $firstname= $this->io->post('first_name');
            $lastname= $this->io->post('last_name');
            $email= $this->io->post('email');
            $role= $this->io->post('role');
            

            $data = array(
                'first_name' => $firstname,
                'last_name' => $lastname,
                'email' => $email,
                'Role' => $role
            );

            if ($this->UserModel->update($id, $data)) {
                redirect(site_url('/students'));
            } else {
                echo 'Error updating student.';
            }
        } else {
            $data['student'] = $students;
            $this->call->view('update', $data);
        }
    }
     function delete($id){
        if ($_SESSION['role'] !== 'admin') {
    // redirect regular users to the dashboard
    redirect(site_url('auth/dashboard'));
    exit;
}


        if($this->UserModel->delete($id)){
            redirect(site_url('/students'));
        } else {
            echo 'Error deleting student.';
        }
    }


    /*public function soft_delete($id)
    {
        // ✅ Admin only
        if ($_SESSION['role'] !== 'admin') {
            redirect(site_url('auth/dashboard'));
            exit;
        }

        if ($this->UserModel->soft_delete($id)) {
            redirect('user/show');
        } else {
            echo 'Failed to delete data.';
        }
    }
        */

    public function restore($id)
    {
        // ✅ Admin only
        if ($_SESSION['role'] !== 'admin') {
            redirect(site_url('auth/dashboard'));
            exit;
        }

        if ($this->UserModel->restore($id)) {
            redirect('/students');
        } else {
            echo 'Failed to restore data.';
        }
    }
}
