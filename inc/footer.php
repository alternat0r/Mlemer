
		<br/>
		<br/>
      <footer class="footer">    
		<div class="row">
				<div class="col-md-6">
			   <p>&copy; <?php echo date("Y"); ?> &middot; <?php echo GetCompanyName(); ?></p>
		    </div>
		    <div class="col-md-6 text-right">
				<?php
		    	echo('<div class="text-right">Page generated in '.round((explode(' ', microtime())[0] + explode(' ', microtime())[1]) - $start, 4).' seconds.</div>');
		    ?>
			</div>
		</div>
      </footer>