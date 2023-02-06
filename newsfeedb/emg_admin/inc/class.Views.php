<?php

/**
 * class db
 * This is the class.SM.php
 * The one that the config file requires
 * It will possess most operations that
 * will enable the database interact with the
 *interfaces
 * @Author: Albert Bamwine
 *
 * @Company: Evolution Media Group
 *
 */



class Views extends SM
{

public function collect ()
{
$stmt = $this->runQuery( "SELECT * FROM table_name" ); 
$stmt->execute();
while($rows = $stmt->fetch()):
echo $rows['fname']; 
endwhile;
}


public function check_dir()
{

$directory='emg_admin/views';
if(!is_dir($directory)){
mkdir($directory,0755,true);
}

}


public function load($file_name)
{

$this->check_dir();

$directory='emg_admin/views/'.$file_name.'.php';
include($directory);
}


	public function user_render_view($data)
	{
		
		$header_file = isset($data['header_view']) ? $data['header_view'] : 'header';
		$footer_file = isset($data['footer_view']) ? $data['footer_view'] : 'footer';
		$nav_file = isset($data['nav_file']) ? $data['nav_file'] : 'sidenav';

		$this->load($header_file, $data);
		$this->load($nav_file, $data);
		$this->load($data['view_page'],$data);
		$this->load($footer_file,$data);
	}
	
	public function user_render_admin($data)
	{
		
		$header_file = isset($data['header_view']) ? $data['header_view'] : 'admin_header';
		$footer_file = isset($data['footer_view']) ? $data['footer_view'] : 'admin_footer';
		$nav_file = isset($data['nav_file']) ? $data['nav_file'] : 'admin_sidenav';

		$this->load($header_file, $data);
		$this->load($nav_file, $data);
		$this->load($data['view_page'],$data);
		$this->load($footer_file,$data);
	}

	
	
	
	public function user_render_vet($data)
	{
		
		$header_file = isset($data['header_view']) ? $data['header_view'] : 'vet_header';
		$footer_file = isset($data['footer_view']) ? $data['footer_view'] : 'footer';
		$nav_file = isset($data['nav_file']) ? $data['nav_file'] : 'vet_sidenav';

		$this->load($header_file, $data);
		$this->load($nav_file, $data);
		$this->load($data['view_page'],$data);
		$this->load($footer_file,$data);
	}
	
	
    public function login2($uname,$upass)
    {

        try
        {
            $enc = md5($upass);

            $stmt = $this->runQuery("SELECT * FROM users WHERE username =:uname AND password = :password ");

            $stmt->execute(array(':uname'=>$uname, ':password' => $enc));

            $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

            if($stmt->rowCount() > 0)
            {

                /*if(password_verify($upass, $userRow['admin_password']))

                {*/

                $_SESSION['user_session'] = $userRow['id'];
				$_SESSION['userdata'] = $userRow;

                return true;

                /*}
                else
                {
                    return false;
                }*/
            }else{
                return false;
            }
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

	

}