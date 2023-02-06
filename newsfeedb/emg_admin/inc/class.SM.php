<?php

/**
 * class db
 * This is the class.SM.php
 * The one that the config file requires
 * It will possess most operations that
 * will enable the database interact with the
 *interfaces
 * @Author: Roy N Kusemererwa
 *
 * @Company: Evolution Media Group
 *
 */



class SM extends PDO
{

    //A private connection variable to initiate the database connection

    private $con;

    //the Constructor method initiates all the connections to the database

    public function __construct($con)
    {
        $this -> db = $con;
    }

    /**
     * @param $query
     *
     */

    public function runQuery($query)
    {

        $stmt = $this->db->prepare ( $query );

        return $stmt;

    }


    /**
     * @param $data
     * @param $element
     * @return mixed
     * Function to validate entered data before it is delivered to the database
     */

    public function validate($data, $element)
    {
        if (empty($data)) {
        ?>
        <div class="alert alert-info sharp-corners">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Empty Field!</strong>
        <p><?php echo "$element is empty<br/>"; ?></p>
</div>
        <?php

        } else {

            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);

            return $data;
        }

    }



/**
* @param $item
 * Function to get website details
 * Items like hostname
 */
    public function get_site($item)
    {
        try
        {

            $stmt = self::runQuery( "SELECT $item FROM emg_meta WHERE $item = $item" );

            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            while($rows = $stmt->fetch()):

                echo $rows[$item];

            endwhile;

        } catch (PDOException $err)
        {
            echo $err->getMessage();
        }

    }


/**
 * Generic Function to find if a word deserves to be substringed
$stmt is the statement to be checked
$total is the expected number of characters to display
*/

public function check_sub($stmt, $total)
{
$length = strlen($stmt);

if($length > $total)
{
echo substr($stmt, 0, $total);
echo"...";
}else{
echo $stmt;
}

}



        /**
        * @param $dater
         * Compute the mysql timestamp into a friendly date
         */

        public function friendly_date($dater)
        {
        $date = date_create($dater);
                    echo date_format ($date, "dS F Y");

        }
/**
* @param $former_value
* @param $current_value
 * Generic Function to compute a discount given the two shifted prices
 *
 */

public function calculate_discount ($former_value, $current_value)
{
$discount = ($former_value - $current_value) / $former_value;
echo round($discount * 100, 0);
echo"%";
}

    /**
     * @param $p_name
     * @param $admin_email
     * @param $admin_uname
     * @param $admin_password
     * Function to enter admin credentials
     */
    public function enter_admin ($site_path, $p_name, $admin_email, $admin_uname, $admin_password)
    {

        try {

            $admin_color = "black";
            $admin_profile_pic = "img/placeholder2.png";
            $dater = date("Y-m-d H:i:s");
            $admin_level = "Main_Admin";
            $admin_fname = "Main_Admin";

            $stmt = self::runQuery("INSERT INTO emg_meta(hostname, p_name, admin_email, admin_uname, admin_password, admin_fname, admin_level, admin_profile_pic, dater, admin_color) VALUES(:site_path, :p_name, :admin_email, :admin_uname, :admin_password, :admin_fname, :admin_level, :admin_profile_pic, :dater, :admin_color)");

            $stmt->bindValue(":site_path", $site_path);
            $stmt->bindValue(":p_name", $p_name);
            $stmt->bindValue(":admin_email", $admin_email);
            $stmt->bindValue(":admin_uname", $admin_uname);
            $stmt->bindValue(":admin_password", $admin_password);
            $stmt->bindValue(":admin_fname", $admin_fname);
            $stmt->bindValue(":admin_level", $admin_level);
            $stmt->bindValue(":admin_profile_pic", $admin_profile_pic);
            $stmt->bindValue(":dater", $dater);
            $stmt->bindValue(":admin_color", $admin_color);
            $stmt->execute();
            ?>
            <div class='alert alert-success' style="border-radius: inherit; border-left:3px solid green;"><strong>Great! </strong>
                Admin Account Created Successfully
                <br>
                <a href="index.php"><button class="btn btn-success">Lets Go!!</button></a>
            </div>
            <?php
        } catch (PDOException $err)
        {
            ?>
            <div class='alert alert-danger' style="border-radius: inherit; border-left:3px solid red;"><strong>Error!</strong>
                <?php
                echo $err->getMessage();
                ?>
            </div>
            <?php

        }


    }






/**
* @param $subloc
 * function to addd a sublocation
 *
 */
        public function add_subloc ($subloc)
        {
        //checking if the location exitsts already
        $c = self::runQuery( "SELECT * FROM emg_sub_locations WHERE subloc = :subloc" );
        $c->execute([":subloc"=>$subloc]);
        $c->fetch(PDO::FETCH_ASSOC);
        if($c->rowCount() > 0)
        {
        ?>
        <div class="alert alert-danger sharp-corners">
        <strong>Already Exists!</strong>
        <p>The sublocation you entered already exists</p>
</div>
        <?php
        }else{
        $stmt = self::runQuery( "INSERT INTO emg_sub_locations (subloc)VALUES(:subloc)" );
        $stmt->bindValue(":subloc", $subloc);
        $stmt->execute();
        ?>
        <div class="alert alert-success sharp-corners">
        <strong>Success!</strong>
        <p>Sub Location Entered Successfully</p>
</div>
        <?php
        }
}



        public function new_user ($fname, $lname, $email, $pwd)
        {
        $password = md5($pwd);
        $dater = date("Y-m-d H:i:s");
        try {
        $stmt = self::runQuery( "INSERT INTO emg_users(fname, lname, email, password, dater) VALUES(:fname, :lname, :email, :password, :dater)" );
        $stmt->bindValue(":fname", $fname);
        $stmt->bindValue(":lname",$lname);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":password", $password);
        $stmt->bindValue(":dater", $dater);
        $stmt->execute();



     //logging in
            $stmt = self::runQuery("SELECT * FROM emg_users WHERE email = :email AND password = :pwd");

            $stmt->execute(array(':email'=>$email, ':pwd' => $password));

            $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

            $_SESSION['user_session'] = $userRow['id'];

            //redirecting

echo"<script>window.location='loggedin.php'</script>";

        ?>
        <div class="alert alert-success sharp-corners">
        <strong>Success!</strong>
        <p>You were successfully Registered!</p>
        </div>
        <?php

        }catch(PDOException $err){
        echo $err->getMessage();
        }
        }


