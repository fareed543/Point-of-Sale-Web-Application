<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     *
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Auth_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper('url');
		$this->load->model('Constant_model');
    }

    public function index() {
        if ($this->session->userdata('user_email')) {
            redirect('dashboard', 'refresh');
        } else {
            $this->load->view('login', 'refresh');
        }
    }

    public function checkPin() {
        $pin = $this->input->post('pin');
        if (strlen($pin) == 4) {
            $data = array(
                'pin' => $this->input->post('pin'),
            );
            $result = $this->Auth_model->verifyLogInwithPin($data);
            if ($result['valid']) {
                $response = '1';
            } else {
                $response = '0';
            }
        } else {
            $response = '0';
        }
        echo $response;
    }

	
	public function createstore() {
		
	
		if (isset($_POST['register'])) {
			$outlet_data = array(
			'name' => $_POST['outlet'],
			'address' => $_POST['address'],
			'contact_number' => $_POST['contact_number'],
			);
			$outletId = $this->Constant_model->insertData('outlets', $outlet_data);
			if($outletId){
				$user_data = array(
				'fullname' => $_POST['owner'],
				'email' => $_POST['email'],
				'password' =>  md5($_POST['password']),
				'role_id' => 1,
				'outlet_id' => $outletId,
				'pin' => $_POST['pin'],
				'status' => '1',
				);
				
				$user = $this->Constant_model->insertData('pos_user', $user_data);
				if($user){
					$this->session->set_flashdata('alert_msg', array('failure', 'Login', 'Please check mail to activate your account!'));
                	$this->load->view('register');
				}
			}
		}
    }
	
	public function register() {
		$this->load->view('register');
    }
	
	
    public function login() {
        //$pin = $this->input->post('pin');
        if (!isset($_POST['sp_login'])) {
            $pin = $this->input->post('pin');
            if (strlen($pin) > 0) {
                $data = array(
                    'pin' => $this->input->post('pin'),
                );
                $result = $this->Auth_model->verifyLogInwithPin($data);
                if ($result['valid']) {
                    $userdata = array(
                        'sessionid' => 'pos',
                        'user_id' => $result['user_id'],
                        'fullname' => $result['fullname'],
                        'user_email' => $result['user_email'],
                        'user_role' => $result['role_id'],
                        'user_outlet' => $result['outlet_id'],
                    );
                    /* generate database backup */
                    /*$this->exportDatabase(
                            $this->db->hostname, $this->db->username, $this->db->password, $this->db->database, $tables = false, $backup_name = false
                    );*/
                    $this->session->set_userdata($userdata);
                    redirect(base_url() . 'dashboard', 'refresh');
                }
            }
        }

        if (isset($_POST['sp_login'])) {
            $data = array(
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
            );

            $em = $this->input->post('email');
            $ps = $this->input->post('password');

            if (empty($em)) {
                $this->session->set_flashdata('alert_msg', array('failure', 'Login', 'Please enter your username!'));
                redirect(base_url());
            } elseif (empty($ps)) {
                $this->session->set_flashdata('alert_msg', array('failure', 'Login', 'Please enter your password!'));
                redirect(base_url());
            } else {
                $result = $this->Auth_model->verifyLogIn($data);

                if ($result['valid']) {
                    $userdata = array(
                        'sessionid' => 'pos',
                        'user_id' => $result['user_id'],
                        'fullname' => $result['fullname'],
                        'user_email' => $result['user_email'],
                        'user_role' => $result['role_id'],
                        'user_outlet' => $result['outlet_id'],
                    );
                    /* generate database backup */
                    /*$this->exportDatabase(
                            $this->db->hostname, $this->db->username, $this->db->password, $this->db->database, $tables = false, $backup_name = false
                    );*/
                    $this->session->set_userdata($userdata);

                    redirect(base_url() . 'dashboard', 'refresh');
                } else {
                    $this->session->set_flashdata('alert_msg', array('failure', 'Login', $result['error']));
                    redirect(base_url());
                }
            }
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url());
    }

    // Function to get the client IP address
    public function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP')) {
            $ipaddress = getenv('HTTP_CLIENT_IP');
        } elseif (getenv('HTTP_X_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        } elseif (getenv('HTTP_X_FORWARDED')) {
            $ipaddress = getenv('HTTP_X_FORWARDED');
        } elseif (getenv('HTTP_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        } elseif (getenv('HTTP_FORWARDED')) {
            $ipaddress = getenv('HTTP_FORWARDED');
        } elseif (getenv('REMOTE_ADDR')) {
            $ipaddress = getenv('REMOTE_ADDR');
        } else {
            $ipaddress = 'UNKNOWN';
        }

        return $ipaddress;
    }

    public function exportDatabase($host, $user, $pass, $name, $tables = false, $backup_name = false) {
        $files = glob('database/*'); // get all file names
        foreach ($files as $file) { // iterate files
            if (is_file($file))
                unlink($file); // delete file
        }
        if (!ini_get('date.timezone')) {
            date_default_timezone_set('GMT');
        }
        $mysqli = new mysqli($host, $user, $pass, $name);
        $mysqli->select_db($name);
        $mysqli->query("SET NAMES 'utf8'");
        $queryTables = $mysqli->query('SHOW TABLES');
        while ($row = $queryTables->fetch_row()) {
            $target_tables[] = $row[0];
        }
        if ($tables !== false) {
            $target_tables = array_intersect($target_tables, $tables);
        }
        $content = "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\r\nSET time_zone = \"+00:00\";\r\n\r\n\r\n/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;\r\n/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;\r\n/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;\r\n/*!40101 SET NAMES utf8 */;\r\n--Database: `" . $name . "`\r\n\r\n\r\n";
        foreach ($target_tables as $table) {
            $result = $mysqli->query('SELECT * FROM ' . $table);
            $fields_amount = $result->field_count;
            $rows_num = $mysqli->affected_rows;
            $res = $mysqli->query('SHOW CREATE TABLE ' . $table);
            $TableMLine = $res->fetch_row();
            $content .= "\n\n" . $TableMLine[1] . ";\n\n";
            for ($i = 0, $st_counter = 0; $i < $fields_amount; $i++, $st_counter = 0) {
                while ($row = $result->fetch_row()) { //when started (and every after 100 command cycle):
                    if ($st_counter % 100 == 0 || $st_counter == 0) {
                        $content .= "\nINSERT INTO " . $table . " VALUES";
                    }
                    $content .= "\n(";
                    for ($j = 0; $j < $fields_amount; $j++) {
                        $row[$j] = str_replace("\n", "\\n", addslashes($row[$j]));
                        if (isset($row[$j])) {
                            $content .= '"' . $row[$j] . '"';
                        } else {
                            $content .= '""';
                        } if ($j < ($fields_amount - 1)) {
                            $content.= ',';
                        }
                    }
                    $content .=")";
                    //every after 100 command cycle [or at last line] ....p.s. but should be inserted 1 cycle eariler
                    if ((($st_counter + 1) % 100 == 0 && $st_counter != 0) || $st_counter + 1 == $rows_num) {
                        $content .= ";";
                    } else {
                        $content .= ",";
                    } $st_counter = $st_counter + 1;
                }
            } $content .="\n\n\n";
        }
        $content .= "\r\n\r\n/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;\r\n/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;\r\n/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;";
        $backup_name = $backup_name ? $backup_name : $name . "-" . date('Y-m-d-H-i-s') . ".sql";
        $tempFile = fopen("database/" . $backup_name, "w");
        fwrite($tempFile, $content);
        /* header('Content-Type: application/octet-stream');
          header("Content-Transfer-Encoding: Binary");
          header("Content-disposition: attachment; filename=\"" . $backup_name . "\"");
          echo $content;
          exit; */


        //$this->uploadDatabaseToDrive();
    }

    public function uploadDatabaseToDrive() {
        //include 'database/upload/index.php';
        /*
          session_start();
          $url_array = explode('?', 'http://' . $_SERVER ['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
          $url = $url_array[0];

          require_once './application/third_party/google-api-php-client/src/Google_Client.php';
          require_once './application/third_party/google-api-php-client/src/contrib/Google_DriveService.php';

          $client = new Google_Client();
          $client->setClientId('317473951683-cmfmirnf44c6f7j2if0tvp8li1b31nng.apps.googleusercontent.com');
          $client->setClientSecret('c878rs6sR2wCcaSeDGzPferd');
          $client->setRedirectUri($url);
          $client->setScopes(array('https://www.googleapis.com/auth/drive'));
          if (isset($_GET['code'])) {
          $_SESSION['accessToken'] = $client->authenticate($_GET['code']);
          header('location:' . $url);
          exit;
          } elseif (!isset($_SESSION['accessToken'])) {
          $client->authenticate();
          }
          $files = array();
          $dir = dir('files');
          while ($file = $dir->read()) {
          if ($file != '.' && $file != '..') {
          $files[] = $file;
          }
          }
          $dir->close();
          if (!empty($_POST)) {
          $client->setAccessToken($_SESSION['accessToken']);
          $service = new Google_DriveService($client);
          $finfo = finfo_open(FILEINFO_MIME_TYPE);
          $file = new Google_DriveFile();
          foreach ($files as $file_name) {
          $file_path = 'database/' . $file_name;
          $mime_type = finfo_file($finfo, $file_path);
          $file->setTitle($file_name);
          $file->setDescription('This is a ' . $mime_type . ' document');
          $file->setMimeType($mime_type);
          $service->files->insert(
          $file, array(
          'data' => file_get_contents($file_path),
          'mimeType' => $mime_type
          )
          );
          }
          finfo_close($finfo);
          header('location:' . $url);
          exit;
          }
          echo '<!DOCTYPE html>
          <html lang="es">
          <head>
          <meta charset="UTF-8">
          <title>Google Drive Example App</title>
          </head>
          <body>
          <ul>
          <?php foreach ($files as $file) { ?>
          <li><?php echo $file; ?></li>
          <?php } ?>
          </ul>
          <form method="post" action="<?php echo $url; ?>">
          <input type="submit" value="Upload" name="submit">
          </form>
          </body>
          </html>';
          exit; */
    }

}
