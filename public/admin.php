<?php
// include once tym
require_once("../include/functions.php"); ?>
	<?php include("../include/layouts/header.php"); ?>
	<div id="main">
		<div id="navigation">
			&nbsp;
		</div>
		<div id="page">
			<h2>Admin Menu</h2>
			<p>Welcome To he Admin Area</p>
			<ul>
				<li><a href="manage_content.php">Manage Website Content</a></li>
				<li><a href="manage_admin.php">
						Manage Admin Users
					</a></li>
				<li>
					<a href="logout.php">Logout</a>
				</li>
			</ul>
		</div>
	</div>
	<?php include("../include/layouts/footer.php"); ?>