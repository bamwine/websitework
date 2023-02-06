<link href="css/bootstrap.min.css" rel="stylesheet">

<div class="panel panel-default center-block" style="width:500px;">
    <div class="panel-body">
<h2>Great! <br>You are now good to go!!</h2>
        <h4>We officially welcome you to SiteMine</h4>
        <button class="btn btn-info">Start Now</button>
    </div>
</div>

<div class="RegSpLeft" id="phone">
    <input type="text" value="Phone">
    <br />
</div>


<div class="RegSpRight">
    <a href="#" class="p1">+
    </a>

    <br />
    <a href="#" class="mi">-</a>
</div>

<script type="text/javascript" src="../js/jquery.js"></script>

<script type="text/javascript">
    $(function() {
        $('a.p1').click(function(e) {
            e.preventDefault();
            $('#phone').append('<input type="text" value="Phone">')
        });
        $('a.mi').click(function(e){
            e.preventDefault();
            if($('#phone input').length > 1)
            {
                $('#phone').children().last().remove();
            }
        });
    });
</script>

<?php
include 'config.php';
//creating table in database

//$db->create_table();
?>
<?php
if(file_exists('install.php')){
    $file = fopen('install.php', 'r+');
    $new_content = "<?php
     
     \$db_host = 'localhost';
      
      \$db_name = 'emg_tvc';
      
      \$db_username = 'root';
      
      \$db_pass = '';
      
try {       
\$con = new PDO(\"mysql:host={\$db_host};dbname={\$db_name}\", \"\$db_username\", \"\$db_pass\");

\$con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
\$users = \$con->prepare( \"CREATE TABLE IF NOT EXISTS  emg_users (id int(255) NOT NULL PRIMARY KEY AUTO_INCREMENT, username varchar(255) NOT NULL, password varchar(255) NOT NULL)\" );
\$users->execute();

\$admins = \$con->prepare(\"CREATE TABLE IF NOT EXISTS admins (id int(255) PRIMARY  KEY NOT NULL AUTO_INCREMENT, admin_uname varchar(255) NOT NULL, admin_pwd varchar(255) NOT NULL)\");
\$admins->execute();

} catch (PDOException \$err)
{
echo \$err->getMessage();
}
 
";
    $old_content = file_get_contents($file);
    echo fwrite($file, $new_content . $old_content );

    ?>
    <div class='panel panel-default'>
        <button class='btn btn-default'>Run The Install</button>
    </div>
    <?php
    fclose($file);
}
    ?>
    <form action="append.php" method="post">
        <input type="text" name="db">
        <button name="submit">Submit</button>
    </form>

    <?php
    /*if (isset($_POST['submit'])) {
        $host = $_POST['db'];
        /*$file = fopen("config.php", "w");
        echo fwrite($file, "");
        fclose($file);
    }*/

       /* $var_str = var_export($host, true);
        $var = "<?php\n\n \$db_host = $var_str; \n\n?>";
        file_put_contents('config.php', $var);*/

  // }
//}
?>