<script>
	$(document).ready(function(){

		load_data(); //Loads data upon page load

		function load_data(query)
		{
			$.ajax({
				url:surl+'home/fetchData', //Function in home controller
				method:"POST",
				data:{query,query},
				success:function(data){
					$('#result').html(data); //Returns html result if successful
				}
			})
		}

		$('#search_text').keyup(function(){ //Runs when text is changed/key press, etc
			var search = $(this).val();
			if (search != '')
			{
				load_data(search);
			} else {
				load_data();
			}
		});
	});
</script>

