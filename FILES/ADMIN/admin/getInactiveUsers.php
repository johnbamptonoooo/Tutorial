<?php

require_once('connections/db_connection.php');

mysql_select_db($database, $connect);
mysql_query("SET NAMES 'utf8'");


	//start transaction
	mysql_query("SET AUTOCOMMIT=0;");
	mysql_query("START TRANSACTION;");


	$get_users = mysql_query("SELECT u.id AS id, u.name AS name, u.surname AS surname, st.name AS status, u.location AS location,
             u.nickname AS nickname, u.avatar AS avatar FROM users u, status_table st
             WHERE u.status=st.id AND u.status!=9 AND u.user_type=1 AND (NOW() + INTERVAL -100 DAY) > lastLogin;");

	//commit transaction
	mysql_query("COMMIT;");

	?>
	<br><button type="button" onclick="fun_remove();"
					 class="btn delete">Remove inactive users</button><br><br>
	<table class="table">
		<thead>
			<tr>
				<th class="small1">Avatar</th>
				<th>Nickname</th>
				<th>Name</th>
				<th>Surname</th>
				<th class="small10">Status</th>
				<th class="small10">Location</th>
				<th class="small1">Action</th>
			</tr>
		</thead>
		<tbody>
			
			<?php

			while ($get_users2 = mysql_fetch_assoc($get_users))
			{ ?>
				<tr>
					
					<?php

					if ($get_users2["avatar"] != '')
					{ ?>
						<td><div class="image-preview"
					     style="background-image: url('../velvetpoker/assets/users/<?php echo $get_users2["avatar"]; ?>')"></div>
						</td>

						<?php
					}
					else
					{ ?>
						<td><div class="image-preview"
					     style="background-image: url('../velvetpoker/assets/users/Default.jpg')"></div>
						</td>

						<?php
					}

					?>
										 
					<td><?php echo $get_users2['nickname']; ?></td>
					<td><?php echo $get_users2['name']; ?></td>
					<td><?php echo $get_users2['surname']; ?></td>
					<td style="text-align:center"><?php echo $get_users2['status']; ?></td>
					<td><?php echo $get_users2['location']; ?></td>
					<td class="center"><a href="editUser.php?id=<?php echo $get_users2["id"]; ?>" class="edit-button"></a></td>
				</tr>
			
			<?php

			}

			?>	
		
		</tbody>
	</table>

	<?php

?>