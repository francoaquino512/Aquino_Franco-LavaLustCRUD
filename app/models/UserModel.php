<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Model: StudentsModel
 * 
 * Automatically generated via CLI.
 */
class UserModel extends Model {

    /**
     * Table associated with the model.
     * @var string
     */
    protected $table = 'students';

    /**
     * Primary key of the table.
     * @var string
     */

    protected $allowed_fields = ['first_name', 'last_name', 'email', 'Role'];
    protected $validation_rules = [
        'first_name' => 'required|min_length[2]|max_length[100]',
        'last_name' => 'max_length[100]',
        'email' => 'required|valid_email|max_length[150]',
         'Role'       => 'max_length[50]'
    ];

    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    public function page($q = '', $records_per_page = null, $page = null)
    {
        if (is_null($page)) {
            // return all without pagination
            return [
                'total_rows' => $this->db->table($this->table)->count_all(),
                'records'    => $this->db->table($this->table)->get_all()
            ];
        } else {
            $query = $this->db->table($this->table);

            if (!empty($q)) {
                $query->like('first_name', '%'.$q.'%')
                      ->or_like('last_name', '%'.$q.'%')
                      ->or_like('email', '%'.$q.'%')
                      ->or_like('Role', '%'.$q.'%');
            }

            // count total rows
            $countQuery = clone $query;
            $data['total_rows'] = $countQuery->select_count('*', 'count')->get()['count'];

            // fetch paginated records
            $data['records'] = $query->pagination($records_per_page, $page)->get_all();

            return $data;
        }
        
    }

     public function get_all()
    {
        return $this->db->table('students')->get_all();
    }
}