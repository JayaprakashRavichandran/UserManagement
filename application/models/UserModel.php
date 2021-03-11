<?php

/**
 * Class UserModel
 */
class UserModel extends CI_Model
{
    const DB_TB_USER = 'USERS';

    /**
     * UserModel constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param $data
     * @return mixed
     */
    public function save($data)
    {
        $query = $this->db->insert(self::DB_TB_USER, $data);

        return $query->result_id();
    }

    /**
     * @return mixed
     */
    public function getAllUsers()
    {
        $selectData = array(
            'NAME',
            'EMAIL_ID',
            'MOBILE_NUMBER',
            'STATUS'
        );

        $query = $this->db
            ->select($selectData)
            ->order_by('CREATED_DTTM', 'DESC')
            ->get(self::DB_TB_USER);
        ;

        return $query->result();
    }
}