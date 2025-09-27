<script type="text/javascript">

	//******************************************************************************
	//******************************************************************************
	//** 
	//** TEXT KEY RESTRICTION FUNCTIONS
	//** 
	//******************************************************************************
	//******************************************************************************

	function OnKeyPressDigitsSpaceOnly(eventKey)
	{
		if (((eventKey.key < '0') || (eventKey.key > '9')) && (eventKey.key.charCodeAt(0) != 8) && (eventKey.key != ' '))
		{
			eventKey.preventDefault();
		}
	}

	function OnKeyPressDigitsOnly(eventKey)
	{
		if (((eventKey.key < '0') || (eventKey.key > '9')) && (eventKey.key.charCodeAt(0) != 8))
		{
			eventKey.preventDefault();
		}
	}
	
	function OnKeyPressAlphaNumericSpaceOnly(eventKey)
	{
		if (((eventKey.key >= '0') && (eventKey.key <= '9')) || ((eventKey.key >= 'A') && (eventKey.key <= 'Z')) || 
			((eventKey.key >= 'a') && (eventKey.key <= 'z')) || (eventKey.key.charCodeAt(0) == 8) || 
			(eventKey.key == ' '))
		{
		}
		else
		{
			eventKey.preventDefault();
		}
	}

	function OnKeyPressAlphaSpaceOnly(eventKey)
	{
		if (((eventKey.key >= 'A') && (eventKey.key <= 'Z')) || ((eventKey.key >= 'a') && (eventKey.key <= 'z')) || 
			(eventKey.key.charCodeAt(0) == 8) || (eventKey.key == ' '))
		{
		}
		else
		{
			eventKey.preventDefault();
		}
	}

	function OnKeyPressUsername(eventKey)
	{
		if (((eventKey.key >= '0') && (eventKey.key <= '9')) || ((eventKey.key >= 'A') && (eventKey.key <= 'Z')) || 
			((eventKey.key >= 'a') && (eventKey.key <= 'z')) || (eventKey.key.charCodeAt(0) == 8) || (eventKey.key == '_'))
		{
		}
		else
		{
			eventKey.preventDefault();
		}
	}

	function OnKeyPressPassword(eventKey)
	{
		if ((eventKey.key == '\'') || (eventKey.key == '\"'))
		{
			eventKey.preventDefault();
		}
	}

	function OnKeyPressEmailAddress(eventKey)
	{
		if (((eventKey.key >= '0') && (eventKey.key <= '9')) || ((eventKey.key >= 'A') && (eventKey.key <= 'Z')) || 
			((eventKey.key >= 'a') && (eventKey.key <= 'z')) ||(eventKey.key.charCodeAt(0) == 8) || (eventKey.key == ' ') ||
			(eventKey.key == 64) || (eventKey.key == 45) || (eventKey.key == 46) || (eventKey.key == '_'))
		{
		}
		else
		{
			eventKey.preventDefault();
		}
	}

	function OnKeyPressName(eventKey)
	{
		if (((eventKey.key >= '0') && (eventKey.key <= '9')) || ((eventKey.key >= 'A') && (eventKey.key <= 'Z')) || 
			((eventKey.key >= 'a') && (eventKey.key <= 'z')) ||(eventKey.key.charCodeAt(0) == 8) || (eventKey.key == ' ') ||
			(eventKey.key == 45) || (eventKey.key == 39))
		{
		}
		else
		{
			eventKey.preventDefault();
		}
	}

	function OnKeyPressPhone(eventKey)
	{
		if (((eventKey.key < '0') || (eventKey.key > '9')) && (eventKey.key.charCodeAt(0) != 8) && (eventKey.key != ' '))
		{
			eventKey.preventDefault();
		}
	}

</script>
