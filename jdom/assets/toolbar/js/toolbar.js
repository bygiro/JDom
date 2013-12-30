jQuery(document).ready(function(){
	jQuery("#adminForm").validationEngine();
});

Joomla.submitform = function(pressbutton, form)
{
	if (typeof form === 'undefined'){
		form = jQuery('#adminForm');
	} else if(!(form instanceof jQuery)){
		form = jQuery(form);
	}

	//Unlock the page
	holdForm = false;

	if (typeof(pressbutton) == 'undefined')
	{
		form.submit();
		return;
	}	
	var parts = pressbutton.split('.');

	form.find("#task").val(pressbutton);
	switch(parts[parts.length-1])
	{
		case 'save':
		case 'save2copy':
		case 'save2new':
		case 'apply':
			//Call the validator
			break;

		default:
			form.validationEngine('detach');
			break;
	}

	form.submit();
}


Joomla.submitformAjax = function(task, form)
{
	if (typeof form === 'undefined'){
		form = jQuery('#adminForm');
	} else if(!(form instanceof jQuery)){
		form = jQuery(form);
	}
	
	var taskName = '';
	if (typeof(task) !== 'undefined' && task !== '')
	{		
		form.task.value = task;
		var parts = task.split('.');
		taskName = parts[parts.length-1];	
		form.find('.cktoolbar span.' + taskName).addClass('spinner');
	}
	else
		//Not ajax when controller task is empty (ex: filters, search, ...)
		return Joomla.submitform();

	//Ajax query only when a task is performed
	jQuery.post("index.php?return=json", jQuery(form).serialize(), function(response)
	{
		response = jQuery.parseJSON(response);
		if (response.transaction.result)
		{
			switch(taskName)
			{
				case 'save':
				case 'save2copy':
				case 'save2new':
				case 'apply':
				case 'delete':
				case 'publish':
				case 'unpublish':
				case 'trash':
				case 'archive':
					//Reload parent page only if needed
					parent.holdForm = false;
					parent.location.reload(false);
	
					//Close modal
					parent.SqueezeBox.close();
							
					break;
				
				case 'cancel':
					//Close modal
					parent.SqueezeBox.close();				
					break;
				
				default:
					//Keep modal opened
					break;
			}
			
		}
		else
		{
			var msg = response.transaction.rawExceptions;
			if (msg.trim() == '')
				msg = 'Unknown error';
	
			alert(msg);
		}
	});		


};