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
     * @param array $data
     */
    public function delete($data)
    {
        $this->db->delete(self::DB_TB_USER, $data);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function save($data)
    {
        $this->db->insert(self::DB_TB_USER, $data);

        return $this->db->insert_id();
    }

    /**
     * @param array $data
     * @param int $userId
     */
    public function update($data, $userId)
    {
       $this->db->update(self::DB_TB_USER, $data, array('USER_ID' => $userId));

    }

    /**
     * @return mixed
     */
    public function getAllUsers()
    {
        $selectData = array(
            'USER_ID',
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

    /**
     * @param $userId
     * @return mixed
     */
    public function getUserById($userId)
    {
        $sql = $this->db
            ->select()
            ->from(self::DB_TB_USER . ' U')
            ->join(AddressModel::DB_TB_ADDRESS . ' ADB', 'U.USER_ID = ADB.USER_ID')
            ->where('U.USER_ID', $userId)
            ->get()
        ;

       return $sql->result_array();
    }

    /**
     * @param string $sql
     * @return mixed
     */
    public function usersFilter($sql)
    {
        $query = 'SELECT * FROM ' . self::DB_TB_USER . ' U join ' . AddressModel::DB_TB_ADDRESS . ' ADB ON U.USER_ID = ADB.USER_ID';
        $sqlQuery = $this->db->query($query . $sql);

        return $sqlQuery->result();
    }
}