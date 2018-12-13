<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    <title>Chat</title>
    
    <link rel="stylesheet" href="style.css" type="text/css" />
    
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script type="text/javascript" src="chat.js"></script>
    <script type="text/javascript">
    
        // ask user for name with popup prompt    
        var name = prompt("Enter your chat name:", "Guest");
        
        // default name is 'Guest'
    	if (!name || name === ' ') {
    	   name = "Guest";	
    	}
    	
    	// strip tags
    	name = name.replace(/(<([^>]+)>)/ig,"");
    	
    	// display name on page
    	$("#name-area").html("You are: <span>" + name + "</span>");
    	
    	// kick off chat
        var chat =  new Chat();
    	$(function() {
    	
    		 chat.getState(); 


    		 
    		 // watch textarea for key presses
             $("#sendie").keydown(function(event) {  
             
                 var key = event.which;  
           
                 //all keys including return.  
                 if (key >= 33) {
                   
                     var maxLength = $(this).attr("maxlength");  
                     var length = this.value.length;  
                     
                     // don't allow new content if length is maxed out
                     if (length >= maxLength) {  
                         event.preventDefault();  
                     }  
                  }  
                });
    		 // watch textarea for release of key press
    		 $('#sendie').keyup(function(e) {	
    		 					 
    			  if (e.keyCode == 13) { 
    			  
                    var text = $(this).val();
    				var maxLength = $(this).attr("maxlength");  
                    var length = text.length; 
                     
                    // send 
                    if (length <= maxLength + 1) { 
                     
    			        chat.send(text, name);	
    			        $(this).val("");
    			        
                    } else {
                    
    					$(this).val(text.substring(0, maxLength));
    					
    				}	
    				
    			}
             });

             // onclick button
             $('#send-message-area').submit(function(e){
                 
                var text = $('#sendie').val();
    				var maxLength = $('#sendie').attr("maxlength");  
                    var length = text.length; 
                     
                    // send 
                    if (length <= maxLength + 1) { 
                     
    			        chat.send(text, name);	
    			        $('#sendie').val("");
    			        
                    } else {
                    
    					$('#sendie').val(text.substring(0, maxLength));
    					
    				}
                    e.preventDefault();
                    return false;
             });
            
    	});
    </script>

</head>

<body onload="setInterval('chat.update()', 1000)">

    <div id="page-wrap">
    <div style="margin: auto;
  width: 50%;">
        <audio controls width="100%" autoplay>
            <source src="http://192.168.100.174:8100/test" type="audio/ogg">
            <!-- <source src="mov_bbb.ogg" type="video/ogg"> -->
        </audio>
    </div>
    <br>
    <br>
    
        <h2>CALDERA</h2>
        
        <p id="name-area"></p>
        
        <div id="chat-wrap"><div id="chat-area"></div></div>
        <div><div id="listing">ngentot angin</div></div>
        <!-- <p><a href="ajax-listing.php" target="_blank" id="view">View listing</a></p> -->
        <!-- <p><a id="btn_listing" href="#">list</a></p> -->
        <p><a href="ajax-listing.php" id="view">View listing</a></p>
        
        <form id="send-message-area">
            <button id="btn_send" style="background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;">Send</button>
            <textarea id="sendie" maxlength = '100' ></textarea>
            
        </form>
        <!-- <form method="post" enctype="multipart/form-data">
            <input type="file" name="files[]" multiple>
            <input type="submit" value="Upload File" name="submit">
        </form>
        <script src="upload.js"></script>   -->
        <p id="f1_upload_process">Loading...<br/><img src="loader.gif" /></p>
        <p id="result"></p>
	    <form action="upload.php" method="post" enctype="multipart/form-data" target="upload_target" >
            File: <input name="myfile" type="file" />
                <input type="submit" name="submitBtn" value="Upload" />
        </form>

        <iframe id="upload_target" name="upload_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>                 

    </div>
    <script language="javascript" type="text/javascript">
        function startUpload(){
            document.getElementById('f1_upload_process').style.visibility = 'visible';
            return true;
        }

        function stopUpload(success){
            var result = '';
            if (success == 1){
                document.getElementById('result').innerHTML =
                '<span class="msg">The file was uploaded successfully!<\/span><br/><br/>';
            }
            else {
                document.getElementById('result').innerHTML = 
                '<span class="emsg">There was an error during file upload!<\/span><br/><br/>';
            }
            document.getElementById('f1_upload_process').style.visibility = 'hidden';
            return true;   
        }

           window.top.window.stopUpload(<?php echo $result; ?>);
    </script>
    <script>
        $('#view').click(function(event){
	
        
        var $a = $(this);
        var href = $a.attr('href');
        var query = href.substring(href.indexOf('?'), href.length);
        
        $.ajax({
            url: href,
            dataType: 'html',
            type: 'GET',
            data: query,
            success: function(html) {
            
                $('#listing').html(html);
            
            }
        });


});
    </script>

</body>



</html>