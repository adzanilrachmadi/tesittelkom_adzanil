<head>
  <link href="<?php echo base_url(); ?>assets/register/style.css?1" rel="stylesheet">
  <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
</head>

<body>
  <div id="login-box">
    <div class="left">
      <h1>Sign up</h1>
      <form action="#" id="register_form">
        <input type="text" name="username" placeholder="Username" required value="bams" />
        <input type="text" name="nama" placeholder="Nama" required value="Nama Bams"/>
        <input type="password" name="password" placeholder="Password" required value="pas"/>
        <input type="text" name="email" placeholder="E-Mail" required value="mail@mail.mail"/>
        <label for="gender">Pilih Gender</label>
        <select name="gender" required>
          <option value="pria">pria</option>
          <option value="wanita">wanita</option>
        </select><br><br>
        <label for="foto">Pilih Foto</label>
        <input type="file" name="foto" id="foto" placeholder="Foto" required/>
        <input type="submit" value="Submit">
      </form>

      <p id="message" style="color:red; font-size: .9rem; text-align: center;"></p>
    </div>
    <div class="right">
      <span class="loginwith">Sign in with<br />social network</span>
      <button class="social-signin facebook">Log in with facebook</button>
      <button class="social-signin twitter">Log in with Twitter</button>
      <button class="social-signin google">Log in with Google+</button>
    </div>
    <div class="or">OR</div>
  </div>
  <script>
    $("#register_form").submit((e) => {
      console.log(e);
      e.preventDefault();
      e.stopPropagation();
      // validate value
      var error = false;
      $("#register_form").find("input").each((i, ele) => {
        if ($(ele).val() == "") {
          $(ele).addClass("is-invalid");
          error = true;
        }
      });
      if (error) {
        return;
      }
      // process ajax call login
      var data = new FormData($("#register_form")[0]);
      data.delete("foto");
      var reader = new FileReader();
      reader.readAsDataURL(($("#foto")[0]).files[0]);
      reader.onload = () => {
        var fileB64 = reader.result;
        data.append("foto", fileB64);
        $.ajax({
          url: "<?php echo base_url("auth/submit_register") ?>",
          data: data,
          method: "POST",
          cache: false,
          contentType: false,
          processData: false,
          type: "json",
          success: function(result) {
            console.log(result);
            var j = JSON.parse(result);
            if (j.success) {
              location.href = j.redirect;
            } else {
              $("#message").text(j.message);
            }
          },
          error: function(error) {
            console.log(error);
          },
          // upload progress
          // xhr: function() {
          //   var myXhr = $.ajaxSettings.xhr();
          //   if (myXhr.upload) {
          //     myXhr.upload.addEventListener('progress', function(e) {
          //       var percent_loaded = Math.ceil((e.loaded / e.total) * 100);
          //       console.log(percent_loaded);
          //       // // $('#progress').css('width', percent_loaded + '%');
          //       // if (e.lengthComputable) {
          //       //   $('#progress_upload').attr({
          //       //     value: e.loaded,
          //       //     max: e.total,
          //       //   });
          //       // }
          //     }, false);
          //   }
          //   return myXhr;
          // }
        });
      }
      reader.onerror = (e) => {
        console.log(e);
      }
      // $.ajax({
      //   url: "<?php echo base_url("auth/register") ?>",
      //   data: f,
      //   method: "POST",
      //   cache: false,
      //   contentType: false,
      //   processData: false,
      //   type: "json",
      //   success: function(result) {
      //     console.log(result);
      //     var j = JSON.parse(result);
      //     if (j.success) {
      //       location.href = j.redirect;
      //     } else {
      //       $("#message").text(j.message);
      //       $("#username").focus();
      //     }
      //   },
      //   error: function(error) {
      //     console.log(error);
      //   }
      // });
    });
  </script>
</body>