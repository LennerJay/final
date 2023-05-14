//Add to Cart for all Users
function addToCart() {
	let userData = new FormData();
	userData.append("choice", "addToCart");
	let destination = "./Processors/router.php";

	Swal.fire({
		title: '<small>Are you sure you want this product to be added to the cart?</small>',
		showCancelButton: true,
		confirmButtonText: 'Add to Cart'
	}).then((result) => {
		if(result.isConfirmed) {
			passToAjax(destination, userData).then(result => {
				if(result.status == "200") {
					Swal.fire({
						position: "top-center",
						icon: 'success',
		                title: result.message,
		                showConfirmButton: false,
		                timer: 2000
					}).then(() => {
						window.location.href = "./details.php";
					});

				} else {
					Swal.fire({
						icon: 'error',
		                title: '<small>Please Sign-in</small>',
		                text: result.message
					});
				}
			});
		}
	})
	
}//End of addToCart() function

//Ajax Function
const passToAjax = (destination, userData = {}) => {
	let promise = new Promise(function(resolve, reject) {
		$.ajax({
			type: 'POST',
            url: destination,
            data: userData,
            dataType: 'json',
            async: false,
            processData: false,
            contentType: false,
            beforeSend: function() {},
            success: function(userData) {
                resolve(userData)
            },
            error: function(xhr) {

            },
		});
	});

	return promise;

}//End of passToAjax() function