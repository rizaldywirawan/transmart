$(document).ready(function() {

    $('#menu-users').addClass('text-danger border rounded-md shadow-sm');

    // Show Modal Create
    $('#create-user').click(function() {
        $('#modal-create_user').removeClass('hidden')
    })

    // Close Modal Create
    $('#close-modal-create_user').click(function() {
        $('#modal-create_user').addClass('hidden')

    })

    $('#user-table').DataTable({
        serverSide  : true,
        processing  : true,
        searching   : false,
        responsive : true,
        ajax        : {
            url     : '/user-table',
            method  : 'get',
        },
        columns : [
            {
                data: 'DT_RowIndex',
                searchable: false,
                orderable: false,
                className: 'text-center',
            },
            {
                data: 'name'
            },
            {
                data: 'phone'
            },
            {
                data: 'company'
            },
            {
                data: 'jobtitle'
            },
            {
                data: 'action'
            },
        ]
    })

    // / Create Auction Submit
    $('#user-form').submit(function(event) {
        event.preventDefault()
        $('#save-user').html('Loading...').attr('disabled', true)
        let auctionForm = new FormData($('#user-form')[0])
        axios({
            method: 'post',
            url: '/users',
            data: auctionForm
        })
        .then(function(response) {
            $('#save-user').html('Save').attr('disabled', false)
            Swal.fire({
                title       : response.data.message.title,
                text        : response.data.message.text,
                icon        : response.data.message.icon,
            }).then(function() {
                $('#username').val(null)
                $('#password').val(null)
                $('#password_confirmation').val(null)

                // $('#event-id').prop('selectedIndex', 0)
                $('#user-table').DataTable().ajax.reload()

            })

        })
        .catch(function(error) {
            $('#save-user').html('Save').attr('disabled', false)

            if(error.response.status == 422) {
                $('.invalid-feedback').remove()
                $('.is-invalid').removeClass('is-invalid')

                $.each(error.response.data.errors, function (key, value) {
                    let split = key.split('.')

                    $.each(split, (key, value) => {
                        if (key > 0) {
                            split[key] = `[${value}]`
                        }
                    })

                    let join = split.join('')
                    let parentOfInputColumn = $(`*[name="${join}"]`).addClass('is-invalid').parent()

                    $.each(value, function (subKey, subValue) {
                        $(`*[name="${join}"]`).addClass('is-invalid')

                        // If the input column has input-group class, please insert the error below the input group element
                        if (parentOfInputColumn.hasClass('input-group')) {
                            parentOfInputColumn.append(`<div class="invalid-feedback">${subValue}</div>`)
                        } else {
                            if ($(parentOfInputColumn).find('.form-text.text-muted').length) {
                                $(parentOfInputColumn).find('.form-text.text-muted').before(`<div class="invalid-feedback">${subValue}</div>`)
                            } else {
                                $(parentOfInputColumn).append(`<div class="invalid-feedback">${subValue}</div>`)
                            }
                        }
                    })
                })
            } else {
                Swal.fire({
                    title : error.response.data.message.title,
                    text  : error.response.data.message.text,
                    icon  : error.response.data.message.icon,
                    heightAuto: false
                })
            }

        })

    })


})
