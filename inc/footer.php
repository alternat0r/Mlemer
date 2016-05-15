
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



		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>    

      	<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
      	<script src="https://silviomoreto.github.io/bootstrap-select/dist/js/bootstrap-select.min.js"></script>

  		<script>
		$(".popup").delay(4000).slideUp(200, function() {
    		$(this).alert('close');
		});
		</script>


    </script>
