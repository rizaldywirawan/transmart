const { default: axios } = require("axios")

$(document).ready(function() {
    // For menu sidebar
    $('#menu-auctions').addClass('text-danger border rounded-md shadow-sm')

    /*
    * For Modal Create Auction
    */
    // Show Modal Create
    $('.create-auction').click(function() {
        $('#modal-create_auction').removeClass('hidden')
    })

    // Close Modal Create
    $('#close-modal-create_auction').click(function() {
        $('#modal-create_auction').addClass('hidden')

    })

    $('#auction-table').DataTable({
        serverSide  : true,
        processing  : true,
        searching   : false,
        responsive : true,
        ajax        : {
            url     : '/auction-table',
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
                data: 'started_at'
            },
            {
                data: 'start_price'
            },
            {
                data: 'auction_bidder_latest'
            },
            {
                data: 'action'
            }
        ]
    })


    const startDate = document.querySelector("#start-date")
    flatpickr(startDate, {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
    })
    const endDate = document.querySelector("#end-date")
    flatpickr(endDate, {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
    })

    // / Create Auction Submit
    $('#auction-form').submit(function(event) {
        event.preventDefault()
        $('#save-auction').html('Loading...').attr('disabled', true)
        let auctionForm = new FormData($('#auction-form')[0])
        axios({
            method: 'post',
            url: '/auctions',
            data: auctionForm
        })
        .then(function(response) {
            $('#save-auction').html('Save').attr('disabled', false)

            Swal.fire({
                title       : response.data.message.title,
                text        : response.data.message.text,
                icon        : response.data.message.icon,
            }).then(function() {
                $('#name').val(null)
                $('#start-date').val(null)
                $('#end-date').val(null)
                $('#starting-bid').val(null)
                $('#bid-increment').val(null)
                $('#description').val(null)
                $('#file').val(null)
                $('#event-id').prop('selectedIndex', 0)
                $('#auction-table').DataTable().ajax.reload()
            })

        })
        .catch(function(error) {
            $('#save-auction').html('Save').attr('disabled', false)

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
