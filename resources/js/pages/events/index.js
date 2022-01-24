$(document).ready(function() {

    $('#menu-event').addClass('text-danger border rounded-md shadow-sm')


    $('#event-table').DataTable({
        serverSide  : true,
        processing  : true,
        searching   : false,
        responsive : true,
        ajax        : {
            url     : '/event-table',
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
                data: 'description'
            },
            {
                data: 'online_url'
            },
            {
                data: 'action'
            }
        ]
    })

    // Delete
    $(document).on('click', '.delete-event', function(event) {
        let index   = $(event.target).parents('tr')
        let record  = $('#event-table').DataTable().rows(index).data()
        let eventId = record[0].id

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            heightAuto: false
        }).then((result) => {
            if (result.value) {

                axios({
                    method  : 'delete',
                    url : `/events/${eventId}`
                })
                .then(function(response) {

                    $('#event-table').DataTable().ajax.reload()

                })
                .catch(function(error){
                    if(error.response.status == 422) {

                        Swal.fire({
                        icon    : error.response.data.message.icon,
                            title   : error.response.data.message.title,
                            text    : error.response.data.message.text,
                            heightAuto: false
                        })
                    }
                })
            }
        })
    })


})
