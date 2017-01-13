var xhrSearch = null;
var xhrLoadUserData = null;
function searchUsers() {
	// $('form#search-form #search-results').empty();
	if(xhrSearch){
		xhrSearch.abort();
	}

	var val = $('form#search-form input').val();
	if(val == ''){
		return false;
	}

	xhrSearch = $.post('/search/search-form', {q: val})
		.done(function(data) {
			var res = JSON.parse(data);
			if(res.error){
				$('form#search-form #search-results').text(':(').show();
			}else if (res.ok && res.results) {
				var html = '';
				$.each(res.results, function(k, v){
					var avatar = !v.image ? 'images/default.png' : v.image;
					html += '<div class="person" data-uid="'+v.id+'" data-toggle="modal" data-target="#preview-user" data-id="'+k+'">'
								+'<a href="/u/'+v.id+'">'
									+'<div class="image"><img src="'+avatar+'"></div>'
									+'<cite>'+v.first_name+' '+v.last_name+'</cite>'
								+'</a>'
							+'</div>';
				});
				$('form#search-form #search-results').html(html).show();
                updateUserButton();
			}
		});
}

function loadUsersData(val) {
	// $('form#search-form #search-results').empty();

	if(xhrLoadUserData){
		xhrLoadUserData.abort();
	}
	xhrLoadUserData = $.post('/search/load-user-data', {uid: val})
		.done(function(data) {
			var res = JSON.parse(data);
			if(res.error){
				$('#preview-user .modal-body .row.preview').text(':(').show();
			}else if (res.ok && res.results) {
				var avatar = !res.results.image ? 'images/default.png' : res.results.image;
				var html = '<div class="user-preview">'
							+'<div class="image"><img src="'+avatar+'"></div>'
							+'<cite>'+res.results.first_name+' '+res.results.last_name+'</cite>'
							+'</div>';
				$('#preview-user .modal-body .row.preview').html(html).show();
                $('#preview-user .modal-body i.fa-spin').hide();
			}
		});
}
function updateUserButton() {
	$('.person a').click(function (e) {
		e.preventDefault();
        $('#preview-user .modal-body i.fa-spin').show();
        $('#preview-user .modal-body .row.preview').hide();
        loadUsersData( $(this).parent().data('uid') )
    });
	$('.person').hover(function () {
		$('.person').removeClass('selected');
        $(this).addClass('selected');
    }, function(){
		$(this).removeClass('selected');
	});
}
function selectNext(){
	if($('#search-results .person.selected').length == 0){
		$('#search-results .person').first().addClass('selected');
	}else{
		var id= parseInt($('#search-results .person.selected').data('id'));
		id++;
		var nextElement = $('#search-results .person[data-id='+id+']').length == 1 ? $('#search-results .person[data-id='+id+']') :  $('#search-results .person').first();
		$('#search-results .person').removeClass('selected');
		$(nextElement).addClass('selected')
	}
}
function selectPrevious(){
	if($('#search-results .person.selected').length == 0){
		$('#search-results .person').last().addClass('selected');
	}else{
		var id= parseInt($('#search-results .person.selected').data('id'));
		id--;
		var nextElement = $('#search-results .person[data-id='+id+']').length == 1 ? $('#search-results .person[data-id='+id+']') :  $('#search-results .person').last();
		$('#search-results .person').removeClass('selected');
		$(nextElement).addClass('selected')
	}
}
$(document).ready(function(){
	$('form#search-form input')
		.keyup(function(e){
			if([37, 38, 39, 40].indexOf(e.keyCode) === -1){
				searchUsers();
			}
		})
		.keydown(function(e){
			switch (e.keyCode) {
				case 40:
					e.preventDefault();
					selectNext();
					break;
				case 38:
					e.preventDefault();
					selectPrevious();
					break;
				case 13:
					e.preventDefault();
					$('#search-results .person.selected a').click();
					break;
			}
		})
        .blur(function(){
			if($('.person a:hover').length == 0)
				$('form#search-form #search-results').hide().empty()
		});
})
