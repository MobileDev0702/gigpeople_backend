<?php

class Admin_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }
    
    function insert($table_name = '', $data = array())
    {
        $this->db->insert($table_name, $data);
        return $this->db->insert_id();
    }
    
    function get_count($table_name = '', $where = array())
    {
        $rs = $this->db->get_where($table_name, $where);
        return $rs->num_rows();
    }
    
    function get_where($table_name = '', $where = array(), $data = '*')
    {
        $this->db->select($data);
        $rs = $this->db->get_where($table_name, $where);
        return $rs->result();
    }
    
    function get_where_row($table_name = '', $where = array(), $data = '*')
    {
        $this->db->select($data);
        $this->db->order_by('id', 'DESC');
        $rs = $this->db->get_where($table_name, $where);
        return $rs->row();
    }
    
    function update($table_name, $data, $where)
    {
        return $this->db->update($table_name, $data, $where);
    }
    
    function delete($table_name = '', $where = array())
    {
        return $this->db->delete($table_name, $where);
    }
    
    function getAdminDetails($condition = array())
    {
        $this->db->where($condition);
        return $this->db->get('admin');
    }
    
    function updateAdmin($id, $data)
    {
        $this->db->where('admin_id', $id);
        return $this->db->update('admin', $data);
    }
    
    function totalUsers($condition = array())
    {
        $this->db->select('* as count');
        $this->db->from('app_user');
        $this->db->where($condition);
        return $this->db->count_all_results();
    }
    
    function getUserList($condition = array())
    {
        $this->db->select('*');
        $this->db->where($condition);
        $this->db->order_by('app_user.id', 'desc');
        return $this->db->get('app_user');
    }
    
    function userDetailsUpdate($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('app_user', $data);
    }
    
    function getTotalAmount($condition = array())
    {
        $this->db->select("sum(company_amount) as company_amount,sum(total_amount) as total_amount,sum(user_amount) as user_amount");
        $this->db->where($condition);
        return $this->db->get('orders');
    }
    
    function getRequestList($condition = array())
    {
        $this->db->select('*,request.id as request_id,app_user.id as users_id,request.created_at as posted_at');
        $this->db->join('app_user', 'request.user_id=app_user.id', 'left');
        $this->db->where($condition);
        $this->db->order_by('request.id', 'desc');
        return $this->db->get('request');
    }
    
    function getOfferList($condition = array())
    {
        $this->db->select('*,offer_sent.id as offer_id,request.id as requestid,app_user.id as users_id,offer_sent.price as offer_price,offer_sent.description as offer_description,offer_sent.created_at as posted_at,offer_sent.user_id as offer_user_id');
        $this->db->join('app_user', 'offer_sent.user_id=app_user.id', 'left');
        $this->db->join('request', 'offer_sent.request_id=request.id', 'left');
        $this->db->where($condition);
        $this->db->order_by('offer_sent.id', 'desc');
        return $this->db->get('offer_sent');
    }
    
    function gigDetailsUpdate($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('gig_list', $data);
    }
    
    function getReview($condition = array())
    {
        $this->db->select('*');
        $this->db->from('reviews');
        $this->db->where($condition);
        $this->db->order_by('id', 'desc');
        return $this->db->get();
    }
    
    function getgiglist($condition = array())
    {
        $this->db->select('*');
        $this->db->from('gig_list');
        $this->db->where($condition);
        $this->db->order_by('id', 'desc');
        return $this->db->get();
    }
    
    function RequestList($condition = array())
    {
        $this->db->where($condition);
        $this->db->order_by('id', 'desc');
        return $this->db->get('request');
    }
    
    function getorder($condition = array())
    {
        $this->db->where($condition);
        $this->db->order_by('id', 'desc');
        return $this->db->get('orders');
    }
    
    function gerBanner($condition = array())
    {
        $this->db->where($condition);
        $this->db->order_by('id', 'desc');
        return $this->db->get('promotion_banners');
    }
    
    function addBanner($id, $data)
    {
        if ($id == "")
        {
            return $this->db->insert('promotion_banners', $data);
        }
        else
        {
            $this->db->where('id', $id);
            return $this->db->update('promotion_banners', $data);
        }
    }
    
    function getSubCategory($condition = array())
    {
        $this->db->where($condition);
        $this->db->order_by('id', 'desc');
        return $this->db->get('category');
    }
    
    function addSubCategory($id, $data)
    {
        if ($id == "")
        {
            return $this->db->insert('category', $data);
        }
        else
        {
            $this->db->where('id', $id);
            return $this->db->update('category', $data);
        }
    }
    
    function getContactList($condition = array())
    {
        $this->db->select('*,contact.id as list_id,app_user.id as customer_id');
        $this->db->join('app_user', 'contact.user_id=app_user.id', 'left');
        $this->db->where($condition);
        $this->db->order_by('contact.id', 'desc');
        return $this->db->get('contact');
    }

    function addQuestion($id, $data)
    {
        if ($id == "")
        {
            return $this->db->insert('help', $data);
        }
        else
        {
            $this->db->where('id', $id);
            return $this->db->update('help', $data);
        }
    }

    function getHelpList($condition = array())
    {
        $this->db->select('*,help.id as help_id,category.id as help_category_id');
        $this->db->join('category', 'help.parent_id=category.id', 'left');
        $this->db->where($condition);
        $this->db->order_by('help.id', 'desc');
        return $this->db->get('help');
    }
}
?>
