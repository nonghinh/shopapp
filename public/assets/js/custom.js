$(".button-collapse").sideNav();
$(".button-collapse-r").sideNav({
  	menuWidth: 300, // Default is 240
  	edge: 'right', // Choose the horizontal origin
  	closeOnClick: true, // Closes side-nav on <a> clicks, useful for Angular/Meteor
  	draggable: true // Choose whether you can drag to open on touch screens
});

 $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
  });
$('.dropdown-button').dropdown();
$('.modal').modal();
$('select').material_select();
$('.materialboxed').materialbox();
$('.collapsible').collapsible();

/*== Edit profile====*/
var profile = $('#editProfile');
var fEditProfile = $('#fEditProfile .groupProfile');
$('#edit-account').click(function(event) {
	var html = "";
	html += '<strong>Tài khoản hiện tại:</strong> <span>'+$(this).parent().find('.account').html()+'</span>';
	html += '<div class="input-field">';
	html += '<label>Nhập tên tài khoản mới</label>';
	html += '<input type="text" name="account">';
	html += '</div>';
	html += '<button type="button" id="editAccBtn" class="btn">Xong</button>';
	fEditProfile.html(html);
	profile.modal('open');
});

$('#edit-email').click(function(event) {
	var html = "";
	html += '<h4>Đổi email</h4>';
	html += '<strong>Email hiện tại:</strong> <span>'+$(this).parent().find('.email').html()+'</span>';
	html += '<div class="input-field">';
	html += '<label>Nhập email mới</label>';
	html += '<input type="email" name="email">';
	html += '</div>';
	html += '<button type="button" id="editEmailBtn" class="btn">Xong</button>';
	fEditProfile.html(html);
	profile.modal('open');
});

$('#edit-password').click(function(event) {
	var html = "";
	html += '<h4>Đổi mật khẩu</h4>';
	html += '<div class="input-field">';
	html += '<label>Nhập mật khẩu hiện tại</label>';
	html += '<input type="password" name="oldpassword">';
	html += '</div>';
	html += '<div class="input-field">';
	html += '<label>Nhập mật khẩu mới</label>';
	html += '<input type="password" name="newpassword">';
	html += '</div>';
	html += '<div class="input-field">';
	html += '<label>Nhập lại mật khẩu mới</label>';
	html += '<input type="password" name="renewpassword">';
	html += '</div>';
	html += '<button type="button" id="editPasswordBtn" class="btn">Xong</button>';
	fEditProfile.html(html);
	profile.modal('open');
});

/*----- AJAX ----*/
var fProfile = $('#fEditProfile');
//Account update
fProfile.on('click', '#editAccBtn', function(event) {
	var url = _dir+'/userprofile/updateAccount';
	var _token = fProfile.find('input[name="_token"]').val();
	var newname = fProfile.find('input[name="account"]').val();
	if(newname != ""){
		$.get(url, {'username': newname}, function(result){
			if(result == 'success'){
				$('.userInfo .account').html(newname);
				profile.modal('close');
				alert('Cập nhật xong.');
			}
			else
				alert('Tên tài khoản đã tồn tại');
		});
	}
	else{
		alert('Không được để trống tên tài khoản');
	}
});
 
 //Email update
 fProfile.on('click', '#editEmailBtn', function(event) {
	var url = _dir+'/userprofile/updateEmail';
	var _token = fProfile.find('input[name="_token"]').val();
	var newemail = fProfile.find('input[name="email"]').val();
	if(newemail != ""){
		if(validateEmail(newemail)){
			$.get(url, {'email': newemail}, function(result){
				if(result == 'success'){
					$('.userInfo .email').html(newemail);
					profile.modal('close');
					alert('Cập nhật xong.');
				}

				if(result == 'notEmail'){
					alert('Email sai định dạng');
				}
				else
					alert('Email này đã tồn tại');
			});
		}
		else
			alert('Email sai định dạng');
	}
	else{
		alert('Không được để trống email');
	}
});

 //Password update

fProfile.on('click', '#editPasswordBtn', function(event) {
	var url = _dir+'/userprofile/updatePassword';
	var _token = fProfile.find('input[name="_token"]').val();
	var oldpass = fProfile.find('input[name="oldpassword"]').val();
	var newpass = fProfile.find('input[name="newpassword"]').val();
	var repass = fProfile.find('input[name="renewpassword"]').val();
	if(oldpass != "" && newpass != "" && repass != ""){
		data = {
			'oldpass': oldpass,
			'newpass': newpass,
			'repass': repass,
			'_token': _token
		};

		$.get(url, data, function(result){
			if(result == 'success'){
				profile.modal('close');
				alert('Cập nhật xong.');
			}
			if(result == 'wrongpass'){
				alert('Bạn đã nhập sai mật khẩu');
			}
			if(result == 'tooshort'){
				alert('Mật khẩu quá ngắn');
			}
			if(result == 'notmath'){
				alert('Xác nhận sai mật khẩu mới');
			}
		});
	}
	else{
		alert('Không được để trống mật khẩu');
	}
});

 function validateEmail(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}
/*== END Edit profile====*/

function confirmDelete(){
	if(confirm('Bạn chắc chắn muốn xóa?')){
		return true;
	}
	return false;
}

/*======= SEARCH AJAX=============*/
$('#inputSearch').keyup(function(event) {
	if($(this).val() != ""){
		var _token = $(this).parent().find('input[name="_token"]').val();
		var url = _dir+'/search';
		var data = $(this).val();
		$.get(url, {'_token': _token, 'query': data}, function(res){
			$('#resultSearch').html(res);
		});
	}
});
/*======= END SEARCH AJAX=============*/

