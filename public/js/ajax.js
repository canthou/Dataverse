jQuery(document).ready(function(){
    jQuery(document).on('click', '.add_user', function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        // function fetchuser() {
        //     $.ajax({
        //         type: "GET",
        //         url: "/fetch-users",
        //         dataType: "json",
        //         success: function (response) {
        //             // console.log(response);
        //             $('tbody').html("");
        //             $.each(response.users, function (key, item) {
        //                 console.log(item)
        //                 $('tbody').append('<tr>\
        //                     <th scope="row">' + item.name + '</th>\
        //                     <td>' + item.username + '</td>\
        //                     <td>' + item.roles + '</td>\
        //                     <td>' + item.active + '</td>\
        //                     <td><a href='"http://127.0.0.1:8000/edit_user/54"'>Επεξεργασία</a>
        //                     <a href='"http://127.0.0.1:8000/delete_user/54"' onclick="return confirm('Είστε σίγουροι ότι θέλετε να διαγράψετε το χρήστη;')">Διαγραφή</a></td>\
        //                 \</tr>');
        //             });
        //         }
        //     });
        // }

        let active = ($('input[name="active"]:checked').val() == 'on') ? '1' : 0
        var roles = []

        $('input[name="admin-role"]:checked').each(function() {
            roles.push(this.value)
         });


        var data = {
            'active': active,
            'name': $('#name').val(),
            'username': $('#username').val(),
            'password': $('#password').val(),
            'password_confirmation': $('#password-check').val(),
            'email': $('#email').val(),
            'roles': roles
        }

        console.log(data)

        jQuery.ajax({
            url: "/",
            method: 'post',
            data: data,
            dataType: 'json',
            success: function(result){
                console.log(result)
                alert(result.msg)
                $('#UserModal').modal('hide')
                // window.location.href = '/'
                // fetchuser()
            }
        });
    });
});