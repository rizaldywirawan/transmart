$(document).ready(function() {
    // For menu sidebar
    $('#menu-auctions').addClass('text-danger border rounded-md shadow-sm')


    // Show Modal Live auction
    $('#live-now').click(function() {
        $('#modal-live_auction').removeClass('hidden')
    })

    // Close Live auction
    $('#later-live').click(function() {
        $('#modal-live_auction').addClass('hidden')
    })

})
