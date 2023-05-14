//Purchase for all users
function purchase() {
	let userData = new FormData();
	userData.append("choice", "purchase");
	let destination = "./Processors/router.php";

	Swal.fire({
		title: '<small>Are you sure you want to purchase the product?</small>',
		showCancelButton: true,
		confirmButtonText: 'Purchase'
	}).then((result) => {
		if(result.isConfirmed) {
			sendToAjax(destination, userData).then(result => {
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

}//End of purchase() function

//Ajax Function
const sendToAjax = (destination, userData = {}) => {
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

}//End of sendToAjax() function