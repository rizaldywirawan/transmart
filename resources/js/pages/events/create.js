const { default: axios } = require("axios")

$(document).ready(function() {
    // For menu sidebar
    $('#menu-event').addClass('text-danger border rounded-md shadow-sm')

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

    // Create Event Submit
    $('#form-event').submit(function(event) {
        event.preventDefault()
        $('#save-event').html('Loading...').attr('disabled', true)
        let eventForm = new FormData($('#form-event')[0])
        axios({
            method: 'post',
            url: '/events',
            data: eventForm
        })
        .then(function(response) {
            $('#save-event').html('Save').attr('disabled', false)
            Swal.fire({
                title       : response.data.message.title,
                text        : response.data.message.text,
                icon        : response.data.message.icon,
            }).then(function() {
                $('#name').val(null)
                $('#event-link').val(null)
                $('#description').val(null)
                $('#event-category').prop('selectedIndex', 0)
                $('#event-type').prop('selectedIndex', 0)
                $('#start-date').val(null)
                $('#end-date').val(null)
                $('#file-auction').val(null)
            })

        })
        .catch(function(error) {
            $('#save-event').html('Save').attr('disabled', false)
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