/**
* @param $email
* @param $upass
 * @return bool
 *
 * Function to login local users
 */


    /**
     * @param $uname
     * @param $umail
     * @param $upass
     * @return bool
     * Logging in to the system
     *
     */

    public function login($uname,$umail,$upass)
    {

        try
        {
            $enc = md5($upass);

            $stmt = self::runQuery("SELECT * FROM emg_meta WHERE admin_uname =:uname OR admin_email=:umail AND admin_password = :password LIMIT 1");

            $stmt->execute(array(':uname'=>$uname, ':umail'=>$umail, ':password' => $enc));

            $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

            if($stmt->rowCount() > 0)
            {

                /*if(password_verify($upass, $userRow['admin_password']))

                {*/

                $_SESSION['user_session'] = $userRow['id'];

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



    /*
     * Function to check if user is logged in
     * If he is logged in  it creates a session for the user
     *
     * */

    public function is_logged ()
    {

        if(isset($_SESSION['user_session']))
        {
            return true;

        }

    }


    /*
     * Generic Function
     * To redirect when requested
     * Takes
     * @param $url
     * */

    public function redirect ($url)
    {
        header("location: $url");
    }

    /*
     * Function to logout a user
     * :Generic
     * */

    public function logout ()
    {
        session_destroy();
        unset($_SESSION['user_session']);
        self::redirect('index.php');
        return true;
    }

    public function get_url($page_name)
    {
        //getting the url of this particular page
        $stmt = self::runQuery( "SELECT post_url FROM emg_posts WHERE page_id = :page_name" );

        $stmt->execute([':page_name' => $page_name]);

        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        while($rows = $stmt->fetch()):

            echo $rows['post_url'];

        endwhile;
    }

    public function php_slug($string)
    {
        $slug = preg_replace('/[^a-z0-9-]+/', '-', strtolower($string));;

        return $slug;
    }




public function send_message($fname, $phone, $email, $message){
$status = 0;
$dater = date("Y-m-d H:i:s");
$stmt = self::runQuery("INSERT INTO emg_messages (fullname, phone, email, message, dater, status)VALUES(:fname, :phone, :email, :message, :dater, :status)");
$stmt->bindValue(":fname", $fname);
$stmt->bindValue(":phone", $phone);
$stmt->bindValue(":email", $email);
$stmt->bindValue(":message", $message);
$stmt->bindValue(":dater", $dater);
$stmt->bindValue(":status", $status);
 $stmt->execute();
 ?>
 <div class="alert alert-success sharp-corners">
 <strong>Message Sent!</strong>
 <p>Thank you for contacting us, Your message was successfully sent, we shall reply to you in your email</p>
</div>
 <?php

}
    /**
     * Receive and Insert
     * @param $post_title
     * @param $post_content
     * @param $post_image
     * @param $dater
     * @param $status
     * @param $author
     * @return mixed
     * Method to insert content into storage
     */

    public function enter ($post_title, $post_content, $post_image, $post_category, $page, $status, $author, $tags, $new_tag, $fieldname, $fieldvalue)
    {

//checking if the title of this post already exists
$c = self::runQuery("SELECT post_title FROM emg_posts WHERE post_title = :post_title");
$c->execute([":post_title"=>$post_title]);
if($c->rowCount() > 0){
?>
<div class="alert alert-info sharp-corners">
<strong>Sorry Entry Failed!</strong>
<p>Another post with this title already exists, please try to change the title and then post.
Also update your Category, tags and Image. Thanks!
</p>
</div>

<?php

}else{
        //receiving the image file
        $filename = basename($post_image["name"]);
        $imageFileType = pathinfo($filename, PATHINFO_EXTENSION);
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" && $imageFileType != "JPG"

        ) {
            ?>
            <div class='alert alert-danger' style="border-radius: inherit; border-left:3px solid red;"><strong>Error!</strong>
                Sorry, only JPG, JPEG, PNG & GIF files are allowed.
            </div>
            <?php
        } else {
            $rand = rand(0, 999999999);
            $ext = substr($filename, strrpos($filename, '.'));
            $ppx = preg_replace("/\\.[^.\\s]{3,4}$/", "", $filename);
            $f_filename = $ppx . '-' . $rand . '' . $ext;
            $target_dir = "uploads/";
            $target_file = $target_dir . $f_filename;
            move_uploaded_file($post_image["tmp_name"], $target_file);
            $path = "uploads/" . $f_filename . "";
            $dater = date("Y-m-d H:i:s");

            $post_url = self::php_slug($post_title);
            $post_ID = rand(0, 9999999999);

            try {
                $stmt = self::runQuery("INSERT INTO emg_posts(post_ID, post_title, post_content, post_image, post_category, page_id, post_url, dater, status, author)
                                                             VALUES(:post_ID, :post_title, :post_content, :post_image, :post_category, :page_id,  :post_url, :dater, :status, :author)");

                $stmt->bindValue(":post_title", $post_title);
                $stmt->bindValue(":post_ID", $post_ID);
                $stmt->bindValue(":post_content", $post_content);
                $stmt->bindValue(":post_image", $path);
                $stmt->bindValue(":post_category", $post_category);
                $stmt->bindValue(":page_id", $page);
                $stmt->bindValue(":post_url", $post_url);
                $stmt->bindValue(":dater", $dater);
                $stmt->bindValue(":status", $status);
                $stmt->bindValue(":author", $author);
                $stmt->execute();

                if(!empty($tags)){
                //entering tags for this particular post
                foreach ($tags AS $tg):
                $s = self::runQuery( "INSERT INTO emg_post_tag_relate(tag, post_ID) VALUES(:tag, :post_id)" );
                $s->bindValue(":tag", $tg);
                $s->bindValue(":post_id", $post_ID);
                $s->execute();
                endforeach;
                }

                if(!empty($new_tag)){
                //introducing  new tag
                $n = self::runQuery( "INSERT INTO emg_tags(tags) VALUES(:tag)" );
                $n->bindValue(":tag", $new_tag);
                $n->execute();

                //another transaction to enter the new_tag into the relate table also if all of them are available
                $t = self::runQuery( "INSERT INTO emg_post_tag_relate(tag, post_ID) VALUES(:tag, :post_id)" );
                $t->bindValue("tag", $new_tag);
                $t->bindValue(":post_id", $post_ID);
                $t->execute();
                }


                //entering the additioanl data
                for($i=0, $count = count($fieldname);$i<$count;$i++) {
                    $fName  = $fieldname[$i];
                    $fvalue = $fieldvalue[$i];

                   /* echo $fName;
                    echo "-";
                    echo $fvalue;
                   */
                    $ff = self::runQuery( "INSERT INTO emg_field_details (postID, fieldID, Detail) VALUES(:postid, :fieldid, :detail)" );
                    $ff ->bindValue(":postid", $post_ID);
                    $ff->bindValue(":fieldid", $fName);
                    $ff->bindValue(":detail", $fvalue);
                    $ff->execute();
                }

 ?>

                <div class='alert alert-success' style="border-radius: inherit; border-left:3px solid green;">
                    <strong>Success!</strong>
                    Post successfully created.
     <br/>
     <!--<a href="additional-info.php?id=<?php //echo $post_ID; ?>">Add More Information</a>-->

                </div>
                <?php
                return $stmt;

            } catch (PDOException $err) {
                ?>
                <div class='alert alert-danger' style="border-radius: inherit; border-left:3px solid red;"><strong>Admin Error! </strong>
                    <?php
                    echo $err->getMessage();

                    ?>
                </div>

                <?php

            }

        }
    }
}

    /**
* @param $id
* @param $size
* @param $price
* @param $negotiate
 * function to add more information
 * aaditional-info.php
 */
    public function add_info($id, $size, $price, $negotiate, $location)
    {
    $stmt = self::runQuery( "INSERT INTO emg_additional_info(postid, p_size, price, negotiate, location) VALUES
    (:postid, :p_size, :price, :negotiate, :location)" );
    $stmt->bindValue(":postid", $id);
    $stmt->bindValue(":p_size", $size);
    $stmt->bindValue(":price", $price);
    $stmt->bindValue(":negotiate", $negotiate);
    $stmt->bindValue(":location", $location);
    $stmt->execute();
    ?>
    <div class="alert alert-success sharp-corners">
    <strong>Success!!</strong>
    <p>Additional Informational was successfully added</p>
</div>
    <?php
    }


/**
* @param $item
* @param $postid
 * function to get added info from the added fields
 */
        public function get_added_info($fieldName, $postid)
        {
            $stmt = $this->runQuery( "SELECT * FROM emg_field_details WHERE fieldID = :fieldname AND postID = :postid ORDER BY id DESC LIMIT 1" );
            $stmt->execute([":fieldname"=>$fieldName, ":postid"=>$postid]);
            while($rows = $stmt->fetch()):
            echo $rows['Detail'];
            endwhile;
        }



/**
* @param $postid
* @param $item
 * Generic function to get additional info
 */
        public function get_additional_info ($postid, $item) {
        $stmt = self::runQuery( "SELECT postid, $item FROM emg_additional_info WHERE postid = :postid" );
        $stmt->execute([":postid"=>$postid]);
        while($rows = $stmt->fetch()):
        echo $rows[$item];
        endwhile;
        }
/**
* @param $item
 * Function to get utilities
 */
        public function get_util($item)
        {
        $stmt = $this->runQuery( "SELECT $item FROM emg_contact ORDER BY id DESC LIMIT 1" );
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        while($rows = $stmt->fetch()):
        echo $rows[$item];
        endwhile;

        }



      public function enter_applicants ($fname, $lname, $phone, $email, $entry_level, $starting_term)
      {

      try {

      $stmt = self::runQuery( "INSERT INTO emg_applicant (fname, lname, phone, email, entry_level, starting_term)VALUE(:fname, :lname, :phone, :email, :entry_level, :starting_term)" );
      $stmt->bindValue(":fname", $fname);
      $stmt->bindValue(":lname", $lname);
      $stmt->bindValue(":phone", $phone);
      $stmt->bindValue(":email", $email);
      $stmt->bindValue(":entry_level", $entry_level);
      $stmt->bindValue(":starting_level", $starting_term);
      $stmt->execute();

      ?>
      <div class="alert alert-success">
      <strong>Success!</strong>
      <p>Applicant Entered Successfully</p>
</div>
      <?php

      } catch (PDOException $err)
      {
      ?>
      <div class="alert alert-danger">
      <strong>Error!</strong>
      <p>Sorry There was an error submitting your application</p>
      <?php //echo $err->getMessage(); ?>
</div>
      <?php
      }
      }
            /**
    * @param $facebook
    * @param $twitter
    * @param $google
    * @param $phone
    * @param $addr
     * Function to enter utilities
     *
     */

    public function enter_utilities($facebook, $twitter, $google, $phone, $email, $addr)
    {
    try {

    //entering the utilities

    $in = $this->runQuery( "INSERT INTO emg_contact (fbk, twiter, google, phone, email, address) VALUES(:facebook, :twitter, :google, :phone, :email, :addr)" );

    $in->bindValue(":facebook", $facebook);
    $in->bindValue(":twitter", $twitter);
    $in->bindValue(":google", $google);
    $in->bindValue(":phone", $phone);
    $in->bindValue(":email", $email);
    $in->bindValue(":addr", $addr);
    $in->execute();
    ?>
    <div class="alert alert-success sharp-corners success-msg">
    <strong>Success!</strong>
    <p>The Utilities Were Entered Successfully</p>
</div>
    <?php
    } catch (PDOException $err)
    {
    ?>
    <div class="alert alert-danger sharp-corners error-msg">
    <strong>Error!</strong>
    <p>There was an error entering the data</p>
    <p><?php echo $err->getMessage(); ?></p>
    <small>Contact Admin to diagonise problem</small>
</div>
    <?php

    }
    }


 public function user_login ($email, $upass, $page)
        {
        try
        {
            $enc = md5($upass);

            $stmt = self::runQuery("SELECT * FROM emg_users WHERE email = :email AND password = :password");

            $stmt->execute(array(':email'=>$email, ':password' => $enc));

            $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

            if($stmt->rowCount() > 0)
            {

                /*if(password_verify($upass, $userRow['admin_password']))

                {*/

                //$_SESSION['user_session'] = $userRow['id'];
                $_SESSION['user_session'] = $userRow['id'];

echo"<script>window.location='$page'</script>";

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


/**
* @param $fieldname
 * function to add more fields to accomodate more data that the one inbuilt in the system
 */
public function enter_fields($fieldname)
{
$q = self::runQuery( "INSERT INTO emg_more_fields (fieldname) VALUES(:fieldname)" );

  $m = new MultipleIterator();
 $m->attachIterator(new ArrayIterator($fieldname), 'fieldname');
        foreach($m AS $row)
        {
        //entering the array values
            $q->bindValue(":fieldname", $row[0]);
            $q->execute();
            }
            ?>
            <div class="alert alert-success sharp-corners">
            <strong>Success</strong>
            <p>Fields added Successfully</p>
</div>
            <?php

}

        /**
* @param $review
* @param $post_id
* @param $useridf
 * function to enter post review into the database
 *
 */

        public function post_review($review, $post_id, $userid)
        {
        try {
        $dater = date('Y-m-d H:i:s');

        $stmt = self::runQuery( "INSERT INTO emg_reviews(postid, userid, review, dater) VALUES(:postid, :userid, 
        :review, :dater)" );
        $stmt->bindValue(":postid", $post_id);
        $stmt->bindValue(":userid", $userid);
        $stmt->bindValue(":review", $review);
        $stmt->bindValue(":dater", $dater);
        $stmt->execute();
        ?>
<!--<div class="alert alert-sucess sharp-corners">
<strong>Success!</strong>
<p>Your Review as successfully recevied!</p>
</div>-->
        <?php
        } catch (PDOException $err)
        {
        ?>
        <!--<div class="alert alert-danger sharp-corners">
        <strong>Error!!</strong>
        <p>Review was not poster successfully<br/>

        <?php
        echo $err->getMessage();
        ?>
        </p>
        </div>-->
        <?php

        }
        }

/**
* @param $item
* @param $id
 *
 * Function to get any item about a user by using his/herr iid
 */
        public function get_user_by_id ($item, $id)
        {
        $stmt = self::runQuery( "SELECT * FROM emg_users WHERE id = :id" );
        $stmt->execute([":id"=>$id]);
        while($rows = $stmt->fetch()):
        echo $rows[$item];
        endwhile;
        }

/**
* @param $email
* @param $upass
 * @return bool
 * function to login a business
 */
 public function business_login ($email, $upass)
        {
        try
        {
            $enc = md5($upass);

            $stmt = self::runQuery("SELECT * FROM emg_business WHERE b_email = :email AND b_pwd = :password");

            $stmt->execute(array(':email'=>$email, ':password' => $upass));

            $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

            if($stmt->rowCount() > 0)
            {

                /*if(password_verify($upass, $userRow['admin_password']))

                {*/

                //$_SESSION['user_session'] = $userRow['id'];
                $_SESSION['user_session'] = $userRow['id'];

echo"<script>window.location='company-profile.php'</script>";

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



 //$db->business_signup($b_name, $b_phone, $b_email, $b_zipcode, $pwd, $about, $admin_fname, $admin_lname, $physical_lo, $b_category);

 public function business_signup ($b_name, $b_phone, $b_email, $b_zipcode, $b_pwd, $b_about, $admin_fname,
 $admin_lname, $physical_lo, $b_category)
 {

$select = self::runQuery( "SELECT b_phone, b_name FROM emg_business WHERE b_phone = :b_phone AND b_name = :b_name" );
$select->execute([":b_phone"=>$b_phone, ":b_name"=>$b_name]);
$select->fetch(PDO::FETCH_ASSOC);
if($select->rowCount() > 0){
?>
<div class="alert alert-info sharp-corners">
<strong>Company Exists!</strong>
<p>The business name you are signing up with already exists!</p>
</div>
<?php
}else{



$dater = date("Y-m-d H:i:s");
        $stmt = self::runQuery( "INSERT INTO emg_business (b_name, b_phone, b_email, b_zipcode, b_about, b_pwd, admin_fname, admin_lname, 
b_physical_locations, b_category, dater)VALUES(:b_name, :b_phone, :b_email, :b_zipcode, :b_about, :b_pwd, 
:admin_fname, :admin_lname, :b_physical_lo, :b_category, :dater)" );
        $stmt->bindValue(":b_name", $b_name);
        $stmt->bindValue(":b_phone", $b_phone);
        $stmt->bindValue(":b_email", $b_email);
        $stmt->bindValue(":b_zipcode", $b_zipcode);
        $stmt->bindValue(":b_about", $b_about);
        $stmt->bindValue(":b_pwd", $b_pwd);
        $stmt->bindValue(":admin_fname", $admin_fname);
        $stmt->bindValue(":admin_lname", $admin_lname);
        $stmt->bindValue(":b_physical_lo", $physical_lo);
        $stmt->bindValue(":b_category", $b_category);
        $stmt->bindValue(":dater", $dater);
        $stmt->execute();


?>
<div class="alert alert-success sharp-corners">
<strong>You were successfully signed up!</strong>
<p>You can now go on and login</p>
</div>

<?php
//selecting the details of this company from the db
$s = self::runQuery( "SELECT * FROM emg_business WHERE b_email = :email" );
$s->execute([":email"=>$b_email]);
while($r = $s->fetch()):

                $_SESSION['user_session'] = $r['id'];;
        echo "<script>window.location='company-profile.php?company=$b_name'</script>";

       endwhile;

 }

}

        /**
        * @param $companyid
        * @param $info
         * function to get specific info about a company
         */
         public function get_companyinfo ($companyid, $info)
         {

         $stmt = self::runQuery( "SELECT id, $info FROM emg_business WHERE id = :id" );

         $stmt->execute([":id"=>$companyid]);

         while($rows = $stmt->fetch()):

         echo $rows[$info];
         endwhile;
         }

    // enter_page($post_title, $post_content, $status, $author);
    public function enter_page ($page_title, $page_content, $status, $author)
    {


        try {
            $dater = date("Y-m-d H:i:s");
            $stmt = $this->runQuery( "INSERT INTO emg_pages(post_title, post_content, author, status, dater) VALUES(:page_name, :page_details, :author, :status, :dater)" );

            $stmt->bindValue(':page_name', $page_title);
            $stmt->bindValue(':page_details', $page_content);
            $stmt->bindValue(':author', $author);
            $stmt->bindValue(':status', $status);
            $stmt->bindValue(':dater', $dater);
            $stmt->execute();
            ?>
            <div class='alert alert-success' style="border-radius: inherit; border-left:3px solid green;"><strong>Success!</strong>
                Page successfully created.
            </div>
            <?php


        }
        catch (PDOException $err)
        {

            ?>
            <div class='alert alert-danger' style="border-radius: inherit; border-left:3px solid red;"><strong>Admin Error! </strong>
                <?php
                echo $err->getMessage();

                ?>
                <br>   <small>Inform admin about this error!</small>
            </div>

            <?php
        }
    }

    /*
     * Function to
     * enter new category
     * @param new_cat
     * */
    public function enter_cat ($new_cat)
    {
        $stmt = self::runQuery("INSERT INTO emg_post_cats(category) VALUES(:new_cat)");

        $stmt->bindParam(":new_cat", $new_cat);

        $stmt->execute();
    }



    /*
     * Function to get title of the project
     * */

    public function get_title()
    {

        $stmt = self::runQuery("SELECT p_name FROM emg_meta");

        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        while($r = $stmt->fetch()):
            echo htmlspecialchars($r['p_name']);
        endwhile;


    }

    /**
* @param $post_url
 * function to get the post title when given the post url
 */

        public function get_title_given_url ($post_url)
        {
        $stmt = self::runQuery( "SELECT * FROM emg_posts WHERE post_url = :url" );
        $stmt->execute([":url"=>$post_url]);
        while($rows = $stmt->fetch()):
        echo $rows['post_title'];
        endwhile;
        
        }
    /*
     * Function to get post @items from the
     * database by using their @category
     * */


    public function get_post($post_item, $category, $substr, $initial)
    {

        $stmt = self::runQuery("SELECT $post_item, id FROM emg_posts WHERE post_category = :category AND status = 'publish' ORDER BY id DESC LIMIT $initial, 1");

        $stmt->execute([ ':category' => $category ]);

        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        while($r = $stmt->fetch()):

            echo strip_tags(substr($r[$post_item], 0, $substr));

        endwhile;

    }


                /**
        * @param $postid
         * function to get the latest image of a articular post, given the postid
         */
        public function get_post_img($postid)
        {
        $stmt = self::runQuery( "SELECT * FROM post_images WHERE post_id = :post_id ORDER BY id DESC LIMIT 1" );
        $stmt->execute([":post_id"=>$postid]);
        while($ro = $stmt->fetch()):
        echo $ro['image_name'];
        endwhile;
        }


        /**
* @param $id
* @param $post_item
 *
 */
    public function just_get_post ($id, $post_item)
    {
    $stmt = self::runQuery( "SELECT $post_item FROM emg_posts WHERE id = :id" );
    $stmt->execute([":id"=>$id]);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    while($rows = $stmt->fetch()):
    echo $rows[$post_item];
    endwhile;

    }

    public function get_part_post ($post_item, $category, $start, $end)
    {
    $stmt = self::runQuery( "SELECT $post_item FROM emg_posts WHERE post_category = :category AND status = 'publish'" );
    $stmt->execute([":category"=>$category]);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    while($rows = $stmt->fetch()):

    echo substr($rows[$post_item], $start, $end);

    endwhile;

    }


    public function dataview($query)
    {
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        if($stmt->rowCount()>0)
        {
            while($row=$stmt->fetch(PDO::FETCH_ASSOC))
            {
                ?>
                <tr>
                    <td>&nbsp&nbsp<a href="edit-post.php?id=<?php echo $row['id']; ?>" class="post_title"><?php echo $row['post_title']; ?></a><p style="font-size:10px;">&nbsp&nbsp&nbsp<a href="edit-post.php?id=<?php echo$row['id'];?>">Edit</a> | <a href="post_delete.php?id=<?php echo$row['id']; ?>">Delete</a></p></td>
                    <td><?php echo $row['author']; ?></td>
					<td><?php echo $row['post_category']; ?></td>
					<td><?php  $this->get_site_vist ($row['id']); ?></td>
                    <td> Published <br><?php echo $row['dater']; ?></td>
                </tr>
                <?php
            }
        }
        else
        {
            ?>
            <tr>
                <td>No Post yet, make some posts</td>
            </tr>

            <?php
        }

    }

	
	


    public function dataviewpages($query)
    {
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        if($stmt->rowCount()>0)
        {
            while($row=$stmt->fetch(PDO::FETCH_ASSOC))
            {
                ?>
                <tr>
                    <td>&nbsp&nbsp<a href="edit-page.php?id=<?php echo $row['id']; ?>" class="post_title"><?php echo $row['post_title']; ?></a><p style="font-size:10px;">&nbsp&nbsp&nbsp<a href="post_edit.php?id=<?php echo$row['id'];?>">Edit</a> | <a href="comments.php?id=<?php echo$row['id']; ?>">Delete</a></p></td>
                    <td><?php echo $row['author']; ?></td>
                    <td> Published <br><?php echo $row['dater']; ?></td>
                </tr>
                <?php
            }
        }
        else
        {
            ?>
            <tr>
                <td>No Post yet, make some posts</td>
            </tr>

            <?php
        }

    }



    /*
     *
     * Function ()
     * For Paging*/

    public function paging($query,$records_per_page)
    {
        $starting_position=0;
        if(isset($_GET["page_no"]))
        {
            $starting_position=($_GET["page_no"]-1)*$records_per_page;
        }
        $query2=$query." limit $starting_position,$records_per_page";
        return $query2;
    }


    public function paginglink($query,$records_per_page)
    {

        $self = $_SERVER['PHP_SELF'];

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        $total_no_of_records = $stmt->rowCount();

        if($total_no_of_records > 0)
        {
            ?><tr><td colspan="3"><?php
                $total_no_of_pages=ceil($total_no_of_records/$records_per_page);
                $current_page=1;
                if(isset($_GET["page_no"]))
                {
                    $current_page=$_GET["page_no"];
                }
                if($current_page!=1)
                {
                    $previous =$current_page-1;
                    echo"<nav>
                        <ul class=\"pager\">";
                    echo "<li><a href='".$self."?page_no=1'>First</a></li>&nbsp;&nbsp;";
                    echo "<li><a href='".$self."?page_no=".$previous."'>Previous</a></li>&nbsp;&nbsp;";
                    echo"</ul>";
                    echo"</nav>";
                }
                for($i=1;$i<=$total_no_of_pages;$i++)
                {
                    if($i==$current_page)
                    {
                        //   echo "<strong><a href='".$self."?page_no=".$i."' style='color:red;text-decoration:none'>".$i."</a></strong>&nbsp;&nbsp;";
                    }
                    else
                    {
                        //  echo "<a href='".$self."?page_no=".$i."'>".$i."</a>&nbsp;&nbsp;";
                    }
                }
                if($current_page!=$total_no_of_pages)
                {
                    $next=$current_page+1;
                    ?>
                    <nav>
                        <ul class="pager">
                            <?php
                            echo "<li><a href='".$self."?page_no=".$next."'>Next</a></li>&nbsp;&nbsp;";
                            echo "<li><a href='".$self."?page_no=".$total_no_of_pages."'>Last</a></li>&nbsp;&nbsp;";
                            ?>
                        </ul>
                    </nav>
                    <?php

                }
                ?></td></tr><?php
        }
    }


    /*
     * This function will allow
     * one to update a post
     * @post_id
     * @post_title
     * @post_content
     * @post_image
     * etc..
     * */
//
    public function update_post ($post_id, $post_title, $post_content, $post_image, $post_category, $status, $author)
    {
        try {

            //receiving the image file
            $filename = basename($post_image["name"]);
            //$imageFileType = pathinfo($filename, PATHINFO_EXTENSION);
            $rand = rand(0, 999999999);
            $ext = substr($filename, strrpos($filename, '.'));
            $ppx = preg_replace("/\\.[^.\\s]{3,4}$/", "", $filename);
            $f_filename = $ppx . '-' . $rand . '' . $ext;
            $target_dir = "uploads/";
            $target_file = $target_dir . $f_filename;
            move_uploaded_file($post_image["tmp_name"], $target_file);
            $path = "uploads/" . $f_filename . "";

//checking if the image is available

            if(empty($filename)){
                $stmt = self::runQuery("UPDATE emg_posts SET post_title = :post_title, post_content = :post_content, post_category = :post_category, status = :status, author = :author WHERE id = :post_id");
                $stmt->bindValue(":post_title", $post_title);
                $stmt->bindValue(":post_content", $post_content);
                $stmt->bindValue(":post_category", $post_category);
                $stmt->bindValue(":status", $status);
                $stmt->bindValue(":author", $author);
                $stmt->bindValue(":post_id", $post_id);
                $stmt->execute();
                ?>
                <div class='alert alert-success' style="border-radius: inherit; border-left:3px solid green;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong>
                    Post successfully Updated.
                </div>
                <?php
            }else {
                //if the image is not available
                $stmt = self::runQuery("UPDATE emg_posts SET post_title = :post_title, post_content = :post_content, post_image = :post_image, post_category = :post_category, status = :status, author = :author WHERE id = :post_id");

                $stmt->bindValue(":post_title", $post_title);
                $stmt->bindValue(":post_content", $post_content);
                $stmt->bindValue(":post_image", $path);
                $stmt->bindValue(":post_category", $post_category);
                $stmt->bindValue(":status", $status);
                $stmt->bindValue(":author", $author);
                $stmt->bindValue(":post_id", $post_id);
                $stmt->execute();
                ?>
                <div class='alert alert-success' style="border-radius: inherit; border-left:3px solid green;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong>
                    Post successfully Updated.
                </div>
                <?php



            }        } catch (PDOException $err)
        {
            ?>
            <div class='alert alert-danger' style="border-radius: inherit; border-left:3px solid red;">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Admin Error! </strong>
                <?php
                echo $err->getMessage();

                ?>
            </div>

            <?php


        }
    }



    public function get_limited_posts ($category, $limit)
    {
        try
        {

            $stmt = self::runQuery( "SELECT * FROM emg_posts WHERE category = :category AND status = 'publish' ORDER BY id DESC LIMIT $limit" );

            $stmt->execute([":category" => $category]);

            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            while($rows = $stmt->fetch()):



            endwhile;

        } catch (PDOException $err)
        {

        }
    }

    /*
     * Function to get post by id
     * @param $post_id
     * @post_item
     *
     *  * */


    public function get_by_id ($post_id, $post_item)
    {
        try
        {
            $stmt = $this->runQuery( "SELECT $post_item FROM emg_posts WHERE id = :post_id AND status = 'publish'" );

            $stmt->execute([':post_id' => $post_id]);

            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            if($stmt -> rowCount() > 0)
            {
                while($row = $stmt->fetch()):

                    echo $row[$post_item];

                endwhile;

            }
            else{
                echo "Null";
            }

        } catch (PDOException $err)
        {
            ?>
            <div class='alert alert-danger' style="border-radius: inherit; border-left:3px solid red;">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Admin Error! </strong>
                <br>
                <small>Inform Admin about this or post on forum!</small>
                <?php
                echo $err->getMessage();

                ?>
            </div>

            <?php

        }
    }


/**
* @param $postid
* @param $item
 * function to get posts by their random id
 */
        public function get_by_random_id ($postid, $item)
        {
        $stmt = self::runQuery( "SELECT post_ID, $item FROM emg_posts WHERE post_ID = :postid" );
        $stmt->execute([":postid"=>$postid]);
        while($rows = $stmt->fetch()):
        echo $rows[$item];
        endwhile;
        }


    /**
     * Function to get page data of a specified page
     * @param $post_item
     * @param $page_name
     *
     */


    public function get_page_data($post_item, $page_name)
    {
        try {

            $stmt = $this->runQuery( "SELECT $post_item FROM emg_posts WHERE post_url = :page_name ORDER BY id DESC LIMIT 1" );

            $stmt->execute([':page_name' => $page_name]);

            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            while($r = $stmt->fetch()):

                echo htmlspecialchars($post_item);

            endwhile;

        } catch (PDOException $err)
        {
            echo $err->getMessage();
        }
    }


    /**
     * Function to get part of the data of a particular page
     * With Param
     * @param $post_item
     * @param $page_name
     * @param $start
     * @param $end
     */

    public function get_part_data ($post_item, $page_name, $start, $end)
    {
        try{

            $stmt = $this->runQuery( "SELECT $post_item FROM emg_posts WHERE page_id = :page_name AND status = 'publish'" );

            $stmt->execute([':page_name' => $page_name]);

            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            while($r = $stmt->fetch()):

                $data = $r[$post_item];

                $part_data = substr($data, $start, $end);

                echo htmlspecialchars($part_data);

            endwhile;

        } catch (PDOException $err)
        {
            ?>
            <div class='alert alert-danger' style="border-radius: inherit; border-left:3px solid red;">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Admin Error! </strong>
                <br>
                <small>Inform Admin about this error or post on forum!</small>

                <?php
                echo $err->getMessage();

                ?>
            </div>

            <?php
        }
    }


    public function get_post_substring ($item, $category, $start, $end)
    {
    try {
    $stmt = self::runQuery( "SELECT $item FROM emg_posts WHERE post_category = :category" );
    $stmt->execute([":category"=>$category]);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    while($rows = $stmt->fetch()):

    echo substr($rows[$item], $start, $end);

    endwhile;

    } catch (PDOException $err){


    ?>

    <div class="alert alert-danger error-msg">
    <strong>Error!</strong>
    <p>There was an error fetching data, Contact Admin</p>
</div>
    <?php

    }
}


    public function change_status($post_status, $post_id)
    {
        try {
            //deleting the post_item
            $stmt = self::runQuery( "UPDATE emg_posts SET status = :status WHERE id  = :id" );
            $stmt->bindValue(":status", $post_status);
            $stmt->bindValue(":id", $post_id);
            $stmt->execute();
            ?>
            <div class='alert alert-success' style="border-radius: inherit; border-left:3px solid green;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Post was Trashed!</strong>
            <br>
            <p>The post was successfully dropped in the Trash <i class="fa fa-trash-o fa-2x"></i></p>

            <?php
        } catch (PDOException $err)

        {
            ?>
            <div class='alert alert-danger' style="border-radius: inherit; border-left:3px solid red;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Admin Error! </strong>
            <br>
            <small>Inform Admin about this error or post on forum!</small>

            <?php
        }
    }



/**
* @param $table
* @param $data
* @param $pdo
 * This is a generic function to be used in  inserting data
 * It can be accessed by saying
 * $table = "accounts";
 * $data = array("fname"=> "ahmed", "lastname"=> "Roy");
 *
 * insert($table, $data, $pdo)
 */
public function insert ($table, $data, $pdo)
{
foreach ($data AS $column => $value)
{
$sql = "INSERT INTO {$table} ({$column}) VALUES(:{$column});";
$stmt = self::runQuery($sql);
$stmt->execute(array(':'.$column => $value));

}
}


    /**
     * @param $csv_file
     * The CSV file should have a table with columns and rows already defined
     *Here the csv file includes id, name and city
 *
 * This should possible a plugin to activate
     *
     */
    public function upload_csv ($csv_file)
    {
        //validation check
        //checking if file is .csv
        $extension = explode('.', $csv_file["name"]);
        $extension = array_pop($extension);

        if(strtolower($extension) == "csv") {


            if (($handle = fopen($csv_file["tmp_name"], "r")) !== FALSE) {
                fgetcsv($handle);
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $num = count($data);
                    for ($c = 0; $c < $num; $c++) {
                        $col[$c] = $data[$c];
                    }

                    $col1 = $col[0];
                    $col2 = $col[1];
                    $col3 = $col[2];

// SQL Query to insert data into DataBase
                    $query = self::runQuery("INSERT INTO csv_tbl(name,city, Ide) VALUES(:col2, :col3, :col3)");
                    $query->bindValue(":col2", $col2);
                    $query->bindValue(":col3", $col3);
                    $query->bindValue(":col1", $col1);
                    $query->execute();
                }
                fclose($handle);
            }

            ?>

            <div class='alert alert-success col-md-9' style="border-radius: inherit; border-left:3px solid green;">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong>
                <p>File Details were successfully recorded</p>
            </div>
            <?php

        }else {
            ?>
            <div class='alert alert-danger col-md-9' style="border-radius: inherit; border-left:3px solid red;">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Error! Wrong File!</strong>
                <p>File Not a .csv</p>
            </div>
            <?php
        }
    }


    /**
* @param $admin_level
* @param $fname
* @param $e_email
* @param $uname
* @param $pwd
* @param $pic
 * Function to enter user
 *
 */
    public function enter_user ($admin_level, $fname, $e_email, $uname, $pwd, $pic)
    {

    try {
   //receiving the file involved in the transaction
    //receiving the image file


   $filename = basename($pic["name"]);
        $imageFileType = pathinfo($filename, PATHINFO_EXTENSION);
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            ?>
            <div class='alert alert-danger error-msg sharp-corners'>
            <strong>Error!</strong>
                Sorry, only JPG, JPEG, PNG & GIF files are allowed.
            </div>
            <?php
        } else {

            $rand = rand(0, 999999999);
            $ext = substr($filename, strrpos($filename, '.'));
            $ppx = preg_replace("/\\.[^.\\s]{3,4}$/", "", $filename);
            $f_filename = $ppx . '-' . $rand . '' . $ext;
            $target_dir = "uploads/";
            $target_file = $target_dir . $f_filename;
            move_uploaded_file($pic["tmp_name"], $target_file);
            $path = "uploads/" . $f_filename . "";
            $dater = date("Y-m-d H:i:s");


//getting the color for this admin
$a = array("red", "green", "blue", "yellow", "orange", "light-blue", "black", "purple", "gray", "maroon", "navy", "olive");
                $random_keys = array_rand($a, 3);
                $color = $a[$random_keys[0]];
//inserting the data into db

$insert = $this->runQuery( "INSERT INTO emg_meta (admin_email, admin_uname, admin_password, admin_fname, admin_level, admin_profile_pic, dater, admin_color)VALUES(:e_email, :uname, :pwd, :fname, :admin_level, :pic, :dater, :color)" );

$insert->bindValue(":admin_level", $admin_level);
$insert->bindValue(":fname", $fname);
$insert->bindValue(":e_email", $e_email);
$insert->bindValue(":uname", $uname);
$insert->bindValue(":pwd", $pwd);
$insert->bindValue(":pic", $path);
$insert->bindValue(":dater", $dater);
$insert->bindValue(":color", $color);
$insert->execute();

}
?>


                <div class="alert alert-success success-msg sharp-corners">
                <strong>Success!</strong>
                <p>The New Admin-<?php echo $admin_level; ?> was successfully registered</p>
</div>
                <?php


    } catch (PDOException $err) {

?>
<div class="alert alert-danger error-msg sharp-corners">
<strong>Error!</strong>
<p>Sorry, There was an error creating New Admin</p>
<?php echo $err->getMessage(); ?>
<small>Contact Admin to diagnose this Error!</small>
</div>
                <?php


    }

    }



       /**
* @param $admin_level
* @param $fname
* @param $e_email
* @param $uname
* @param $post_image
* @param $idd
 * Function to update the admin details, takes params above
 */

        public function edit_user ($admin_level, $fname, $e_email, $uname, $post_image, $idd)
        {
        try {

 //receiving the image file
            $filename = basename($post_image["name"]);
            //$imageFileType = pathinfo($filename, PATHINFO_EXTENSION);
            $rand = rand(0, 999999999);
            $ext = substr($filename, strrpos($filename, '.'));
            $ppx = preg_replace("/\\.[^.\\s]{3,4}$/", "", $filename);
            $f_filename = $ppx . '-' . $rand . '' . $ext;
            $target_dir = "uploads/";
            $target_file = $target_dir . $f_filename;
            move_uploaded_file($post_image["tmp_name"], $target_file);
            $path = "uploads/" . $f_filename . "";

//checking if the image is available


if(!empty($filename)){

        $stmt = $this->runQuery( "UPDATE emg_meta SET admin_level = :admin_level, admin_fname = :admin_fname, admin_email = :e_email, admin_uname = :admin_uname, admin_profile_pic = :pic WHERE id = :idd" );
        $stmt->bindValue(":admin_level", $admin_level);
        $stmt->bindValue(":admin_fname", $fname);
        $stmt->bindValue(":e_email", $e_email);
        $stmt->bindValue(":admin_uname", $uname);
        $stmt->bindValue(":pic", $path);
        $stmt->bindValue(":idd", $idd);
        $stmt->execute();

        ?>
        <div class="alert alert-success success-msg">
        <strong>Success</strong>
        <p>Admin Details Updated Successfully</p>
</div>
        <?php

}else{

        $stmt = $this->runQuery( "UPDATE emg_meta SET admin_level = :admin_level, admin_fname = :admin_fname, admin_email = :e_email, admin_uname = :admin_uname WHERE id = :idd" );
        $stmt->bindValue(":admin_level", $admin_level);
        $stmt->bindValue(":admin_fname", $fname);
        $stmt->bindValue(":e_email", $e_email);
        $stmt->bindValue(":admin_uname", $uname);
        $stmt->bindValue(":idd", $idd);
        $stmt->execute();

        ?>
        <div class="alert alert-success success-msg">
        <strong>Success</strong>
        <p>Admin Details Updated Successfully</p>
</div>
        <?php

}

        } catch (PDOException $err)
        {
        ?>
        <div class="alert alert-danger error-msg">
        <strong>Error!</strong>
        <p>Sorry, Failed to Edit</p>
        <?php echo $err->getMessage(); ?><br>
        <small>Please Report this error to the Forum</small>
        </div>
        <?php
        }

        }
        
        
        /**
* @param $item
* @param $random_id
 * Fucntion to get map details to embed google map
 */
        public function get_map_details ($item, $random_id)
        {
        $stmt = self::runQuery( "SELECT post_id, $item FROM map_details WHERE post_id = :random_id" );
        $stmt->execute([":random_id"=>$random_id]);
        while ($rows = $stmt->fetch()):
        echo $rows[$item];
        endwhile;
        }
        
                /**
        * @param $location
         * function to get the number of posts in a specific location
         */
        public function count_by_region($location)
        {
       $stmt = $this->runQuery("SELECT COUNT(*) AS rcount FROM emg_posts WHERE post_location like '%{$location}%'");
       $stmt->execute();
       $stmt->setFetchMode(PDO::FETCH_ASSOC);
       while($re = $stmt->fetch()):
       echo $re['rcount'];
       endwhile;
        }
        
                /**
        * function to count all deals/posts in the emg_posts table
         */
        public function count_all_posts ()
        {
        $stmt = self::runQuery( "SELECT COUNT(*) AS citems FROM emg_posts" );
        $stmt->execute();
        while($rows = $stmt->fetch()):
        echo $rows['citems'];
        endwhile;
        }


        public function count_locations ()
        {
        $stmt = self::runQuery( "SELECT COUNT(*) AS clocations FROM emg_locations" );
        $stmt->execute();
        while($rows = $stmt->fetch()):
        echo $rows['clocations'];
        endwhile;
        }

                /**
        * @param $category
         * function to count the numebr of posts in a category
         */
        public function count_by_category ($category)
        {
        $stmt = self::runQuery( "SELECT COUNT(*) AS ccount FROM emg_posts WHERE post_category = :category" );
        $stmt->execute([":category"=>$category]);
        while($rows = $stmt->fetch()):
        echo $rows['ccount'];
        endwhile;
        }


                /**
        * @param subcat $
         * function to count the number of posts with a particular subcategory
         */
        public function count_by_subcategory ($subcat)
        {
        $stmt = self::runQuery( "SELECT COUNT(*) AS csub FROM emg_posts WHERE sub_category = :subcat" );
        $stmt->execute([":subcat"=>$subcat]);
        while($rr = $stmt->fetch()):
        echo $rr['csub'];
        endwhile;
        }


/**
* @param $sub
* @param $location
 * function to count how many posts are from a particular location in a particular subcategory
 */
 
        public function count_sub_by_location ($sub, $location)
        {
        $stmt = self::runQuery( "SELECT COUNT(*) AS csubloc FROM emg_posts WHERE sub_category = :sub AND 
        post_location like '%{$location}%'" );
        $stmt->execute([":sub"=>$sub]);
        while($rows = $stmt->fetch()):
        echo $rows['csubloc'];
        endwhile;
        }

        /**
        * @param $tablename
        * @param $rowname
        * @param $value
         * Function to count items
         *
         */


        public function count_item ($tablename, $rowname, $value)
        {

        $stmt = $this->runQuery( "SELECT COUNT(*) AS counted FROM $tablename WHERE $rowname = :value" );
        $stmt->execute([":value"=>$value]);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        while($rows = $stmt->fetch()):
        echo $rows['counted'];
        endwhile;
        }

/**
* @param $id
 */

        public function delete_admin($id)
        {

        if($id == 1)
        { ?>
        <div class="alert alert-danger error-msg">
        <strong>Invalid Operation!</strong>
        <p>Main Admin Cannot be deleted!</p>
</div>
<?php


        }else{
        //delete
        $stmt = $this->runQuery( "DELETE FROM emg_meta WHERE id = :id" );
        $stmt->execute([":id"=>$id]);
        ?>
                <div class="alert alert-success success-msg">
                <strong>Success!</strong>
                <p>Admin Successfully Deleted</p>
</div>
                <?php


        }

        }


        /**
* @param $item
* @param $id
 *
 */

        public function get_admin($item, $id)
        {

        $stmt = $this->runQuery( "SELECT $item FROM emg_meta WHERE id = :id" );
        $stmt->execute([":id"=>$id]);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        while($rows = $stmt->fetch()):
        echo $rows[$item];
        endwhile;
        }



     /**
* @param $post_id
 * Geting the post tags
 */
     public function get_post_tags ($post_id)
     {
     $stmt = self::runQuery( "SELECT * FROM emg_post_tag_relate WHERE post_ID = :post_id" );
     $stmt->execute([":post_id"=>$post_id]);
     $stmt->setFetchMode(PDO::FETCH_ASSOC);
          while($rows = $stmt->fetch()):
          echo $rows['tag'];
          endwhile;
     }



/**
* @param $post_id
 * Function to get posts that are similar and have the same tags as the current one
 *
 */
     public function get_related_posts ($post_id)
     {
     //we first get the tags related to this post
     $stmt = self::runQuery( "SELECT * FROM emg_post_tag_relate WHERE post_ID = :post_id" );
     $stmt->execute([":post_id"=>$post_id]);
     $stmt->setFetchMode(PDO::FETCH_ASSOC);
          while($rows = $stmt->fetch()):
          $tag = array($rows['tag']);


          //then we write a foreach to fetch similar tags per post
          foreach ($tag AS $t):
          $s = self::runQuery( "SELECT * FROM emg_post_tag_relate WHERE tag = :t ORDER BY id DESC LIMIT 1" );
          $s->execute([":t"=>$t]);
          $s->setFetchMode(PDO::FETCH_ASSOC);
          while($r = $s->fetch()):
          $related_postid = $r['post_ID'];
          echo $related_postid;
              $m = self::runQuery( "SELECT * FROM emg_posts WHERE post_ID = :related_postid LIMIT 1" );
              $m->execute([":related_postid"=>$related_postid]);
              $m->setFetchMode(PDO::FETCH_ASSOC);
              while($rk = $m->fetch()):
                  //echo $rk[$item];
                  ?>
                      <!--Start of thumbnail-->
    <div class="thumbnail col-md-12 sharp-corners space-up no-borders">
        <!--<img src="img/advert.png" alt="..." style="height:120px; width:100%;">-->
        <div class="" style="background:url('<?php self::get_site('hostname'); ?>/emg_admin/<?php echo $rk['post_image']; ?>') center / cover; width:100%; height:120px; border-bottom:5px solid #283891;"></div>
        <div class="clearfix"></div>
        <!--End of Thumbnail-->
        <h4 class="theming" style="font-family:'Open Sans Light';">
        <a  style="color:#3F5259;" href="<?php self::get_site('hostname'); ?>/details/<?php echo $rk['post_url']; ?>">
        <?php echo $rk['post_title']; ?>
        </a>
        </h4>
        <!--<p class="theming">Progressively reintermediate alternative vortals </p>-->
    </div>
    <!--End of thumbnail-->
<?php
              endwhile;

          endwhile;


          endforeach;

//ending the first while
          endwhile;


     }





/**
* @param $postid
* @param $item
 * Funtion to return items concerned with the author of the articles with the given post_ID (random Number)
 */
    public function get_writer ($postid, $item)
    {
    $stmt = self::runQuery( "SELECT author, post_ID FROM emg_posts WHERE post_ID = :post_id" );
    $stmt->execute([":post_id"=>$postid]);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    while($rows = $stmt->fetch()):
    $author = $rows['author'];

    //geting the fullname of the author
    $a = self::runQuery( "SELECT * FROM emg_meta WHERE admin_uname = :author"  );
    $a->execute([":author"=>$author]);
    $a->setFetchMode(PDO::FETCH_ASSOC);
    while($r = $a->fetch()):
    echo $r[$item];
    endwhile;

    endwhile;
    }



/**
* @param $tag
 * Getting the post by tag
 *
 */
    public function get_post_by_tag ($tag)
    {
    $stmt = self::runQuery( "SELECT * FROM emg_post_tag_relate WHERE tag = :tag" );
    $stmt->execute([":tag"=>$tag]);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    while($rows = $stmt->fetch()):
        $post_ID = $rows['post_ID'];

         //getting the post
         $p = self::runQuery( "SELECT * FROM emg_posts WHERE post_ID = :post_ID" );
         $p->execute([":post_ID"=>$post_ID]);
         $p->setFetchMode(PDO::FETCH_ASSOC);
         while($r = $p->fetch()):
            ?>
                     <!--Start of big thumbnail-->
	<div class="col-lg-12 border space-up" style="font-family:'Source Sans Pro'; border-top:5px solid #257448;">

        <br>
<div class="col-md-4" style="bottom:10px;right:15px; ">
    <img src="<?php self::get_site('hostname'); ?>/emg_admin/<?php echo $r['post_image']; ?>" style="width:100%; height:100%;">
</div>

        <div class="col-md-8">
            <p style="font-size:23px;" class="border-bottom bold"><a href="<?php self::get_site('hostname'); ?>/details/<?php echo $r['post_url']; ?>" style="color:#000;"><?php echo $r['post_title']; ?></a></p>
            <p>
<?php echo substr($r['post_content'], 0, 340); ?>
</div>
            </p>

        </div>
        <br>

	</div>
<!--end of Horizontal thumbnail-->


                <?php
         endwhile;
    endwhile;

    }






            /**
             * @param $item
             * @param $post_title
             * Function to get a certain item according to the post_title given
             *
             */
    public function get_by_post_title ($item, $post_title)
    {

    try {

    $stmt = self::runQuery( "SELECT $item FROM emg_posts WHERE post_title = :post_title" );
                $stmt->execute([":post_title"=>$post_title]);
                while($rows = $stmt->fetch()):

                    echo $rows[$item];

                    endwhile;

    } catch (PDOException $err)
    {
    ?>
                <div class="alert alert-danger col-md-9">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Error!</strong>
                    <p>
                    <?php
    echo $err->getMessage();
?>
                        </p>
                </div>
                <?php
    }
    }


    /**
* @param $fname
* @param $lname
* @param $email
* @param $username
* @param $password
 * Function to enter  the artist's profile
 */

     public function enter_profile ($fname, $lname, $email, $username, $password)
    {
        try {

        //checking if the email address already exists
        $q = self::runQuery( "SELECT email FROM emg_artist_account WHERE email = :email" );
        $q->execute([":email"=>$email]);
                    if($q->rowCount() > 0)
            {
            //user exists
            ?>
            <div class="alert alert-info sharp-corners">
            <strong>User Exists!</strong>
            <p>The email used already exists!</p>
</div>
            <?php
}else{
            $stmt = self::runQuery( "INSERT INTO emg_artist_account (fname, lname, email, username, password)VALUES(:fname, :lname, :email, :username, :password)" );
            $stmt->bindValue(":fname", $fname);
            $stmt->bindValue(":lname", $lname);
            $stmt->bindValue(":email", $email);
            $stmt->bindValue(":username", $username);
            $stmt->bindValue(":password", $password);
            $stmt->execute();
            ?>
            <div class="alert alert-success success-msg sharp-corners">
                <strong>Success!</strong>
                <p>Account was Created Successfuly</p>
            </div>

<?php
}
        } catch (PDOException $err)
        {
            ?>
<p>There was an Error creating your account</p>
            <!--<div class="alert alert-danger error-msg sharp-corners">
                <strong>Error!</strong>
                <p>There was an Error creating your account</p>
                <p><?php //echo $err->getMessage();?></p>
            </div>-->
<?php
        }

    }



    /**
     * @param $pasttimex
     * Roy Kusemererwa Library Function to get time duration
     * e.g. timeago(2016-09-07 17:54:34);
     */
    public function timeago($pasttimex)
    {

        $timee = substr("$pasttimex", 11, 12);

        $pasttimer = substr("$timee", 0, 5);
//echo "<br>";

        $hrext = substr("$pasttimer", 0, 2);
        $today = date("Y-m-d H:i:s");
//extracting the year from the given date [patttimex]
        $yearext = substr("$pasttimex", 0, 4);
        $monthext = substr("$pasttimex", 5, 6);
//extracting the month
        $monthext2 = substr("$monthext", 0, 2);
//extracting the day
        $dayext = substr("$monthext", 3, 5);
//today
        $dday = date("d");
//yesterday
        $yesterday = $dday - 1;
        ##echo $yesterday;
//2days ago
        $twodays = $dday - 2;
###echo $twodays;

//echo $monthext;
####echo "<br>$dayext<br>";
        $dyear = date("Y");
        $dmonth = date("m");

        if ($yearext == $dyear) {
            ###echo "The year is $yearext when the post was made<br>";
            //lets now find the month
            if ($monthext2 == $dmonth) {
###echo "<br>The month being $monthext2<br>";

//determining the day wen the post was made
############################
                if ($dayext == $yesterday) {

                    echo "Yesterday";
                } else if ($dayext == $twodays) {
                    echo "two days ago";
                } else if ($dayext < $twodays) {
//lets check for more days
                    //if the post was made more than two days ago, then tell me the real date
                    echo "on ";
//echo $pasttimex;
                    $changed = date_create_from_format('Y-m-d H:i:s', $pasttimex);
//echo"<br>";
                    echo date_format($changed, 'd F Y');
                    //echo "<br>";
                } else {
//lets extract the minutes from the pasttimer variable
                    $extract = substr("$pasttimer", 3, 4);
###echo $extract;


//echo "<br>";
                    $nowtime = date("H:i");

###echo "Its now $nowtime<br>";

//we subtract the current time from the pasttime
                    $remainingtime = $pasttimer - $nowtime;

                    if ($remainingtime != 0) {
                        //removing the negative sign before the hour
                        //lets first isolate it
                        $rremaingtime = substr("$remainingtime", 0, 1);
                        $cut = substr("$remainingtime", 1, 2);
                        if ($rremaingtime == "") {
                            echo $remainingtime;
                        } else {
#########################
                            //echo $twodays;
                            echo "";
                            ################3
                            echo $cut;

//if it is one hour, say the correct english naawe
                            if ($cut == 1) {
                                echo " hour ago";
                            } else {
                                echo " hours ago";
                            }
                        }
                    } else {
//get the seconds in the hour
                        $sectime = $remainingtime * 3600;
//convert it to minutes
                        $mintime = $remainingtime * 60;

                        /*echo "<br>it has ";
                        echo $mintime;*/
//echo "<br>";


//the conditions in order to display minutes
                        if ($mintime < 60) {
                            $nowmin = date("i");
                            $remainmin = $nowmin;
//to get the real remaining minutes we have to subtract the extract from the mintime
                            $rremainmin = $remainmin - $extract;
                            if ($rremainmin == 0) {
                                echo "Just Now";
                            } else {
                                echo "";
                                echo $rremainmin;
                                echo " min ago";

                            }

                        }
//converting the minutes to seconds

                    }
                }
            } else if ($monthext < $dmonth) {
                ##############################
               // echo "<br>";
//echo $pasttimex;
                $changed = date_create_from_format('Y-m-d H:i:s', $pasttimex);
                //echo "<br>";
                echo date_format($changed, 'd M Y');
                //echo "<br>";
                //echo "<br>$pasttimex<br>";
            }
        } else {

            //echo "<br>";
            $changed = date_create_from_format('Y-m-d H:i:s', $pasttimex);
//	echo $pasttimex;
            echo date_format($changed, 'd M Y');
            //echo "<br>";
        }
    }


        /**
        * @param $start_date
        * @param $end_date
         * This function counts the remaining time for an event to happen
         * the time formats it receives are full timestamps like  in the format 2016-12-01 12:40:00
         *
         * The start date should be lower than the end date
         * eg.
         * $enddate = "2012-09-11 10:25:00";
                $startdate = "2007-09-01 04:10:58";
         */

        public function remaining_time ($start_date, $end_date)
       {

                                $start_date = new DateTime($start_date);
                                $since_start = $start_date->diff(new DateTime($end_date));
                                //echo $since_start->days.' days total<br>';
/*
                                echo $since_start->y.' years<br>';
                                echo $since_start->m.' months<br>';
                                echo $since_start->d.' days<br>';
                                echo $since_start->h.' hours<br>';
                                echo $since_start->i.' minutes<br>';
                                echo $since_start->s.' seconds<br>';
                        echo "<br/>*****************************<br/>";
*/
                                //how to detect and display
                                if($since_start->y > 0)
                                {
                                    echo $since_start->y. 'years';

                                }else if($since_start->m > 0)
                                {
                                    echo $since_start->m.' months';

                                }else if($since_start->d > 0)
                                {
                                    echo $since_start->d.' days';

                                }else if ($since_start->h > 0)
                                {
                                    echo $since_start->h.' hours';

                                }else if ($since_start->i < 59 )
                                {
                                    echo $since_start->i.' minutes';

                                }else if($since_start->i = 0)
                                {

                                    echo "<font color='red' class='bold'>THIS DEAL HAS EXPIRED</font>";

                                }
        }



 public function enter_plugin ($plugin_name, $plugin_details, $post_image, $fname)
 {
         //receiving the image file
        $filename = basename($post_image["name"]);
        $imageFileType = pathinfo($filename, PATHINFO_EXTENSION);
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            ?>
            <div class='alert alert-danger' style="border-radius: inherit; border-left:3px solid red;"><strong>Error!</strong>
                Sorry, only JPG, JPEG, PNG & GIF files are allowed.
            </div>
            <?php
        } else {
            $rand = rand(0, 999999999);
            $ext = substr($filename, strrpos($filename, '.'));
            $ppx = preg_replace("/\\.[^.\\s]{3,4}$/", "", $filename);
            $f_filename = $ppx . '-' . $rand . '' . $ext;
            $target_dir = "uploads/";
            $target_file = $target_dir . $f_filename;
            move_uploaded_file($post_image["tmp_name"], $target_file);
            $path = "uploads/" . $f_filename . "";
            $dater = date("Y-m-d H:i:s");

            try {
            //inserting the info into the db
            $stmt = self::runQuery( "INSERT INTO emg_plugins (plugin_name, plugin_details, plugin_image, fname, dater)
                                                        VALUES(:plugin_name, :plugin_details, :plugin_image, :fname, :dater)" );
            $stmt->bindValue(":plugin_name", $plugin_name);
            $stmt->bindValue(":plugin_details", $plugin_details);
            $stmt->bindValue(":plugin_image", $path);
            $stmt->bindValue(":fname", $fname);
            $stmt->bindValue(":dater", $dater);
            $stmt->execute();
            ?>

                <div class="alert alert-success sharp-corners">
                <strong>Success!</strong>
                <p>Your plugin was successfully Submitted</p>
                <p>Wait for its approval</p>
</div>
                <?php
            } catch (PDOException $err)
            {
            ?>
                <div class="alert alert-danger sharp-corners">
                <strong>Error!</strong>
                <p>Your plugin was not submitted</p>
                <p><?php echo $err->getMessage(); ?></p>
</div>
                <?php
            }
            }

 }



    public function enter_pod ($post_title, $post_content, $post_image, $post_category, $page, $status, $author, $tags, $new_tag, $fieldname, $fieldvalue)
    {

//checking if the title of this post already exists
$c = self::runQuery("SELECT post_title FROM emg_posts WHERE post_title = :post_title");
$c->execute([":post_title"=>$post_title]);
if($c->rowCount() > 0){
?>
<div class="alert alert-info sharp-corners">
<strong>Sorry Entry Failed!</strong>
<p>Another post with this title already exists, please try to change the title and then post.
Also update your Category, tags and Image. Thanks!
</p>
</div>

<?php

}else{
        //receiving the image file
        $filename = basename($post_image["name"]);
        $imageFileType = pathinfo($filename, PATHINFO_EXTENSION);
        // Allow certain file formats
        if ($imageFileType != "ogg" && $imageFileType != "mp3" && $imageFileType != "mp4"
            && $imageFileType != "gif" && $imageFileType != "wav"

        ) {
            ?>
            <div class='alert alert-danger' style="border-radius: inherit; border-left:3px solid red;"><strong>Error!</strong>
                Sorry, only awv, mp3, mp4 & ogg files are allowed.
            </div>
            <?php
        } else {
            $rand = rand(0, 999999999);
            $ext = substr($filename, strrpos($filename, '.'));
            $ppx = preg_replace("/\\.[^.\\s]{3,4}$/", "", $filename);
            $f_filename = $ppx . '-' . $rand . '' . $ext;
            $target_dir = "uploads/";
            $target_file = $target_dir . $f_filename;
            move_uploaded_file($post_image["tmp_name"], $target_file);
            $path = "uploads/" . $f_filename . "";
            $dater = date("Y-m-d H:i:s");

            $post_url = self::php_slug($post_title);
            $post_ID = rand(0, 9999999999);

            try {
                $stmt = self::runQuery("INSERT INTO emg_posts(post_ID, post_title, post_content, post_image, post_category, page_id, post_url, dater, status, author)
                                                             VALUES(:post_ID, :post_title, :post_content, :post_image, :post_category, :page_id,  :post_url, :dater, :status, :author)");

                $stmt->bindValue(":post_title", $post_title);
                $stmt->bindValue(":post_ID", $post_ID);
                $stmt->bindValue(":post_content", $post_content);
                $stmt->bindValue(":post_image", $path);
                $stmt->bindValue(":post_category", $post_category);
                $stmt->bindValue(":page_id", $page);
                $stmt->bindValue(":post_url", $post_url);
                $stmt->bindValue(":dater", $dater);
                $stmt->bindValue(":status", $status);
                $stmt->bindValue(":author", $author);
                $stmt->execute();

                if(!empty($tags)){
                //entering tags for this particular post
                foreach ($tags AS $tg):
                $s = self::runQuery( "INSERT INTO emg_post_tag_relate(tag, post_ID) VALUES(:tag, :post_id)" );
                $s->bindValue(":tag", $tg);
                $s->bindValue(":post_id", $post_ID);
                $s->execute();
                endforeach;
                }

                if(!empty($new_tag)){
                //introducing  new tag
                $n = self::runQuery( "INSERT INTO emg_tags(tags) VALUES(:tag)" );
                $n->bindValue(":tag", $new_tag);
                $n->execute();

                //another transaction to enter the new_tag into the relate table also if all of them are available
                $t = self::runQuery( "INSERT INTO emg_post_tag_relate(tag, post_ID) VALUES(:tag, :post_id)" );
                $t->bindValue("tag", $new_tag);
                $t->bindValue(":post_id", $post_ID);
                $t->execute();
                }


                //entering the additioanl data
                for($i=0, $count = count($fieldname);$i<$count;$i++) {
                    $fName  = $fieldname[$i];
                    $fvalue = $fieldvalue[$i];

                   /* echo $fName;
                    echo "-";
                    echo $fvalue;
                   */
                    $ff = self::runQuery( "INSERT INTO emg_field_details (postID, fieldID, Detail) VALUES(:postid, :fieldid, :detail)" );
                    $ff ->bindValue(":postid", $post_ID);
                    $ff->bindValue(":fieldid", $fName);
                    $ff->bindValue(":detail", $fvalue);
                    $ff->execute();
                }

 ?>

                <div class='alert alert-success' style="border-radius: inherit; border-left:3px solid green;">
                    <strong>Success!</strong>
                    Post successfully created.
     <br/>
     <!--<a href="additional-info.php?id=<?php //echo $post_ID; ?>">Add More Information</a>-->

                </div>
                <?php
                return $stmt;

            } catch (PDOException $err) {
                ?>
                <div class='alert alert-danger' style="border-radius: inherit; border-left:3px solid red;"><strong>Admin Error! </strong>
                    <?php
                    echo $err->getMessage();

                    ?>
                </div>

                <?php

            }

        }
    }
}

 
 
 
 
    public function dataview2($query)
    {
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        if($stmt->rowCount()>0)
        {
            while($row=$stmt->fetch(PDO::FETCH_ASSOC))
            {
                ?>
                <tr>
                    <td>&nbsp&nbsp<a href="edit-podcast.php?id=<?php echo $row['id']; ?>" class="post_title"><?php echo $row['post_title']; ?></a><p style="font-size:10px;">&nbsp&nbsp&nbsp<a href="edit-podcast.php?id=<?php echo$row['id'];?>">Edit</a> | <a href="podcast_delete.php?id=<?php echo$row['id']; ?>">Delete</a></p></td>
                    <td><?php echo $row['author']; ?></td><td><?php echo $row['post_category']; ?></td>
                    <td> Published <br><?php echo $row['dater']; ?></td>
                </tr>
                <?php
            }
        }
        else
        {
            ?>
            <tr>
                <td>No Post yet, make some posts</td>
            </tr>

            <?php
        }

    }


	public function update_post2 ($post_id, $post_title, $post_content, $post_image, $post_category, $status, $author)
    {
        try {

            //receiving the image file
            $filename = basename($post_image["name"]);
            //$imageFileType = pathinfo($filename, PATHINFO_EXTENSION);
            $rand = rand(0, 999999999);
            $ext = substr($filename, strrpos($filename, '.'));
            $ppx = preg_replace("/\\.[^.\\s]{3,4}$/", "", $filename);
            $f_filename = $ppx . '-' . $rand . '' . $ext;
            $target_dir = "uploads/";
            $target_file = $target_dir . $f_filename;
            move_uploaded_file($post_image["tmp_name"], $target_file);
            $path = "uploads/" . $f_filename . "";

//checking if the image is available

            if(empty($filename)){
                $stmt = self::runQuery("UPDATE emg_posts SET post_title = :post_title, post_content = :post_content, post_category = :post_category, status = :status, author = :author WHERE id = :post_id");
                $stmt->bindValue(":post_title", $post_title);
                $stmt->bindValue(":post_content", $post_content);
                $stmt->bindValue(":post_category", $post_category);
                $stmt->bindValue(":status", $status);
                $stmt->bindValue(":author", $author);
                $stmt->bindValue(":post_id", $post_id);
                $stmt->execute();
                ?>
                <div class='alert alert-success' style="border-radius: inherit; border-left:3px solid green;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong>
                    Post successfully Updated.
                </div>
                <?php
            }else {
                //if the image is not available
                $stmt = self::runQuery("UPDATE emg_posts SET post_title = :post_title, post_content = :post_content, post_image = :post_image, post_category = :post_category, status = :status, author = :author WHERE id = :post_id");

                $stmt->bindValue(":post_title", $post_title);
                $stmt->bindValue(":post_content", $post_content);
                $stmt->bindValue(":post_image", $path);
                $stmt->bindValue(":post_category", $post_category);
                $stmt->bindValue(":status", $status);
                $stmt->bindValue(":author", $author);
                $stmt->bindValue(":post_id", $post_id);
                $stmt->execute();
                ?>
                <div class='alert alert-success' style="border-radius: inherit; border-left:3px solid green;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong>
                    Post successfully Updated.
                </div>
                <?php



            }        } catch (PDOException $err)
        {
            ?>
            <div class='alert alert-danger' style="border-radius: inherit; border-left:3px solid red;">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Admin Error! </strong>
                <?php
                echo $err->getMessage();

                ?>
            </div>

            <?php


        }
    }

public function get_site_vist($item)
    {
        try
        {

            $stmt =self::runQuery( "SELECT count(*) as gg FROM `emg_visit` WHERE `post_ID` = $item" );

            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            while($rows = $stmt->fetch()):

                echo $rows['gg'];

            endwhile;

        } catch (PDOException $err)
        {
            echo $err->getMessage();
        }

    }
	
}

