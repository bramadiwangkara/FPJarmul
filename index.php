<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    <title>Chat</title>
    <style>
        .grid-container {
            display: grid;
            grid: 40px / auto auto auto;
            grid-gap: 10px;
            background-color: #4CAF50;
            padding: 10px;
        }

        .img {
            margin: auto;
            width: 50%;
            padding: 20px;
            }

        .center_button {
            margin: auto;
            width: 100%;
            padding: 10px;
        }
    </style>
    
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
        <!-- <audio id="mixed-audio" controls width="100%" autoplay>
            <source src="http://localhost/ChatFinal/output.mp3" type="audio/mp3">
            <!-- <source src="mov_bbb.ogg" type="video/ogg"> -->
        </audio> -->
    </div>
    <br>
    <br>
    
        <h2>CALDERA</h2>
        
        <p id="name-area"></p>
        
        <div id="chat-wrap"><div id="chat-area"></div></div>
        
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
        <br>

        
        <!-- <p><a href="ajax-listing.php" target="_blank" id="view">View listing</a></p> -->
        <!-- <p><a id="btn_listing" href="#">list</a></p> -->
        <br>
        <div class="grid-container">
        <button onclick="myFunction()" style="background-color: grey; /* Grey */
            border: none;
            color: white;
            padding: 10px 20px;">Refresh list</button>
        <form action="upload.php" method="post" enctype="multipart/form-data" target="upload_target" >
            <input name="myfile" type="file" style="padding: 0px 0px; background- color : white"/>
            <input type="submit" name="submitBtn" value="Upload" style="padding: 10px 20px; background- color : grey"/>
        </form>
        </div>
        <br><br>

        <div class="img">
            <div id="listing">
                <p style="color: green">Click for refresh list of Music</p>
            </div>
        </div>
        <br>
        <div class="center_button">
            <button onclick="reset_file()" style="display: inline-block;width : 100%; background-color : #EB2F00; padding: 10px 20px; border :none; border-radius : 20px">Reset file song</button>
            <div id="reset_msg"></div>
        </div>
        <div class="center_button">
            <button onclick="mixFiles()" style="display: inline-block;width : 100%; background-color : #EC6E00; padding: 10px 20px; border :none; border-radius : 20px">Click for Merge this song !</button>
        </div>

        <!-- <form method="post" enctype="multipart/form-data">
            <input type="file" name="files[]" multiple>
            <input type="submit" value="Upload File" name="submit">
        </form>
        <script src="upload.js"></script>   -->
        <!-- <p id="result"></p> -->
	    

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
        function myFunction(){
            $.ajax({
                url: "ajax-listing.php",
                dataType: "html",
                type: "GET",
                success: function(html){
                    // $("#listing").html("<audio controls><source src='upload/'".html."'</audio>");
                    $("#listing").html(html);
                }
            });
        }

        function reset_file(){
            // alert("reset");
            $.ajax({
                url: "reset_file.php",
                dataType: "html",
                type: "GET",
                success: function(html){
                    // alert("File telah di reset!")
                    $('#reset_msg').html(html);
                    myFunction();
                }
            })
        }

        function mixFiles(){
            // alert("reset");
            $.ajax({
                url: "mix.php",
                dataType: "text",
                type: "GET",
                success: function(text){
                    console.log(text);
                    var audioElement = document.getElementById('mixed-audio');
                    audioElement.currentTime=0;
                    audioElement.play();
                }
            })
        }
    </script>
</body>



</html>
