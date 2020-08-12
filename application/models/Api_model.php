<?php
class Api_model extends CI_Model
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
    
    function getFaqCategory($condition = array())
    {
        $this->db->join('help', 'help.parent_id=category.id');
        $this->db->group_by('category.id');
        $this->db->order_by('category.id', 'desc');
        return $this->db->get('category');
    }
    
    function faq($condition = array())
    {
        $this->db->where($condition);
        $this->db->order_by('id', 'desc');
        return $this->db->get('help');
    }
    
    function bannerList($condition = array())
    {
        $this->db->where($condition);
        return $this->db->get('promotion_banners');
    }
    
    function categoryList($condition = array(), $serach_key)
    {
        $this->db->where($condition);
        if ($serach_key != "")
        {
            $this->db->where("category_name like '%$serach_key%'");
        }
        $this->db->order_by('id', 'desc');
        return $this->db->get('category');
    }
    
    function getUserDetails($condition)
    {
        $this->db->where($condition);
        return $this->db->get('app_user');
    }
    
    function addUser($id, $data)
    {
        if ($id == "")
        {
            if ($this->db->insert('app_user', $data))
            {
                $insert_id = $this->db->insert_id();
            }
            else
            {
                $insert_id = "0";
            }
        }
        else
        {
            $this->db->where('id', $id);
            $this->db->update('app_user', $data);
            $insert_id = $id;
        }
        return $insert_id;
    }
    
    function addChat($condition = array(), $data)
    {
        if (empty($condition))
        {
            $this->db->insert('chat', $data);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
        else
        {
            $this->db->where($condition);
            return $this->db->update('chat', $data);
        }
    }
    
    function checkChat($condition = array())
    {
        $this->db->where($condition);
        $this->db->order_by('id', 'desc');
        return $this->db->get('chat');
    }
    
    function getChatList($condition)
    {
        $sql = "select * from chat where id IN (select MAX(id) from chat where " . $condition . " group by from_user_id,to_user_id) order by id desc";
        return $this->db->query($sql);
    }
    
    function chatStatus($condition = array(), $data)
    {
        $this->db->where($condition);
        return $this->db->update('chat', $data);
    }
    
    function addNotification($data)
    {
        return $this->db->insert('notifications', $data);
    }
    
    function getNotification($condition)
    {
        $this->db->where($condition);
        $this->db->order_by('id', 'desc');
        return $this->db->get('notifications');
    }
    
    function AddRequest($condition = array(), $data)
    {
        if (empty($condition))
        {
            $this->db->insert('request', $data);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
        else
        {
            $this->db->where($condition);
            return $this->db->update('request', $data);
        }
    }
    
    function getRequest($condition = array(), $search_key = '', $filter = array())
    {
        $user_id = $condition['user_id'];
        if ($filter['lat'] && $filter['lon'])
        {
            $SQL = 'SELECT s.*,u.address as user_location,SQRT(POW(31.0686 * (u.lattitude - ' . $filter['lat'] . '), 2) + POW(31.0686 * (' . $filter['lon'] . ' - u.longitude) * COS(u.lattitude / 57.3), 2)) AS distance FROM request s LEFT JOIN app_user u ON u.id = s.user_id WHERE u.account_status = 0 AND s.request_status= 0 AND s.user_id != ' . $user_id . ' AND  u.id != ' . $user_id . ' ';
        }
        else
        {
            $SQL = 'SELECT s.*,u.address as user_location FROM request s LEFT JOIN app_user u ON u.id = s.user_id WHERE u.account_status = 0 AND s.request_status= 0 AND s.user_id != ' . $user_id . ' AND  u.id != ' . $user_id . ' ';
        }
        if ($search_key != "")
        {
            $SQL .= ' AND (u.first_name LIKE "%' . $search_key . '%" OR u.last_name LIKE "%' . $search_key . '%")';
        }
        if ($filter['category'])
        {
            $Category = explode(',', $filter['category']);
            $SQL .= ' AND s.category IN (' . $filter['category'] . ')';
        }
        if ($filter['subcategory'])
        {
            $SubCategory = explode(',', $filter['subcategory']);
            $SQL .= ' AND s.subcategory IN ("' . $filter['subcategory'] . '")';
        }
        if ($filter['lat'] && $filter['lon'])
        {
            $SQL .= '  GROUP BY s.id HAVING distance < 25 ';
        }
        else
        {
            $SQL .= '  GROUP BY s.id ';
        }
        $query = $this->db->query($SQL);
        return $query;
    }
    
    function RequestList($condition = array())
    {
        $this->db->where($condition);
        $this->db->order_by('id', 'desc');
        return $this->db->get('request');
    }
    
    function Offersend($condition = array(), $data)
    {
        if (empty($condition))
        {
            $this->db->insert('offer_sent', $data);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
        else
        {
            $this->db->where($condition);
            return $this->db->update('offer_sent', $data);
        }
    }
    
    function OfferList($condition = array(), $search_key = '', $filter = array())
    {
        $this->db->where($condition);
        $this->db->order_by('id', 'desc');
        return $this->db->get('offer_sent');
    }
    
    function AddGig($condition = array(), $data)
    {
        if (empty($condition))
        {
            $this->db->insert('gig_list', $data);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
        else
        {
            $this->db->where($condition);
            return $this->db->update('gig_list', $data);
        }
    }
    
    function searchGig($condition = array(), $gig_search = '')
    {
        $this->db->where($condition);
        if ($gig_search != "")
        {
            $this->db->where("title like '%$gig_search%'");
        }
        $this->db->order_by('id', 'desc');
        return $this->db->get('gig_list');
    }
    
    function giglistSearch($condition = array(), $search_key = '', $filter = array())
    {
        $this->db->join('gig_list', 'gig_list.user_id=app_user.id');
        $this->db->where($condition);
        if ($search_key != "")
        {
            $this->db->or_where("app_user.first_name like '%$search_key%'");
            $this->db->or_where("app_user.last_name like '%$search_key%'");
            $this->db->or_where("gig_list.title like '%$gig_search%'");
        }
        /*if($filter['category'])
        {
            $this->db->where('gig_list.category_id', $filter['category']);
        }
        
        if($filter['subcategory'])
        {
            $this->db->where('gig_list.sub_category_id', $filter['subcategory']);
        }*/
        if ($filter['delivery'] == '1')
        {
            $this->db->where('gig_list.delivery_time', '1');
        }
        elseif ($filter['delivery'] == '2')
        {
            $this->db->where('gig_list.delivery_time', '3');
        }
        elseif ($filter['delivery'] == '3')
        {
            $this->db->where('gig_list.delivery_time', '7');
        }
        if ($filter['status'] == '1')
        {
            $this->db->where('app_user.live_status', '1');
        }
        if ($filter['status'] == '0')
        {
            $this->db->where('app_user.live_status', '0');
        }
        if ($filter['language'])
        {
            $Language = explode(',', $filter['language']);
            $this->db->where_in('app_user.language', $Language);
        }
        if ($filter['tags'])
        {
            $Tags = explode(',', $filter['tags']);
            $this->db->where_in('gig_list.gig_tag', $Tags);
        }
        $this->db->order_by('app_user.id', 'desc');
        //$this->db->group_by('gig_list.user_id');
        return $this->db->get('app_user');
    }

    function gigsellerlist($condition = array())
    {
        $this->db->join('gig_list', 'gig_list.user_id=app_user.id');
        $this->db->where($condition);
        
        $this->db->order_by('app_user.id', 'desc');
        return $this->db->get('app_user');
    }
    
    function GigList($condition = array())
    {
        $this->db->where($condition);
        $this->db->order_by('id', 'desc');
        return $this->db->get('gig_list');
    }
    
    function GigSearchList($condition = array())
    {
        $this->db->where($condition);
        $this->db->order_by('id', 'desc');
        $this->db->group_by('user_id');
        return $this->db->get('gig_list');
    }
    
    function GigSearchListv($condition = array(), $user_search = '')
    {
        $this->db->join('gig_list', 'gig_list.user_id=app_user.id');
        $this->db->where($condition);

        $usersearch = explode(" ", $user_search);
        if (count($usersearch) >= 1)
        {
            $first_name = $usersearch[0] ? $usersearch[0] : '';
            $this->db->where("app_user.first_name like '%$first_name%'");
            $this->db->or_where("app_user.last_name like '%$first_name%'");
        }
        else
        {
            $first_name = $usersearch[0] ? $usersearch[0] : '';
            $last_name = $usersearch[1] ? $usersearch[1] : '';
            $this->db->where("app_user.first_name like '%$first_name%'");
            $this->db->where("app_user.last_name like '%$last_name%'");
        }
        /*if($user_search!="")
        {
            
        }*/
        $this->db->where("gig_list.status", '2');
        $this->db->order_by('app_user.id', 'desc');
        $this->db->group_by('gig_list.user_id');
        return $this->db->get('app_user');
    }
    
    function addFavouriteList($data)
    {
        return $this->db->insert('favouritelist', $data);
    }
    
    function removeFavouriteList($condition = array())
    {
        $this->db->where($condition);
        return $this->db->delete('favouritelist');
    }
    
    function getGigList($condition = array())
    {
        $this->db->join('gig_list', 'gig_list.user_id=favouritelist.favourite_id');
        //$this->db->where('gig_list.status','2');
        $this->db->where($condition);
        $this->db->order_by('favouritelist.id', 'desc');
        $this->db->group_by('gig_list.user_id');
        return $this->db->get('favouritelist');
    }
    
    function getGigList1($condition = array())
    {
        $this->db->join('gig_list', 'gig_list.id=favouritelist.favourite_id');
        //$this->db->where('gig_list.status','2');
        $this->db->where($condition);
        $this->db->order_by('favouritelist.id', 'desc');
        return $this->db->get('favouritelist');
    }
    
    function GigFavList($condition = array())
    {
        $this->db->where($condition);
        $this->db->order_by('id', 'desc');
        $this->db->group_by('user_id');
        return $this->db->get('gig_list');
    }
    
    function AddCard($condition = array(), $data)
    {
        if (empty($condition))
        {
            $this->db->insert('cart', $data);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
        else
        {
            $this->db->where($condition);
            return $this->db->update('cart', $data);
        }
    }
    
    function CardList($condition = array())
    {
        $this->db->where($condition);
        $this->db->order_by('id', 'desc');
        return $this->db->get('cart');
    }
    
    function RatingAdd($condition = array(), $data)
    {
        if (empty($condition))
        {
            $this->db->insert('reviews', $data);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
        else
        {
            $this->db->where($condition);
            return $this->db->update('reviews', $data);
        }
    }
    
    function RatingList($condition = array())
    {
        $this->db->where($condition);
        $this->db->order_by('id', 'desc');
        return $this->db->get('reviews');
    }
    
    function RatingLimit($condition = array())
    {
        $this->db->where($condition);
        $this->db->order_by('id', 'desc');
        $this->db->limit(2);
        return $this->db->get('reviews');
    }
    
    function rating($condition = array(), $sum)
    {
        $this->db->select($sum);
        $this->db->where($condition);
        return $this->db->get('reviews');
    }
    
    function DeliveryNow($condition = array(), $data)
    {
        if (empty($condition))
        {
            $this->db->insert('orders', $data);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
        else
        {
            $this->db->where($condition);
            return $this->db->update('orders', $data);
        }
    }
    
    function Orders($condition = array(), $data)
    {
        if (empty($condition))
        {
            $this->db->insert('orders', $data);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
        else
        {
            $this->db->where($condition);
            return $this->db->update('orders', $data);
        }
    }
    
    function OrderList($condition = array())
    {
        $this->db->where($condition);
        $this->db->order_by('id', 'desc');
        $query= $this->db->get('orders');
        $ret = $query->row();
        return $this->db->get('orders');
    }
    
    function AddHistory($condition = array(), $data)
    {
        if (empty($condition))
        {
            $this->db->insert('order_history', $data);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
        else
        {
            $this->db->where($condition);
            return $this->db->update('order_history', $data);
        }
    }
    
    function HistoryList($condition = array())
    {
        $this->db->where($condition);
        $this->db->order_by('id', 'desc');
        return $this->db->get('order_history');
    }
    
    function WalletList($condition = array())
    {
        $this->db->where($condition);
        $this->db->order_by('id', 'desc');
        return $this->db->get('orders');
    }
    
    function getRevenue($id = '', $condition = array())
    {
        $SQL = "SELECT SUM(final_cost) AS amount FROM orders WHERE seller_id = " . $id . "  AND order_status = 4  AND created_at >= '" . $condition['start'] . "' AND created_at <= '" . $condition['end'] . "'";
        $query = $this->db->query($SQL);
        return $query->row();
    }
    
    function getTotalRevenue($id = '', $condition = array())
    {
        $SQL = "SELECT SUM(final_cost) AS amount FROM orders WHERE seller_id = " . $id . " AND order_status = 4 ";
        $query = $this->db->query($SQL);
        return $query->row();
    }
    
    function getCompleted($id = '')
    {
        $SQL = "SELECT COUNT(id) AS id FROM orders WHERE seller_id = " . $id . "  AND order_status = 4";
        $query = $this->db->query($SQL);
        return $query->row();
    }
    
    function getAnalytics($id = '', $condition = array())
    {
        $SQL = "SELECT COUNT(id) AS id FROM orders WHERE seller_id = " . $id . " AND order_status = " . $condition['order_status'] . " ";
        $query = $this->db->query($SQL);
        return $query->row();
    }
    
    function getNagativeReviews($id = '', $condition = array())
    {
        $SQL = "SELECT SUM(seller_rating) AS rating FROM reviews WHERE seller_id = " . $id . " AND seller_rating < 3 ";
        $query = $this->db->query($SQL);
        return $query->row();
    }

    function getPositiveReviews($id = '', $condition = array())
    {
        $SQL = "SELECT SUM(seller_rating) AS rating FROM reviews WHERE seller_id = " . $id . " AND seller_rating >= 3 ";
        $query = $this->db->query($SQL);
        return $query->row();
    }
}

?>
