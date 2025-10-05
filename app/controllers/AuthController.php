<?php
class AuthController extends Controller
{

    public function register()
    {
        $this->call->library('auth');

        if ($this->io->method() == 'post') {
            $username = $this->io->post('username');
            $password = $this->io->post('password');
            $role = $this->io->post('role') ?? 'user';

            if ($this->auth->register($username, $password, $role)) {
                redirect('/students');
            }
        }

        $this->call->view('auth/register');
    }

    public function login()
{
    $this->call->library('auth');

    if ($this->io->method() == 'post') {
        $username = $this->io->post('username');
        $password = $this->io->post('password');

        if ($this->auth->login($username, $password)) {

            // check role and redirect accordingly
            if ($this->auth->has_role('admin')) {
                redirect('/students'); // full access page
            } else {
                redirect('auth/dashboard'); // user view-only page
            }

        } else {
            echo 'Login failed!';
        }
    }

    $this->call->view('auth/login');
}


public function dashboard()
{
    // All users can view the student list
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
        
    $this->call->library('auth');

    if (!$this->auth->is_logged_in()) {
        redirect('auth/login');
    }

    $role = $_SESSION['role'] ?? 'user';

    if ($role === 'admin') {
        redirect('/students');
    }

}



    public function logout()
    {
        $this->call->library('auth');
        $this->auth->logout();
        redirect('auth/login');
    }
    
}
?>