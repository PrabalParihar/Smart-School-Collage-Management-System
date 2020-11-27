<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Start extends CI_Controller {

    private $error = '';

    function __construct() {
        parent::__construct();
        $this->load->library('Enc_lib');
    }

    public function index() {
        $config_path = APPPATH . 'config/config.php';
        $debug = '';
        $step = 1;
        $passed_steps = array(
            1 => false,
            2 => false,
            3 => false,
        );
        if ($this->input->post()) {
            if ($this->input->post('step') && $this->input->post('step') == 2) {
                if ($this->input->post('hostname') == '') {
                    $this->error = 'Hostname is required';
                } else if ($this->input->post('database') == '') {
                    $this->error = 'Enter database name';
                } else if ($this->input->post('password') == '' && strpos(site_url(), 'localhost') === false && strpos(site_url(), '[::1]') === false) {
                    $this->error = 'Enter database password';
                } else if ($this->input->post('username') == '') {
                    $this->error = 'Enter database username';
                }
                $step = 2;
                $passed_steps[1] = true;
                if ($this->error === '') {
                    $passed_steps[2] = true;
                    $link = @mysqli_connect($this->input->post('hostname'), $this->input->post('username'), $this->input->post('password'), $this->input->post('database'));
                    if (!$link) {
                        $this->error .= "Error: Unable to connect to MySQL Database." . PHP_EOL;
                    } else {
                        $debug .= "Success: Connection to " . $this->input->post('database') . " database is done successfully.";
                        if ($this->write_db_config()) {
                            $step = 3;
                        }
                        mysqli_close($link);
                    }
                }
            } else if ($this->input->post('step') && $this->input->post('step') == 3) {
                if ($this->input->post('admin_email') == '') {
                    $this->error = 'Enter admin email address';
                } else if (filter_var($this->input->post('admin_email'), FILTER_VALIDATE_EMAIL) === false) {
                    $this->error = 'Enter valid email address';
                } else if ($this->input->post('admin_password') == '') {
                    $this->error = 'Enter admin password';
                } else if ($this->input->post('admin_password') != $this->input->post('admin_passwordr')) {
                    $this->error = 'Your confirm password not match';
                }
                $passed_steps[1] = true;
                $passed_steps[2] = true;
                $step = 3;
            } else if ($this->input->post('requirements_success')) {
                $step = 2;
                $passed_steps[1] = true;
            }
            if ($this->error === '' && $this->input->post('step') && $this->input->post('step') == 3) {
                $database = read_file(APPPATH . 'controllers/install/database.sql');
                $this->load->database();
                if (mysqli_multi_query($this->db->conn_id, $database)) {
                    $this->clean_up_db_query();
                    $data = array(
                        'employee_id' => '9000',
                        'name' => 'Super Admin',						
                        'dob' => '2020-01-01',
                        'gender' => 'Male',
                        'email' => $this->input->post('admin_email'),
                        'password' => $this->enc_lib->passHashEnc($this->input->post('admin_password')),
                        'is_active' => 1
                    );

                    $this->db->insert('staff', $data);
                    $insert_id = $this->db->insert_id();

                    $role_data = array(
                        'staff_id' => $insert_id,
                        'role_id' => 7
                    );

                    if ($this->db->insert('staff_roles', $role_data)) {

                        if (!is_really_writable($config_path)) {
                            show_error($config_path . ' should be writable. Database imported successfully. And admin user added successfully. You can set manually in application/config at bottom $config["installed"]  = "true"');
                        }
                        update_config_installed();
                        update_autoload_installed();
                        $passed_steps[1] = true;
                        $passed_steps[2] = true;
                        $passed_steps[3] = true;
                        $step = 4;
                    }
                }
            } else {
                $error = $this->error;
            }
        }
        include_once(APPPATH . 'controllers/install/html.php');
    }

    public function delete_install_dir() {
        if (is_dir(APPPATH . 'controllers/install')) {
            if (delete_dir(APPPATH . 'controllers/install')) {
                redirect(admin_url());
            }
        }
    }

    private function clean_up_db_query() {
        $CI = &get_instance();
        while (mysqli_more_results($CI->db->conn_id) && mysqli_next_result($CI->db->conn_id)) {
            $dummyResult = mysqli_use_result($CI->db->conn_id);
            if ($dummyResult instanceof mysqli_result) {
                mysqli_free_result($CI->db->conn_id);
            }
        }
    }

    private function write_db_config() {
        $hostname = $this->input->post('hostname');
        $database = $this->input->post('database');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $new_database_file = '<?php defined(\'BASEPATH\') OR exit(\'No direct script access allowed\');

/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the \'Database Connection\'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	[\'dsn\']      The full DSN string describe a connection to the database.
|	[\'hostname\'] The hostname of your database server.
|	[\'username\'] The username used to connect to the database
|	[\'password\'] The password used to connect to the database
|	[\'database\'] The name of the database you want to connect to
|	[\'dbdriver\'] The database driver. e.g.: mysqli.
|			Currently supported:
|				 cubrid, ibase, mssql, mysql, mysqli, oci8,
|				 odbc, pdo, postgre, sqlite, sqlite3, sqlsrv
|	[\'dbprefix\'] You can add an optional prefix, which will be added
				|				 to the table name when using the  Query Builder class
|	[\'pconnect\'] TRUE/FALSE - Whether to use a persistent connection
|	[\'db_debug\'] TRUE/FALSE - Whether database errors should be displayed.
|	[\'cache_on\'] TRUE/FALSE - Enables/disables query caching
|	[\'cachedir\'] The path to the folder where cache files should be stored
|	[\'char_set\'] The character set used in communicating with the database
|	[\'dbcollat\'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	[\'swap_pre\'] A default table prefix that should be swapped with the dbprefix
|	[\'encrypt\']  Whether or not to use an encrypted connection.
|
|			\'mysql\' (deprecated), \'sqlsrv\' and \'pdo/sqlsrv\' drivers accept TRUE/FALSE
|			\'mysqli\' and \'pdo/mysql\' drivers accept an array with the following options:
|
|				\'ssl_key\'    - Path to the private key file
|				\'ssl_cert\'   - Path to the public key certificate file
|				\'ssl_ca\'     - Path to the certificate authority file
|				\'ssl_capath\' - Path to a directory containing trusted CA certificats in PEM format
|				\'ssl_cipher\' - List of *allowed* ciphers to be used for the encryption, separated by colons (\':\')
|				\'ssl_verify\' - TRUE/FALSE; Whether verify the server certificate or not (\'mysqli\' only)
|
|	[\'compress\'] Whether or not to use client compression (MySQL only)
|	[\'stricton\'] TRUE/FALSE - forces \'Strict Mode\' connections
|							- good for ensuring strict SQL while developing
|	[\'ssl_options\']	Used to set various SSL options that can be used when making SSL connections.
|	[\'failover\'] array - A array with 0 or more data for connections if the main should fail.
|	[\'save_queries\'] TRUE/FALSE - Whether to "save" all executed queries.
| 				NOTE: Disabling this will also effectively disable both
| 				$this->db->last_query() and profiling of DB queries.
| 				When you run a query, with this setting set to TRUE (default),
| 				CodeIgniter will store the SQL statement for debugging purposes.
| 				However, this may cause high memory usage, especially if you run
| 				a lot of SQL queries ... disable this to avoid that problem.
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the \'default\' group).
				|
| The $query_builder variables lets you determine whether or not to load
| the query builder class.
						*/
$active_group = \'default\';
$query_builder = TRUE;

$db[\'default\'] = array(
	\'dsn\'	=> \'\',
	\'hostname\' => \'' . $hostname . '\',
	\'username\' => \'' . $username . '\',
	\'password\' => \'' . $password . '\',
	\'database\' => \'' . $database . '\',
	\'dbdriver\' => \'mysqli\',
	\'dbprefix\' => \'\',
	\'pconnect\' => FALSE,
	\'db_debug\' => (ENVIRONMENT !== \'production\'),
	\'cache_on\' => FALSE,
	\'cachedir\' => \'\',
	\'char_set\' => \'utf8\',
	\'dbcollat\' => \'utf8_general_ci\',
	\'swap_pre\' => \'\',
	\'encrypt\' => FALSE,
	\'compress\' => FALSE,
	\'stricton\' => FALSE,
	\'failover\' => array(),
	\'save_queries\' => TRUE
);
';

        $fp = fopen(APPPATH . 'config/database.php', 'w+');
        if ($fp) {
            if (fwrite($fp, $new_database_file)) {
                return true;
            }
            fclose($fp);
        }
        return false;
    }

}
