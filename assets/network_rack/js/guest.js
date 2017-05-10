$(document).ready(function () {
	$(document).delegate('.toggleDetails','click',function(){
		$('.printable').toggleClass('printable_hidden');
	});

	$(document).delegate('.highlight:not(.unassigned)', 'click', function () {
		var text = "";
		var target = $(this);
		$('#disassociate').find('.associations').empty().promise().done(function () {
			var form = $("<form method='get' action='/main/disassociate'>");
			var fieldset = $("<fieldset class='disassociate_form col-lg-4 col-sm-12'><h3>-Disconnect-</h3></fieldset>");
			$('.highlight').each(function (idx, item) {
				var li = $("<li><pre></pre></li>");
				$(li).addClass('col-lg-8');
				$(li).addClass('col-sm-12');
				$(li).data('associated_item', $(item).attr('id'));
				$(li).find("pre").html($(item).attr('title'));
				$('#disassociate').find('.associations').append($(li));
			})
		});
		$("#disassociate").dialog({
			width: 800,
			title: 'Info ',
			dialogClass: "no-close",
			buttons: [
				{
					text: "Close",
					click: function () {
						$(this).dialog("close");
					}
				}

			]
		});

	})
	$(document).delegate('.port', 'mouseover', function () {
		var target = $(this);
		$('.port').removeClass('highlight').promise().done(function () {
			$(target).addClass('highlight');
			$($(target).data('target_front')).addClass('highlight');
			$($(target).data('target_back')).addClass('highlight');
		});
	});



	$(function () {
		$("#sortable").sortable({
			update: function (event, ui) {
				var order = [];
				$('#sortable li').each(function (e) {

					//add each li position to the array...
					// the +1 is for make it start from 1 instead of 0
					order.push($(this).data('id'));
				}).promise().done(function () {

				});
				// join the array as single variable...

				//use the variable as you need!
			}
		});
		$("#sortable").disableSelection();
	});


});
