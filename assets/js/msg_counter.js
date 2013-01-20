//checks the length of the sms being typed
function check_length($element_id)
{
	var smsMsg = document.getElementById($element_id);
	var characters = document.getElementById("characters");
	var sms_used = document.getElementById("sms_used");
	maxLen = 459; // max number of characters allowed
	
	if (smsMsg.value.length > maxLen)
	{
		//alert("working");
	}
	else
	{
		characters.value = maxLen - smsMsg.value.length;
		if (characters.value > 298 && characters.value < 459)
		{
			sms_used.value = 1;
		}
		else if (characters.value > 152  && characters.value < 299 )
		{
			sms_used.value = 2;
		}
		else if (characters.value > -1  && characters.value < 153 )
		{
			sms_used.value = 3;
		}
		else
		{
			sms_used.value = 0;
		}
	}
}