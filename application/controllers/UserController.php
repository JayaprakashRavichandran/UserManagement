<?php

/**
 * Class UserController
 */
class UserController extends CI_Controller
{
//    const PROJECT_ROOT_DIR = '/home/jayaprakash/Downloads';
//    const TARGET_DIR = 'uploads';
    const TARGET_DIR = '/home/jayaprakash/Downloads/uploads';

    /**
     * @var string
     */
    private $targetFileDir;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->helper('file');
        $this->load->helper('download');
        $this->load->helper('url');
        $this->setTargetDir();

        $this->load->library('upload');

        $this->load->model('UserModel');
        $this->load->model('AddressModel');
    }

    private function setTargetDir()
    {
        $this->targetFileDir = self::TARGET_DIR;
//        $this->targetFileDir = sprintf('%s/%s', self::PROJECT_ROOT_DIR, self::TARGET_DIR);
    }

    /**
     *  User UI form
     */
    public function index()
    {
        $data = array(
            'title' => 'Create User'
        );
        $this->load->view('User/User', $data);
    }

    /**
     * User Update/edit form
     * @param int $userId
     */
    public function getUserById($userId)
    {
        try {
            $dbData = $this->UserModel->getUserById($userId);
        } catch (Exception $e) {
            print_r($e->getMessage());
            exit;
        }

        $params = array(
            'title' => 'Update User',
            'updateFlag' => true,
            'userData' => $dbData[0],
        );

        $this->load->view('User/User', $params);
    }

    /**
     * List all the users in the UI
     */
    public function listUsers()
    {
        $queryParams = $this->input->get();
        if (isset($queryParams['q'])) {
            $queryArr = explode('=', $queryParams['q']);
            $sql = ' WHERE ';
            if ($queryArr[0] == 'userName') {
                $sql .= 'U.USERNAME LIKE \'' . $queryArr[1] . '%' . '\'';
            } elseif ($queryArr[0] = 'emailId') {
                $sql .= 'U.EMAIL_ID LIKE ' . $queryArr[1] . '%';
            } elseif ($queryArr[0] == 'mobileNumber') {
                $sql .= 'U.MOBILE_NUMBER LIKE ' . $queryArr[1] . '%';
            }
            $activeFilter = $queryArr[0];
            $activeValue = $queryArr[1];
            $users = $this->UserModel->usersFilter($sql);
        } else {
            $activeFilter = '';
            $activeValue = '';
            $users = $this->UserModel->getAllUsers();
        }

        $params = array (
            'title' => 'List User',
            'users' => $users,
            'filters' => array(
                'userName' => 'User Name',
                'emailId' => 'Email Id',
                'mobileNumber' => 'Mobile Number',
                'createdDate' => 'Created Date',
                'dob' => 'DOB'
            ),
            'ActiveFilters' => $activeFilter,
            'ActiveValue' => $activeValue,
        );

        $this->load->view('User/Listusers', $params);
    }

    /**
     * @param int $userId
     * @throws Exception
     */
    public function updateUser($userId)
    {
        $modifiedDttm = new DateTime();
        $dob = new DateTime($_POST['user_dob']);

        $updateUserData = array(
            'NAME' => $_POST['user_fullName'],
            'MOBILE_NUMBER' => $_POST['user_mobileNumber'],
            'DOB' => $dob->format('Y-m-d'),
            'MODIFIED_DTTM' => $modifiedDttm->format('Y-m-d H:i:s'),
        );

        $this->UserModel->update($updateUserData, (int) $userId);

        $updateAddressData = array(
            'ADDRESS' => $_POST['user_Address'],
            'CITY' => $_POST['user_city'],
            'STATE' => $_POST['user_state'],
            'COUNTRY' => $_POST['user_country'],
        );

        $this->AddressModel->update($updateAddressData, (int) $userId);

        $this->listUsers();
    }

    /**
     * The user will be deleted from the database
     * @param int $userId
     */
    public function deleteUser($userId)
    {
        $data = array(
            'USER_ID' => $userId
        );
        $this->AddressModel->delete($data);
        $this->UserModel->delete($data);

        $this->listUsers();
    }

    /**
     * The user will be created in the database
     * @throws Exception
     */
    public function createUser()
    {
        $createdTime = (new DateTime('now'));
        $dob = new DateTime($_POST['user_dob']);
        $param = array(
            'title' => 'Create User'
        );
        try {
            $insertUserData = array(
                'NAME' => $_POST['user_fullName'],
                'USERNAME' => $_POST['user_userName'],
                'EMAIL_ID' => $_POST['user_emailId'],
                'MOBILE_NUMBER' => $_POST['user_mobileNumber'],
                'DOB' => $dob->format('Y-m-d'),
                'USER_PROFILE_IMG' => $this->uploadImage(),
                'CREATED_DTTM' => $createdTime->format('Y-m-d H:i:s'),
            );

            $userId = $this->UserModel->save($insertUserData);

            $insertAddressData = array(
                'ADDRESS' => $_POST['user_Address'],
                'CITY' => $_POST['user_city'],
                'STATE' => $_POST['user_state'],
                'COUNTRY' => $_POST['user_country'],
                'USER_ID' => $userId
            );

            $this->AddressModel->save($insertAddressData);

            $param['success'] = 'User has been successfully created';
            $this->listUsers();
        } catch (Exception $e) {
           $param['error'] =  $e->getMessage();
           $this->load->view('User/User', $param);
        }
    }

    /**
     * @return string|null
     */
    private function uploadImage()
    {
        try {
            if (!is_dir($this->targetFileDir)) {
                mkdir($this->targetFileDir, 755, true);
            }

            $target_file = sprintf('%s/%s_%s.%s',
                $this->targetFileDir,
                $_POST['user_userName'],
                date('Y_m_d_H:i:s'),
                'png'
            );

            if ($this->validateImage($target_file)) {
                if (move_uploaded_file($_FILES["profilePicture"]["tmp_name"], $target_file)) {
                    return $target_file;
                    // $successMsg = sprintf("The file %s has been uploaded", basename( $_FILES["fileToUpload"]["name"]));
                }
            }
        } catch (Exception $e) {
            return null;
        }

        // $errorMsg = 'Sorry, your file was not uploaded';

        return null;
    }

    /**
     * @param $targetFile
     * @return bool
     */
    private function validateImage($targetFile)
    {
        $imageFileType = pathinfo($targetFile,PATHINFO_EXTENSION);

        if (getimagesize($_FILES["profilePicture"]["tmp_name"]) === false) {
            $errorMessage[] = 'File is not an image';
            print_r($errorMessage);
            return false;
        }

        if (file_exists($targetFile)) {
            $errorMessage[] = 'Sorry, file already exists';
            print_r($errorMessage);
            return false;
        }

        if ($_FILES["profilePicture"]["size"] > 500000) {
             $errorMessage[] = 'Sorry, your file is too large';
            print_r($errorMessage);
            return false;
        }

        if (! in_array($imageFileType, array("jpg", "png", "jpeg", "gif"))) {
             $errorMessage[] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed';
            print_r($errorMessage);
            return false;
        }

        return true;
    }

    public function downloadCsvFile()
    {
        $queryParams = $this->input->get();
        if (isset($queryParams['q'])) {
            $queryArr = explode('=', $queryParams['q']);
            $sql = ' WHERE ';
            if ($queryArr[0] == 'userName') {
                $sql .= 'U.USERNAME LIKE \'' . $queryArr[1] . '%' . '\'';
            } elseif ($queryArr[0] = 'emailId') {
                $sql .= 'U.EMAIL_ID LIKE ' . $queryArr[1] . '%';
            } elseif ($queryArr[0] == 'mobileNumber') {
                $sql .= 'U.MOBILE_NUMBER LIKE ' . $queryArr[1] . '%';
            }
            $users = $this->UserModel->usersFilter($sql);

            $this->writeCsv($users);
        }
    }

    /**
     * @param array $data
     */
    private function writeCsv($data)
    {
        $filename = 'UserDetails.csv';
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '";');
        $file = fopen('php://output',"w");

        $exportCsv = $this
            ->writeHeader($file)
            ->writeContent($data, $file);

        echo $exportCsv;
        exit;
    }

    /**
     * @param $file
     * @return $this
     */
    private function writeHeader($file)
    {
        $header = array (
            'USER_ID',
            'NAME',
            'USERNAME',
            'EMAIL_ID',
            'MOBILE_NUMBER',
            'DOB',
            'STATUS',
            'CREATED_DTTM',
            'MODIFIED_DTTM',
            'ADDRESS',
            'CITY',
            'STATE',
            'COUNTRY'
        );

        fputCsv($file, $header);

        return $this;
    }

    /**
     * @param array $data
     * @param $file
     */
    private function writeContent($data, $file)
    {
        foreach ($data as $eachUser) {
            $userdetail = array (
                $eachUser->USER_ID,
                $eachUser->NAME,
                $eachUser->USERNAME,
                $eachUser->EMAIL_ID,
                $eachUser->MOBILE_NUMBER,
                $eachUser->DOB,
                $eachUser->STATUS,
                $eachUser->CREATED_DTTM,
                $eachUser->MODIFIED_DTTM,
                $eachUser->ADDRESS,
                $eachUser->CITY,
                $eachUser->STATE,
                $eachUser->COUNTRY,
            );
            fputcsv($file, $userdetail);
        }
        fclose($file);
    }
}