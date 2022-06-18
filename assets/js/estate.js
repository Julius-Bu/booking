$(document).ready(function() {
    'use strict';
    $("#email").on("keyup", () => {
         let input_val = $("#email").val();
         const reg = /^[a-z0-9-.]{1,30}@[a-z]{1,65}.(com|net|biz|info|org|([a-z]{2,3}.[a-z]{2}))*$/;
         if(!reg.test(input_val)) {
             $("#email").css({"border": '3px solid red'});
             $("#email_error").text("Invalid email address");
         } else{
             $("#email").css({"border": '3px solid green'});
             $("#email_error").text("Valid email address");
             $("#email_error").removeClass("text-danger");
             $("#email_error").toggleClass("text-success");
             $("#emailSuccess").toggleClass("fas fa-check-circle text-success");
         }
     });
     $("#firstName").on("keyup", () => {
         let value = $("#firstName").val();
         const reg = /^[a-zA-Z]*$/;
         if(!reg.test(value)) {
             $("#firstName").css({"border": '3px solid red'});
         } else{
             $("#firstName").css({"border": '3px solid green'});
             $("#validFistName").toggleClass("fas fa-check-circle text-success");
         }
     });
     $("#lastName").on("keyup", () => {
         let value = $("#lastName").val();
         const reg = /^[a-zA-Z]|[a-zA-Z_]+([a-zA-Z_])*$/;
         if(!reg.test(value)) {
             $("#lastName").css({"border": '3px solid red'});
         } else{
             $("#lastName").css({"border": '3px solid green'});
             $("#validlastName").toggleClass("fas fa-check-circle text-success");
         }
     });
     $("#password").on("keyup", () => {
         let value = $("#password").val();
         const reg = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])/;
         if(!reg.test(value) || value.length < 6) {
             $("#password").css({"border": '3px solid red'});
         } else{
             $("#password").css({"border": '3px solid green'});
             $("#validPassword").toggleClass("fas fa-check-circle text-success");
         }
     });
     $("#conf_password").on("keyup", () => {
         let value = $("#conf_password").val();
         let pass = $("#password").val();
         if(value !== pass) {
             $("#conf_password").css({"border": '3px solid red'});
         } else{
             $("#conf_password").css({"border": '3px solid green'});
             $("#validConf").toggleClass("fas fa-check-circle text-success");
         }
     });
        $("#upload").click(() =>{
        var fd = new FormData(document.getElementById('profileForm'));
        var files = $('#uploaded_file').val();
        fd.append('uploaded_file',files);
        $.ajax({
            url: 'upload.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            beforSend: () => {
                $(".beforUpload").show();
            },
            success: (response) => {
                $(".notification").html(response);
            },
            complete: () => {
                $(".beforUpload").hide();
            }
        });
    });
      $("#filter").on("change", () => {
          let value = $("#search").val();
          let key = $("#filter").val();
          $.ajax({
              url: "search.php",
              type: "GET",
              data: {q: value, filter: key},
              success: (propertyDetails) => {
                  $("#showResult").show();
                  $("#propertyResults").html(propertyDetails);
              }
          });
      });
      $("#saveSchedule").on("submit", (e) => {
          e.preventDefault();
          let formData = $("#saveSchedule").serializeArray();
          $.ajax({
              url: "upload.php",
              type: "POST",
              data: formData,
              beforeSend: () => {
                 $(".beforeSend").show();  
              },
              success: (feedBack) => {
                  $("#success").html(feedBack);
              },
              complete: () => {
                  $(".beforeSend").hide(); 
              }
          });
      });
    $("#scheduleModal").modal();
    $("#nin").on("keyup", () => {
        const reg = /^[A-Z]{2}[\d]{8}[A-Z]{1}[\d]{2}[A-Z]{1}$/;
        let value = $("#nin").val();
        if(!reg.test(value)) {
            $("#nin").css({"border": '2px solid red'});
            $("#ninError").text("Invalid National Identification Number (NIN)");
        }else {
            $("#nin").css({"border": '2px solid green'});
            $("#ninError").text("");
            $("#validNin").text("Valid National Identification Number (NIN)");
        }
    });
    $(".open-request").on("click", () => {
        $(".request").slideToggle(500);
        $("#angle").toggleClass("fas fa-angle-down");
        $("#angle").toggleClass("fas fa-angle-up");
    });
       $(".pending").on("click", () => {
                    $(".pending-list").slideToggle(500);
                    $("#pending-angle").toggleClass("fas fa-angle-down");
                    $("#pending-angle").toggleClass("fas fa-angle-up");
                });
                 $(".p-sold").on("click", () => {
                    $(".sold-list").slideToggle(500);
                    $("#sold-angle").toggleClass("fas fa-angle-down");
                    $("#sold-angle").toggleClass("fas fa-angle-up");
                });
            $("#search").on("keyup", () => {
                    let value = $("#search").val();
                    $.ajax({
                        url: "search.php",
                        type: "GET",
                        data: {permit: value},
                        beforeSend: () => {
                            
                        },
                        success: (permitDetails) => {
                            $("#permitResults").html(permitDetails);
                        },
                        complete: () => {
                            
                        }
                    });
                });
      $("#sold").on("submit", (e) => {
                     e.preventDefault();
                    let data = $("#sold").serializeArray();
                    $.ajax({
                        url: "upload.php",
                        type: "POST",
                        data: data,
                        beforeSend: () => {
                            
                        },
                        success: (feedBack) => {
                            $("#soldResults").html(feedBack);
                        },
                        complete: () => {
                            
                        }
                    });
                });
                $(".landID").on("click", () => {
                    let randNo = Math.ceil(Math.random() * 10000000);
                    let prefix = "L";
                    $("#propertyID").val(prefix+randNo);
                });
                $(".houseID").on("click", () => {
                    let randNo = Math.ceil(Math.random() * 10000000);
                    let prefix = "H";
                    $("#propertyID").val(prefix+randNo);
                });
    
 });
        function closeSideNav() {
            let open = document.getElementById('open-side-nav');
            let close = document.getElementById('close-side-nav');
            let main = document.getElementById('main');
            let sideNav = document.getElementById('sideNav');
            open.style.display = "block";
            main.style.marginLeft = "0px";
            sideNav.style.width = "0px"; 
            close.style.display = "none";                                      
        }
          function openSideNav() {
            let open = document.getElementById('open-side-nav');
            let close = document.getElementById('close-side-nav');
            let main = document.getElementById('main');
            let sideNav = document.getElementById('sideNav');
            open.style.display = "none";
            main.style.marginLeft = "250px";
            sideNav.style.width = "250px"; 
            close.style.display = "block";                                      
        }
         function logout() {
             const conf = confirm("Logout?");
             if(!conf) {
                 return false;
             }
         }
  var closeModal = document.getElementById('close-modal');
                closeModal.addEventListener("click", function() {
                    window.history.back();
                });
                 function help() {
                var qn = prompt("How may I help you?", 'enter your query here');
                var user = document.getElementById('user').value;
                if (qn) {
                 var request = new XMLHttpRequest();
                    request.onreadystatechange = function() {
                        if(this.readyState == 4 && this.status == 200) {
                            alert(request.responseText);
                        }
                    }
                    request.open("POST", "http://localhost/real-estate/manager/upload.php", true);
                    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    request.send("user="+user+"&message="+qn);
                }
            }
