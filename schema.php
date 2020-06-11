<?php 
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	$schema = new schema();
	$table = array(
		'users' => "
		CREATE TABLE IF NOT EXISTS users
			(
				id int not null AUTO_INCREMENT PRIMARY KEY,
				username varchar(50),
				email varchar(150) UNIQUE KEY,
				password varchar(200),
				session_token text,
				activate_token text,
				password_reset_token text,
				role enum('Admin','Staff') default 'Staff',
				status enum('Active','Passive') default 'Passive',
				added_by int,
				created_date datetime default current_timestamp,
				updated_date datetime on update current_timestamp
			)
	",
	'superuser' => "
		INSERT into users SET 
			username = 'Admin',
			email = 'admin@roomyan.com',
			password = '".sha1('admin@roomyan.comroman2056')."',
			role = 'Admin',
			status = 'Active'	
	",
	'category' => "
		CREATE TABLE IF NOT EXISTS categories
			(
				id int not null AUTO_INCREMENT PRIMARY KEY,
				categoryname varchar(30),
				description text,
				status enum('Active','Passive') default 'Passive',
				added_by int,
				created_date datetime default current_timestamp,
				updated_date datetime on update current_timestamp
			)
	",
	'blog-post' => "
				CREATE TABLE IF NOT EXISTS blogs
					(
						id int not null AUTO_INCREMENT PRIMARY KEY,
						
						title varchar(250),
						content text,
						featured enum('Featured','notFeatured') default 'notFeatured',
						categoryid int,
						view int,
						image varchar(50),
						status enum('Active','Passive') default 'Active',
						added_by int,
						created_date datetime default current_timestamp,
						updated_date datetime on update current_timestamp
					)
			",

			'advertisement'=>"
        CREATE TABLE IF NOT EXISTS advertisements
          (
            id int not null AUTO_INCREMENT PRIMARY KEY,
            adTitle varchar(100),
            url varchar(250),
            type enum('Simple','Wide') default 'Simple',
            status enum('Active','Passive') default 'Passive',
            image varchar(50),
            added_by int,
            created_date datetime default current_timestamp,
            updated_date datetime on update current_timestamp
          )
      ",

		'Info' => "
			CREATE TABLE IF NOT EXISTS info
				(
					id int not null AUTO_INCREMENT PRIMARY KEY,
					icon_name varchar(30),
					url varchar(50),
					class varchar(30),
					status enum('Active','Passive') default 'Active',
					added_by int,
					created_date datetime default current_timestamp,
					updated_date datetime on update current_timestamp
				)
		",
		

		'comment' => "
				CREATE TABLE IF NOT EXISTS comments
					(
						id int not null AUTO_INCREMENT PRIMARY KEY,
						
						name varchar(50),
						email varchar(100),
						website varchar(50),
						message text,
						commentType enum('comment', 'reply') default 'comment',
						commentid int,
						
						blogid int,
						state enum('waiting','accept','reject') default 'waiting',
						status enum('Active','Passive') default 'Active',
						added_by int,
						created_date datetime default current_timestamp,
						updated_date datetime on update current_timestamp
					)
			",

			'archive' => "
				CREATE TABLE IF NOT EXISTS archives
					(
						id int not null AUTO_INCREMENT PRIMARY KEY,
						date varchar(20),
						status enum('Active','Passive') default 'Active',
						added_by int,
						created_date datetime default current_timestamp,
						updated_date datetime on update current_timestamp
					)
			",
			'contactmessage'=>"
                  CREATE TABLE IF NOT EXISTS contactmessages
                  (
                   id int not null AUTO_INCREMENT PRIMARY KEY,
                   email varchar(100),
                   subject varchar(50),
                   message text,
                   state enum('waiting','accept','reject') default 'waiting',
                   status enum('Active','Passive') default 'Active',
                   added_by int,
                   created_date datetime default current_timestamp,
                   updated_date datetime on update current_timestamp
                  ) 
				  ",
				  
				  'newsletter'=>"
                    CREATE TABLE IF NOT EXISTS newsletters
                    (
                    id int not null AUTO_INCREMENT PRIMARY KEY,
                    email varchar(100),
                    status enum('Active','Passive') default 'Active',
                    added_by int,
                    created_date datetime default current_timestamp,
                    updated_date datetime on update current_timestamp
                    ) 
                    "    
          );

	foreach ($table as $key => $sql) {
		try{
			$success = $schema->create($sql);
			// echo $sql;
			if ($success) {
				echo "Query ".$key." Executed Successfully<br>";
			}else{
				echo "Problem While Executing Query :".$key."<br>";
			}
		}catch(PDOException $e){
			error_log(Date("M d, Y h:i:s a").' : (run Query) : '.$e->getMessage()."\r\n",3,ERROR_PATH.'error.log');
			return false;

		}
	}


 ?>