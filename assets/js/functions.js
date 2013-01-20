// mobile no. availability
function validateMobile(str)
{
	if (str=="")
	  {
	  document.getElementById("yourmobileInfo").innerHTML="";
	  return;
	  } 
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    {
	    document.getElementById("yourmobileInfo").innerHTML=xmlhttp.responseText;
	    }
	  }
	xmlhttp.open("GET","/psms/include/validate.php?mobile="+str,true);
	xmlhttp.send();
}

// Date and Time --------------------------------------------------------------------------------------------------------------------------------
function date_time(id)
{
        date = new Date;
        year = date.getFullYear();
        month = date.getMonth();
        months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        d = date.getDate();
        day = date.getDay();
        days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
        h = date.getHours();
        if(h<10)
        {
            h = "0"+h;
        }
        m = date.getMinutes();
        if(m<10)
        {
            m = "0"+m;
        }
        s = date.getSeconds();
        if(s<10)
        {
            s = "0"+s;
        }
        result = ''+days[day]+', '+months[month]+' '+d+', '+year+' '+h+':'+m+':'+s;
        document.getElementById(id).innerHTML = result;
        setTimeout('date_time("'+id+'");','1000');
        return true;
}

//Phonebook ------------------------------------------------------------------------------------------------------------------
var DEFAULT_TO_VALUE = '';
function onCheckAllClick(chk, type) {
    //var i;
    if(document.getElementById("CheckAll").checked == true)
    {
    	for (i = 0; i < chk.length; i++) {
	        //checks if checkbox is false
	        if (chk[i].checked == false){
	        	chk[i].checked = true;
	            if (type == 'clients' || type == 'contacts') {
	            //if (type == 'contacts') {
	                selectContact(chk[i]);
	            }
	        }
	    }
    }
    else{
    	for (i = 0; i < chk.length; i++) {
	        chk[i].checked = false;
	        if (chk.id != true){
	            if (type == 'clients' || type == 'contacts') {
	            //if (type == 'contacts') {
	                selectContact(chk[i]);
	            }
	        }
	    }
    }
    //updateRecieversCount();
}

function onSelectContact(el) {
    selectContact(el);
    onDeselect();
    return;
}

function selectContact(el){
    var elSel = document.getElementById('inpSelectedContacts');
    var elTo = document.getElementById('sms_to');
    var values;
    if (elSel.value.length) {
        values = elSel.value.split(',');
    } else {
        values = [];
    }
    var i, inx = -1;
    for (i = 0; i < values.length; i++) {
        if (values[i] == el.value) {
            inx = i;
            break;
        }
    }
    
    if (el.checked) {
        if (inx == -1) {
            values.push(el.value);
            if (elTo.value == DEFAULT_TO_VALUE) {
                elTo.value = '';
            }
            while (elTo.value.substr(elTo.value.length - 1, 1) == ' ') {
                elTo.value = elTo.value.substr(0, elTo.value.length - 1);
            }
            if (elTo.value.length > 0) {
                if (elTo.value.substr(elTo.value.length - 1, 1) != ',') {
                    elTo.value += ',';
                }
                elTo.value += '';
            }
            elTo.value += el.getAttribute('mobile_no');
            //need for auto field, deselect operation
            if (typeof(autoCompleteIndexesContacts) !== 'undefined') {
                autoCompleteIndexesContacts[el.value] = el.getAttribute('mobile_no');
                lastWord = el.getAttribute('mobile_no');
            }
            //end autocomplete
        }
    } else {
        if (inx >= 0) {
            values.splice(i, 1);
        }
        var mobile_no = el.getAttribute('mobile_no');
        while (mobile_no.substr(mobile_no.length - 1, 1) == ' ') {
            mobile_no = mobile_no.substr(0, mobile_no.length - 1);
        }
        //var tmp = mobile_no; //search mobile no. to remove
        var tmp = ',' + mobile_no;
        var re = new RegExp(tmp, '');
        
        var match = elTo.value.match(re);
        if(match)
        {
        	elTo.value = elTo.value.replace(re,'');
        }
        //
        var tmp = mobile_no + ',';
        var re = new RegExp(tmp, '');
        
        var match = elTo.value.match(re);
        if(match){
        	elTo.value = elTo.value.replace(re,'');
        }
	    //
	    var tmp = mobile_no;
        var re = new RegExp(tmp, '');
        
        var match = elTo.value.match(re);
        if(match){
        	elTo.value = elTo.value.replace(re,'');
        }
        
        while (elTo.value.substr(elTo.value.length - 1, 1) == ' ') {
            elTo.value = elTo.value.substr(0, elTo.value.length - 1);
        }
        if (elTo.value == '') {
            elTo.value = DEFAULT_TO_VALUE;
        }
    }
    elSel.value = values.join(',');
}

