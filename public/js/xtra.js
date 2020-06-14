function openTab(event, index)
{
	var i, tabLinks, tabContents;


	tabContents = document.getElementsByClassName('tabContents');
	for(i = 0; i < tabContents.length; i++){
		tabContents[i].style.display = 'none';
	}

	tabLinks = document.getElementsByClassName('tabLinks');
	for(i = 0; i < tabLinks.length; i++){
		tabLinks[i].className = tabLinks[i].className.replace(' active', '');
	}

	document.getElementById(index).style.display = 'block';
	event.currentTarget.className += ' active';
}
	
	document.getElementById('defaultTab').click();