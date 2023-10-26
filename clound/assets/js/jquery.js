function update1(){
    $.ajax({
        url: "../update/update.html",
        method: "POST",
        data: {
            type: 'update1'
        },
        success: function(response) {
            $("#trave").html(response);
        }
    });
}
function update2(){
    $.ajax({
        url: "../update/update.html",
        method: "POST",
        data: {
            type: 'update2'
        },
        success: function(response) {
            $("#trave").html(response);
        }
    });
}
function update3(){
    $.ajax({
        url: "../update/update.html",
        method: "POST",
        data: {
            type: 'update3'
        },
        success: function(response) {
            $("#trave").html(response);
        }
    });
}
function update4(){
    $.ajax({
        url: "../update/update.html",
        method: "POST",
        data: {
            type: 'update4'
        },
        success: function(response) {
            $("#trave").html(response);
        }
    });
}
function update5(){
    $.ajax({
        url: "../update/update.html",
        method: "POST",
        data: {
            type: 'update5'
        },
        success: function(response) {
            $("#trave").html(response);
        }
    });
}
function update6(){
    $.ajax({
        url: "../update/update.html",
        method: "POST",
        data: {
            type: 'update6'
        },
        success: function(response) {
            $("#trave").html(response);
        }
    });
}
function update7(){
    $.ajax({
        url: "../update/update.html",
        method: "POST",
        data: {
            type: 'update7',
            oldpass: $("#oldpass").val(),
            newpass: $("#newpass").val()
        },
        success: function(response) {
            $("#trave").html(response);
        }
    });
}