function onDeselect() {
    //checks if CheckAll is selected and de-select it
    var CheckAll = document.getElementById("CheckAll");
    if(CheckAll.checked == true){
    	CheckAll.checked = false;
    }
}

function ajax_search(srh_term){ 
  $("#search_results").show(); 
  var search_val = srh_term;
  //post the request
  $.post("../include/find.php?search_term="+search_val, function(data){
   if (data.length>0){ 
     $("#search_results").html(data); 
   } 
  }) 
}

function ajax_contact(srh_term){ 
  $("#search_results").show(); 
  var search_val = srh_term;
  //post the request
  $.post("../include/find_contact.php?search_term="+search_val, function(data){
   if (data.length>0){ 
     $("#search_results").html(data); 
   } 
  }) 
}

function checkAll(chk) {
     var CheckAll = document.getElementById("CheckAll");
     if(CheckAll.checked == true){
    	for (i = 0; i < chk.length; i++) {
    		if (chk[i].checked == false){
	        	chk[i].checked = true;
	        }
    	}
    }else{
    	for (i = 0; i < chk.length; i++) {
    		if (chk[i].checked == true){
	        	chk[i].checked = false;
	        }
    	}
    }
}

//Deleting contact info------------------------------------------------------------------------------------------------------------------------
function MsgOkCancel(chk) 
{ 
	var fRet; 
	fRet = confirm('Are you sure you want to delete?'); 
	 
	if(fRet == true)
	{
		for (i = 0; i < chk.length; i++) {
    		if (chk[i].checked == true){
	        	//delete selected item
	        	var del_Contact = chk[i].value;
	        	ajax_deleContact(del_Contact);
	        }
    	}
    	onDeselect();//deselect the checkall
	}
} 

function ajax_deleContact(srh_term){ 
  var search_val = srh_term;
  //post the request
  $.post("../include/del_contact.php?search_term="+search_val, function(data){
   if (data.length>0){ 
    ajax_contact('');
   } 
  }) 
}

//Adding contact info---------------------------------------------------------------------------------------------------------------------------------
function saveContact(){
	var fname = document.getElementById("fname");
	var lname = document.getElementById("lname");
	var mob = document.getElementById("mob");
	
	//check fname length
	if(fname.value.length <= 0)
	{
		$("#fnameInfo").html("<p style='color: red;'>*</p>");
	}else{
		$("#fnameInfo").html("");
	}
	//check lname length
	if(lname.value.length <= 0)
	{
		$("#lnameInfo").html("<p style='color: red;'>*</p>");
	}else{
		$("#lnameInfo").html("");
	}
	
	//
	if(fname.value != 0 && lname.value != 0 && mob.value.length == 11){
		var fullname = fname.value + " " + lname.value;
		var mobile_no = mob.value;
		//insert data into db
		$.post("../include/add_contact.php?name="+fullname+"&mob="+mobile_no);
		//clear the fields
		fname.value = "";
		lname.value = "";
		mob.value = "";
		//alert of success
		alert("Contact added...");
	}else{
		alert("All fields are required");
	}
}

function validateMob(mob){
	var a = mob.value;
	var filter = /^([1-9]{1})([0-9]{10})$/;
	//if it's valid email
	if(filter.test(a)){
		$("#mobInfo").html("Valid mobile no.");
		return true;
	}
	//if it's NOT valid
	else{
		$("#mobInfo").html("<p style='color: red;'>Stop cowboy! Type a mobile no. please :P<br />eg. 60111111111</p>");
		return false;
	}
}

