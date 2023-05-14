//Logout
function doLogout() {
	let userData = new FormData()

	Swal.fire({
		title: 'Are you sure you want to logout?',
		showCancelButton: true,
		confirmButtonText: 'Logout'
	}).then((result) => {
		if(result.isConfirmed) {
			Swal.fire({
				position: 'top-center',
                icon: 'success',
                title: result.message,
                showConfirmButton: false,
                timer: 2000
			}).then(() => {
				userData.append('choice', 'logout')
				let destination = "./Processors/router.php";

				$.ajax({
					type: 'POST',
					url: destination,
					data: userData,
					dataType: 'json',
					async: false,
					processData: false,
					contentType: false,
					beforeSend: function() {},
					success: function(result) {
						if (result.status == "200") {
							window.location.href = "./login.php"
						}
					},
					error: function(xhr) {

					},
				});
			});
		}
	})

}//End of doLogout() function


