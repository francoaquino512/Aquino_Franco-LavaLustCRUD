<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserModel extends Model {
    protected $table ='users';
    protected $primary_key = 'id';
	public function __construct() {
		parent::__construct();
	}  

	 public function page($q, $records_per_page = null, $page = null) {
            if (is_null($page)) {
                return $this->db->table($this->table)->where_null('deleted_at')->get_all();
            } else {
                $query = $this->db->table($this->table);
                $query->where_null('deleted_at');
                

                // Build LIKE conditions
                if(!empty($q)){
                   $query->like('id', '%'.$q.'%')
                    ->or_like('username', '%'.$q.'%')
					->or_like('email', '%'.$q.'%')
                    ->or_like('role', '%'.$q.'%'); 
                }
                $query->order_by('id', 'ASC');

                // Clone before pagination
                $countQuery = clone $query;

                $data['total_rows'] = $countQuery->select_count('*', 'count')->get()['count'];

                $data['records'] = $query->pagination($records_per_page, $page)->get_all();
                return $data;
            }
        }
    
   public function restore_page($q, $records_per_page = null, $page = null) {
            if (is_null($page)) {
                return $this->db->table($this->table)->where_not_null('deleted_at')->get_all();
            } else {
                $query = $this->db->table($this->table);

                $query->where_not_null('deleted_at');
                
                // Build LIKE conditions
                if(!empty($q)){
                    $q = trim($q);
                    $query->where("('id' LIKE '%'.$q.'%'
                               OR 'username' LIKE '%'.$q.'%'
                               OR 'email' LIKE '%'.$q.'%'
                               OR 'role' LIKE '%'.$q.'%')");
                }
                $query->order_by('id', 'ASC');

                // Clone before pagination
                $countQuery = clone $query;
                $data['total_rows'] = $countQuery->select_count('*', 'count')->get()['count'];

                $data['records'] = $query->pagination($records_per_page, $page)->get_all();

                return $data;
            }
        }

}
?>