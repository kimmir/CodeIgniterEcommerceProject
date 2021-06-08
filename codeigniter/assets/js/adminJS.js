
$(function () { //Function for deleting a category
	$(document).ready(function(){
		$('.deleteCategory').click(function () {
			//Getting the information from the view
			var id = $(this).data('id');
			var text = $(this).data('text');

			$.ajax({ //Setting the AJAX data to work with
				url : surl+'admin/deleteCategory',
				type : 'POST',
				data : {id : id, text: text},

				success:function (data) { //What happens if the function is successful
					var returnData = JSON.parse(data);

					if (returnData.return == true) { //Deleted successfully -> remove that section of the view
						$('.updateMessage').text(returnData.message);
						$('.updateCatRow'+id).fadeOut();
					} else if (returnData.return == false) { //If unsuccessful -> Return the error
						$('.updateMessage').text(returnData.message);
					} else {
						$('.updateMessage').text("Something broke");
					}
				},
				error:function () { //If something goes wrong

				}
			});
		});
	});

	$(document).ready(function(){
		$('.deleteProduct').click(function(){
			//Getting the information from the view
			var id = $(this).data('id');
			var text = $(this).data('text');

			$.ajax({ //Setting the AJAX data to work with
				url : surl+'admin/deleteProduct',
				type : 'POST',
				data : {id : id, text: text},

				success:function (data) { //What happens if the function is successful
					var returnData = JSON.parse(data);

					if (returnData.return == true) { //Deleted successfully -> remove that section of the view
						$('.updateMessage').text(returnData.message);
						$('.updateProductRow'+id).fadeOut();
					} else if (returnData.return == false) { //If unsuccessful -> Return the error
						$('.updateMessage').text(returnData.message);
					} else {
						$('.updateMessage').text("Something broke");
					}
				},
				error:function () { //If something goes wrong

				}
			});
		});
	});

	$(document).ready(function(){
		$('.deleteModel').click(function(){
			//Getting the information from the view
			var id = $(this).data('id');
			var text = $(this).data('text');

			$.ajax({ //Setting the AJAX data to work with
				url : surl+'admin/deleteModel',
				type : 'POST',
				data : {id : id, text: text},

				success:function (data) { //What happens if the function is successful
					var returnData = JSON.parse(data);

					if (returnData.return == true) { //Deleted successfully -> remove that section of the view
						$('.updateMessage').text(returnData.message);
						$('.updateModelRow'+id).fadeOut();
					} else if (returnData.return == false) { //If unsuccessful -> Return the error
						$('.updateMessage').text(returnData.message);
					} else {
						$('.updateMessage').text("Something broke");
					}
				},
				error:function () { //If something goes wrong

				}
			});
		});
	});
})

