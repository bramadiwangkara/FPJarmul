const form = document.querySelector('form');

form.addEventListener('submit', e => {
    e.preventDefault();

    const files = document.querySelector('[type=file]').files;
    const formData = new FormData();

    for (let i = 0; i < files.length; i++) {
        let file = files[i];

        formData.append('files[]', file);
    }

    $.ajax({
        type: "POST",
        url: "./processupload.php",
        data: FormData,
        success: function() {
          $('#contact_form').html("<div id='message'></div>");
          $('#message').html("<h2>Contact Form Submitted!</h2>")
          .append("<p>We will be in touch soon.</p>")
          .hide()
          .fadeIn(1500, function() {
            $('#message').append("<img id='checkmark' src='images/bg.png' />");
          });
        }
      });

});

