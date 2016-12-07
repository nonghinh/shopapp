/*
*
*/
function confirmDelete () {
	if(confirm("Are you sure want to delete this item?")) 
		return true;
	return false;
}

$('.alert-delay').delay(3000).slideUp();