//save message---------------------------------------------------------------------------------------------------------------------------
function saveMsg(){
	var message = document.getElementById("save_msg");
	var mob = document.getElementById("save_numbers");
	var send_date = document.getElementById("send_date");
	
	//
	if(message.value != 0 && send_date.value != 0 && mob.value.length >= 10){
		var mobile_no = mob.value;
		//insert data into db
		$.post("../include/save_msg.php?msg="+message.value+"&mob="+mobile_no+"&s_dt="+send_date.value);
		//alert(message.value + "-" + mobile_no + "-" + send_date.value);
		
		//clear the fields
		message.value = "";
		mob.value = "";
		
		//gets and set current date
		var currentTime = new Date();
		var month = currentTime.getMonth() +1;
		var day = currentTime.getDate();
		var year = currentTime.getFullYear();
		var hour = currentTime.getHours();
		var minutes = currentTime.getMinutes();
		if(hour<10)
        {
            hour = "0" + hour;
        }
        
        if(minutes<10)
        {
            minutes = "0" + minutes;
        }
        
        if(day<10)
        {
        	day = "0" + day;
        }
        
        if(month<10)
        {
        	month = "0" + month;
        }
        
		send_date.value = day + "-" + month + "-" + year + " " + hour + ":" + minutes; //day-month-year hour:minutes
		
		//alert of success
		alert("Message saved...");
	}else{
		alert("All fields are required");
	}
}
//view scheduled msg
function view_schedule(){ 
  //post the request
  $.post("../include/view_scheduled.php", function(data){
   if (data.length>0){ 
     $("#search_results").html(data); 
   } 
  }) 
}
// delete scheduled msg
function del_scheduled(chk) 
{ 
	var fRet; 
	fRet = confirm('Are you sure you want to delete?'); 
	 
	if(fRet == true)
	{
		for (i = 0; i < chk.length; i++) {
    		if (chk[i].checked == true){
	        	//delete selected item
	        	var del_msg = chk[i].value;
	        	ajax_deleScheduled(del_msg);
	        }
    	}
    	onDeselect();//deselect the checkall
	}
}

function ajax_deleScheduled(srh_term){ 
  var search_val = srh_term;
  //post the request
  $.post("../include/del_scheduled.php?search_term="+search_val, function(data){
   if (data.length>0){ 
     view_schedule(); 
   } 
  }) 
}
//register new user/member--------------------------------------------------------------------------------------------------------------
function new_users(){ 
	var your_mobile = document.getElementById("your_mobile");
	var yourpass = document.getElementById("yourpass");
	var yourpass1 = document.getElementById("yourpass1");
	var yourfname = document.getElementById("yourfname");
	var yourlname = document.getElementById("yourlname");
	var mail_address = document.getElementById("mail_address");
	var your_city = document.getElementById("your_city");
	var your_postal = document.getElementById("your_postal");
	var your_country = document.getElementById("your_country");
	
   	if(your_mobile.value.length == 11 & yourpass.value.length > 4 & yourpass1.value == yourpass.value & yourfname.value.length > 1 & yourlname.value.length > 1 & mail_address.value.length > 9 & your_postal.value.length > 4){
   		//post the request
	  $.post("include/register.php?your_mobile=" + your_mobile.value + "&yourpass=" + yourpass.value + "&yourpass1=" + yourpass1.value + "&yourfname=" + yourfname.value + "&yourlname=" + yourlname.value + "&mail_address=" + mail_address.value + "&your_city=" + your_city.value + "&your_postal=" + your_postal.value + "&your_country=" + your_country.value, function(data){
	   if (data.length>0){ 
	     $("#register_error").html(data);
	     
	     //reset the fields
	     document.getElementById('reset').click();
	   }else{
	   	$("#register_error").html('<p style="color:red;">Sorry, that mobile no. already exists. Please try a different mobile no.</p>');
	   } 
	  })
   	}
}
//sent msg---------------------------------------------------------------------------------------------------------------------------------
//view sent msg
function view_sent(){ 
  //post the request
  $.post("../include/view_sent.php", function(data){
   if (data.length>0){ 
     $("#search_results").html(data); 
   } 
  }) 
}
// delete scheduled msg
function del_sent(chk) 
{ 
	var fRet; 
	fRet = confirm('Are you sure you want to delete?'); 
	 
	if(fRet == true)
	{
		for (i = 0; i < chk.length; i++) {
    		if (chk[i].checked == true){
	        	//delete selected item
	        	var del_msg = chk[i].value;
	        	ajax_deleSent(del_msg);
	        }
    	}
    	onDeselect();//deselect the checkall
	}
}

