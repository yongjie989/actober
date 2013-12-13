var max_upload_file = 5;
var now_upload_file_count = 1;
var painterid;
var check_upload_timer;
var custom_upload_complete = 0;
var date = new Date();
painterid = date.getTime();

$(function() {
	$( "#actober_tools" ).accordion();
	get_tshirt_color('1','1');
	return false;
});

function get_tshirt_color(userid, productid){
	$.getJSON('webapi.php',{'act':'get_tshirt_color','userid':userid,'productid':productid}, function(data){
		if(data){
			$("#color_list").html('');		
			$.each(data, function(k,v){
				$("#color_list").append('<span style="background-color:'+v.color+'">'+v.number+'</span>');
			});
		}
	});
	return false;
};

function add_more_upload_field(){	
	if(now_upload_file_count < max_upload_file){
		var more_field = '<div><input type="file" id="custom_upload_files_'+now_upload_file_count+'" name="custom_upload_files_'+now_upload_file_count+'" /></div>';
		$("#custom_upload_file_list").append(more_field);
	};
	now_upload_file_count++;
	return false;
};

function close_upload_image_windows(){
	$("#upload_image_window").hide();
	return false;
};

function open_upload_image_windows(){
	$("#upload_image_window").show();
	return false;
};

function process_custom_upload(){
	$("#loading").show();
	$("input[name*='custom_upload']").each(function(k){
		$.ajaxFileUpload({
			url:'webapi.php',
			secureuri:false,
			fileElementId: $(this).attr('id'),
			dataType: 'json',
			data:{act:'process_custom_upload', userid:'1', productid:'1',painterid:painterid},
			success: function (data, status){
				if(typeof(data.error) != 'undefined'){
					if(data.error != ''){
						alert(data.error);
					}else{
						console.log(data.msg);
						custom_upload_complete++;
					};
				};
			},
			error: function (data, status, e){
				alert(e);
			}
		});
	});

	check_custom_upload(30);	
	return false;
};

function check_custom_upload(numberCount){
	for (var i = 1; i < numberCount; i++) {
		createTimer(i);
    };
	return false;
};

function createTimer(count){
	check_upload_timer = setTimeout(function() {
        //console.log(count.toString());
		//console.log(custom_upload_complete);
		if(now_upload_file_count == custom_upload_complete){
			$("#loading").hide();
			close_upload_image_windows()
		};
    }, 2000 * count)
	return false;
};

function open_custom_upload_button(){
	open_upload_image_windows();
	return false;
};

function open_page(page){
	if(page != undefined){
		window.location.href='actober_core.php?page='+page;
	};
	return false;
};