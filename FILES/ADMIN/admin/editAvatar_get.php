<?php

require_once('connections/db_connection.php');

mysql_select_db($database, $connect);
mysql_query("SET NAMES 'utf8'");

if (isset($_POST["search_string"]))
{
	//start transaction
	mysql_query("SET AUTOCOMMIT=0;");
	mysql_query("START TRANSACTION;");

	$username = mysql_real_escape_string(trim($_POST["search_string"]));

	$get_users = mysql_query("SELECT u.id AS id, u.name AS name, u.surname AS surname, st.name AS status, u.location AS location,
	             u.nickname AS username, u.avatar AS avatar FROM users u, status_table st
	             WHERE u.status=st.id AND u.status!=9 AND u.user_type=1 AND u.username LIKE '%$username%';");

	$count_users = mysql_num_rows($get_users);

	//commit transaction
	mysql_query("COMMIT;");

	if ($count_users > 0)
	{ ?>
		
		<table class="table">
			<thead>
				<tr>
					<th class="small1">Avatar</th>
					<th>Removed By Admin</th>
					<th>Nickname</th>
					<th>Removed By Admin</th>
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
						<td>
							<input type="checkbox" name="path[]" id="<?php echo $get_users2['id']; ?>"
								 value="<?php echo $get_users2['id']; ?>">>
						</td>
						<td><?php echo $get_users2['username']; ?></td>
						<td>
							<input type="checkbox" name="user[]" id="<?php echo $get_users2['id']; ?>"
								 value="<?php echo $get_users2['id']; ?>">
						</td>
					</tr>
				
				<?php

				}

				?>	
			
			</tbody>
		</table>

		<?php

	}
	else
	{
		echo "No username like '".$username."'";	
	}

}
else
{
	//start transaction
	mysql_query("SET AUTOCOMMIT=0;");
	mysql_query("START TRANSACTION;");

	$get_users = mysql_query("SELECT u.id AS id, u.name AS name, u.surname AS surname, st.name AS status, u.location AS location,
             u.nickname AS username, u.avatar AS avatar FROM users u, status_table st
             WHERE u.status=st.id AND u.status!=9 AND u.user_type=1;");

	//commit transaction
	mysql_query("COMMIT;");

	?>

	<table class="table">
		<thead>
			<tr>
				<th class="small1">Avatar</th>
				<th>Removed By Admin</th>
				<th>Nickname</th>
				<th>Removed By Admin</th>
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
					<td>
						<input type="checkbox" name="path[]" id="<?php echo $get_users2['id']; ?>"
								 value="<?php echo $get_users2['id']; ?>">
					</td>
					<td><?php echo $get_users2['username']; ?></td>
					<td>
						<input type="checkbox" name="user[]" id="<?php echo $get_users2['id']; ?>"
								 value="<?php echo $get_users2['id']; ?>">
					</td>
				</tr>
			
			<?php

			}

			?>	
		
		</tbody>
	</table>

	<?php
}

?>