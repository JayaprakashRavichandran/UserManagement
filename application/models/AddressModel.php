<?php

/**
 * Class AddressModel
 */
class AddressModel extends CI_Model
{
    const DB_TB_ADDRESS = 'ADDRESS';

    /**
     * AddressModel constructor.
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
        $this->db->delete(self::DB_TB_ADDRESS, $data);
    }

    /**
     * @param array $data
     * @param int $userId
     */
    public function update($data, $userId)
    {
        $this->db->update(self::DB_TB_ADDRESS, $data, array('USER_ID' => $userId));
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function save($data)
    {
       $this->db->insert(self::DB_TB_ADDRESS, $data);

        return $this->db->insert_id();
    }
}