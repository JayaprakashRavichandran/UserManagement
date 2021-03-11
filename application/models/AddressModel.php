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
     * @return mixed
     */
    public function save($data)
    {
        $dbQuery = $this->db->insert(self::DB_TB_ADDRESS, $data);

        return $dbQuery->insert_id();
    }
}