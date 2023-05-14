//User Messages
function message() {
	let userData = new FormData();
	userData.append("choice", "message");
	let destination = "./Processors/router.php";

	Swal.fire({
		title: '<small>Are you sure you want to message the Administrator?</small>',
		showCancelButton: true,
		confirmButtonText: 'Message'
	}).then((result) => {
		if(result.isConfirmed) {
			proceedToAjax(destination, userData).then(result => {
				if(result.status == "200") {
					Swal.fire({
						position: "top-center",
						icon: 'success',
		                title: result.message,
		                showConfirmButton: false,
		                timer: 2000
					}).then(() => {
						window.location.href = "./chatbox.php";
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

}//End of message() function

//Ajax Function
const proceedToAjax = (destination, userData = {}) => {
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

}//End of proceedToAjax() function