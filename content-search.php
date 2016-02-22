<?php get_header();	?>

	<div class="container">
		<div class="row">
	      	<div class="center-align">
				  	     
				<div class="row">
					<div class="input-field col s12" style="margin-top:150px;">
						<input value="" id="input_search" type="text" class="validate">
						<label class="active" for="input_search">Enter in keys to search</label>
						<a class="waves-effect waves-light btn-large">Search</a>
					</div>
				</div>

				<div class="row">
				 	<ul class="collection" id="cities">
				    </ul>            
				</div>

	      	</div>
		</div>
	</div>

	<!-- Compiled and minified JavaScript -->
	<script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
	<script type="text/javascript">
		$('#input_search').keyup(function(){
			var term = $(this).val();

			if (term.length >= 3)
			{
				findCities(term);
				return;
			}

			return;
		});

		function findCities(term){
			$.ajax({
				url: 'http://www.ciawn.com.br/autocomplete.php?querie=' + term,
				method: 'GET',
				dataType: 'JSON',
				success: function(data){
					html = '';

					for (i in data){
						html += '<li class="collection-item">' + data[i]['location'] + ' - ' + data[i]['slug'] + ' - Population ' + data[i]['population'] + '</li>';
					}

					$('#cities').html(html);
				},
				beforeSend: function(){
					$('#cities').html('<img src="http://downgraf.com/wp-content/uploads/2014/09/01-progress.gif" width="225" />');
				}
			});
		}
	</script>

<?php get_footer(); ?>