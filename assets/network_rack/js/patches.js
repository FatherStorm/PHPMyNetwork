$(document).ready(function () {
	$(document).delegate('.toggleDetails','click',function(){
		$('.printable').toggleClass('printable_hidden');
	});

	$(document).delegate('.unassigned', 'click', function () {
		$('#assign').dialog({width: 500, height: 300, title: 'Assign'});
		$('#device1').val($(this).data('device'));
		resetPorts('#port1', $(this).data('ports'), $(this).data('port'));
		resetPortTypes('#side1', $(this).data('port_type'));

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
			}).promise().done(function () {
				var input1 = $("<input type='hidden' name='device[]' value='" + $(target).data('device') + "'>");
				$(form).append($(input1));
				console.log($(input1));
				var input2 = $("<input type='hidden' name='port[]' value='" + $(target).data('port') + "'>");
				$(form).append($(input2));
				$(form).append("<input type='submit'  class='disassociate_btn' name='side' value='All'>")
				$(form).append("<input type='submit'  class='disassociate_btn' name='side' value='Front'>")
				$(form).append("<input type='submit'  class='disassociate_btn' name='side' value='Back'>")
				$(fieldset).append($(form));
				$('#disassociate').find('.associations').prepend($(fieldset));
			});
		});
		$("#disassociate").dialog({
			width: 800,
			title: 'Info / Unplug Cables',
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


	$(document).delegate('.savePatch', 'click', function () {
		$('#assign_status').empty().removeClass('ui-state-error');
		$.getJSON('/main/add_patch', {
			'device 1': $('#device1').find('option:selected').val(),
			'device 2': $('#device2').find('option:selected').val(),
			'port 1': $('#port1').find('option:selected').val(),
			'port 2': $('#port2').find('option:selected').val(),
			'side 1': $('#side1').find('option:selected').val(),
			'side 2': $('#side2').find('option:selected').val(),
		}, function (data) {
			if (data.status != true) {
				$('#assign_status').html(data.message).addClass('ui-state-error');
			} else {
				location.reload();
			}

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
					$.getJSON('/main/reorder', {order: order}, function (data) {
					});
				});
				// join the array as single variable...

				//use the variable as you need!
			}
		});
		$("#sortable").disableSelection();
	});


});

var resetPortTypes = function(target, portType){

	$(target).empty().promise().done(function () {
		if (portType == 'WirelessOnly') {
			alert('You cannot patch to a Wireless Only device');
		}else{

		var html=$('#ports_'+portType).html();
		$(target).append($(html));

		}

	});

}

var resetPorts = function (target, ports, set) {
	$(target).empty().promise().done(function () {
		for (x = 1; x <= ports; x++) {
			if (set == x) {
				var s = "selected";
			} else {
				var s = "";
			}
			var option = "<option value='" + x + "' " + s + ">" + x + "</option>";


			$(target).append($(option));
		}
	});
}