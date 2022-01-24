const { default: axios } = require("axios")

$(document).ready(function() {
    let url = window.location.href.match('auctions\/[^\/]+')
    let auctionUrl = url[0]

    // For menu sidebar
    $('#menu-auctions').addClass('text-danger border rounded-md shadow-sm')

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


    // Edit Event Submit
    $('#auction-form').submit(function(event) {
        event.preventDefault()
        $('#save-auction').html('Loading...').attr('disabled', true)
        let auctionForm = new FormData($('#auction-form')[0])
        axios({
            method: 'post',
            url: `/${auctionUrl}`,
            data: auctionForm
        })
        .then(function(response) {
            $('#save-auction').html('Save').attr('disabled', false)
            Swal.fire({
                title       : response.data.message.title,
                text        : response.data.message.text,
                icon        : response.data.message.icon,
            }).then(function() {
                $('#file-auction').val(null)

                attachmentSection(auctionUrl)
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
    // remove image
    $('.remove-image').on('click', function() {
        let getAuctionAttachmentId = $(this).data('target')

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
                    method  : `delete`,
                    url : `/auction/${getAuctionAttachmentId}/remove-file`
                })
                .then(function(response) {
                    Swal.fire({
                        icon    : response.data.message.icon,
                        title   : response.data.message.title,
                        text    : response.data.message.text,
                    }).then(function() {

                        attachmentSection(auctionUrl)
                    })


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

    $(document).on('click', '.remove-image_after', function() {
        let getAuctionAttachmentAfterId = $(this).data('target')

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
                    method  : `delete`,
                    url : `/auction/${getAuctionAttachmentAfterId}/remove-file`
                })
                .then(function(response) {
                    Swal.fire({
                        icon    : response.data.message.icon,
                        title   : response.data.message.title,
                        text    : response.data.message.text,
                    }).then(function() {

                        attachmentSection(auctionUrl)
                    })


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

    function attachmentSection(auctionUrl) {
        axios({
            method : 'get',
            url: `/${auctionUrl}/based-on-attachment`
        }).then(function(response) {
            $('.image-section').html(response.data)
        })
    }
})
