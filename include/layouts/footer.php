<div id="footer">
			CopyRight <?php echo date('Y'); ?> , Widget corp
		</div>
	</body>
</html>
<?php
//5. close db connection
// to check and see we connect or not for good practices
if(isset ($connection)){
	mysqli_close($connection);
}
?>