function ajax_deleSent(srh_term){ 
  var search_val = srh_term;
  //post the request
  $.post("../include/del_sent.php?search_term="+search_val, function(data){
   if (data.length>0){ 
     view_sent(); 
   } 
  }) 
}
//Feedback functions
function feed_praise(){ 
	
	var feedback = document.getElementById("feed_msg3");
	var feed_tag = document.getElementById("prse_feed");
	
   	if(feedback.value.length > 0 & feed_tag.value.length > 0){
   		//post the request
	  add_feed(feedback.value, feed_tag.value);
	  //clears the value
	  feedback.value = "";
   	}else{
   		alert('All fields are required.');
   	}
}

function feed_question(){ 
	
	var feedback = document.getElementById("feed_msg");
	var feed_tag = document.getElementById("qst_feed");
	
   	if(feedback.value.length > 0 & feed_tag.value.length > 0){
   		//post the request
	  add_feed(feedback.value, feed_tag.value);
	  //clears the value
	  feedback.value = "";
   	}else{
   		alert('All fields are required.');
   	}
}

function feed_problem(){ 
	
	var feedback = document.getElementById("feed_msg1");
	var feed_tag = document.getElementById("plbm_feed");
	
   	if(feedback.value.length > 0 & feed_tag.value.length > 0){
   		//post the request
	  add_feed(feedback.value, feed_tag.value);
	  //clears the value
	  feedback.value = "";
   	}else{
   		alert('All fields are required.');
   	}
}

function feed_idea(){ 
	
	var feedback = document.getElementById("feed_msg2");
	var feed_tag = document.getElementById("ide_feed");
	
   	if(feedback.value.length > 0 & feed_tag.value.length > 0){
   		//post the request
	  add_feed(feedback.value, feed_tag.value);
	  //clears the value
	  feedback.value = "";
   	}else{
   		alert('All fields are required.');
   	}
}

function add_feed(feed_msg, feed_tag){
	$.post("../include/add_feed.php?feed_msg=" + feed_msg + "&feed_tag=" + feed_tag);
	alert("Thanks for the feedback, and we will get back to you as soon as possible.");
}

//Update member info ----------------------------------------------------------------------------------------------------------
function update_profile()
{
	var your_mobile = document.getElementById("your_mobile");
	var yourpass = document.getElementById("yourpass");
	var yourpass1 = document.getElementById("yourpass1");
	var yourfname = document.getElementById("yourfname");
	var yourlname = document.getElementById("yourlname");
	var mail_address = document.getElementById("mail_address");
	var your_city = document.getElementById("your_city");
	var your_postal = document.getElementById("your_postal");
	var your_country = document.getElementById("your_country");
	
	if(your_mobile.value.length == 11 & yourpass.value.length > 4 & yourpass1.value == yourpass.value & yourfname.value.length > 1 & yourlname.value.length > 1 & mail_address.value.length > 9 & your_postal.value.length > 4){
   		//post the request
	  $.post("../include/update_profile.php?your_mobile=" + your_mobile.value + "&yourpass=" + yourpass.value + "&yourpass1=" + yourpass1.value + "&yourfname=" + yourfname.value + "&yourlname=" + yourlname.value + "&mail_address=" + mail_address.value + "&your_city=" + your_city.value + "&your_postal=" + your_postal.value + "&your_country=" + your_country.value, function(data){
	   if (data.length>0){ 
	     $("#customForm").html(data);
	   } 
	  })
   	}else{
   		if(yourpass.value.length < 5)
   		{
   			$("#yourpassInfo").text('<<-- This field is required.');
   			$("#yourpassInfo").addClass("error");
   		}
   		if(your_postal.value.length < 5)
   		{
   			$("#yourpostalInfo").text('<<-- This field is required.');
   			$("#yourpostalInfo").addClass("error");
   		}
	}
}
//sms credit calculation functions ------------------------------------------------------------------------------------------------------------
function buy_credit()
{
	var chk = document.getElementsByName('credit');
	var account = null;
	//loop the options detect which is selected and get its value
	for (i = 0; i < 3; i++) {
		if (chk[i].checked == true){
        	account = chk[i].value;
        	$.post("../include/update_credit.php?acc=" + account);
        	//update UI with new sms credit info
        	$("#update_credits").load("../include/view_credit.php");
        	//error credit checking
        	error_credit();
        }
	}
	//alert('Hello world');
	$("#tellafriend_form").html('<p>Your account was credited with ' + account + ' SMS credits.</p>');
}
function error_credit()
{
	var chk = document.getElementById('update_credits');
	//checks if the element text is 0
	if(chk.textContent == "0")
	{
		$("#not_enough_credit").show();
	}
	else{
		$("#not_enough_credit").hide();
	}
}















