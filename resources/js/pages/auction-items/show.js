// Initiation Section
// Build the remaining time
let auctionItemDetail = document.querySelector('#auction-item-detail')
let auctionItemDetailId = auctionItemDetail.dataset.id
let remainingSecondsElement = document.querySelector('#auction-item__remaining-time')
let remainingSeconds = remainingSecondsElement.dataset.remainingSeconds
let remainingTimeHoursElement = document.querySelector('#auction-item__remaining-time__hours')
let remainingTimeMinutesElement = document.querySelector('#auction-item__remaining-time__minutes')
let remainingTimeSecondsElement = document.querySelector('#auction-item__remaining-time__seconds')
let bidSubmissionButton = document.querySelector('#auction-item-bid-submission__button')

// to be rewritten
let auctionItemLatestPrice = document.querySelector('#auction-item-latest-price')
let auctionBidderLatestPrice = document.querySelector('#auction-bidder-latest-bid-price')
let auctionBidderLatestName = document.querySelector('#auction-bidder-latest-bid-name')

// set the remaining time in separated format
setInterval(function() {
    let remainingTime = convertSecondsToRemainingTime(remainingSeconds)
    remainingTimeHoursElement.textContent = remainingTime.hours
    remainingTimeMinutesElement.textContent = remainingTime.minutes
    remainingTimeSecondsElement.textContent = remainingTime.seconds
    remainingSeconds--

    if (remainingSeconds === 0) {
        alert()
        window.location.reload()
    }

}, 1000)


// Echo Section
Echo.join(`auction-item.${auctionItemDetailId}`)
    .listen('AuctionBidderPriceSubmitted', (e) => {

        auctionItemLatestPrice.textContent = `Rp. ${e.auctionBidder.formatted_bid_price}`
        auctionBidderLatestPrice.textContent = `Rp. ${e.auctionBidder.formatted_bid_price}`
        auctionBidderLatestPrice.classList.remove('hidden')
        auctionBidderLatestName.textContent = `oleh ${e.auctionBidder.user.profile.name}`
    })


// Event Listener
bidSubmissionButton.addEventListener('click', function(el) {

    let bidPrice = document.querySelector('#auction-item-bid-submission__bid-price')

    axios({
        method: 'post',
        url: `${window.location.pathname}/bids`,
        data: {
            "bid-price": bidPrice.value
        }
    }).then(response => {
        Swal.fire({
            // title: error.response.data.message.title,
            text: response.data.message.text,
            imageWidth: "7rem",
            imageUrl: '/images/icons/illustration-complete.svg',
            confirmButtonColor: '#E60013',
            confirmButtonText: 'Semoga Beruntung'
        })
    }).catch(error => {
        Swal.fire({
            // title: error.response.data.message.title,
            text: error.response.data.message.text,
            imageWidth: "5rem",
            imageUrl: '/images/icons/icon-fail.png',
            confirmButtonColor: '#E60013',
            confirmButtonText: 'Coba Kembali'
        })
    })
})

// Functions Section
function convertSecondsToRemainingTime(value) {
    const sec = parseInt(value, 10); // convert value to number if it's string
    let hours   = Math.floor(sec / 3600); // get hours
    let minutes = Math.floor((sec - (hours * 3600)) / 60); // get minutes
    let seconds = sec - (hours * 3600) - (minutes * 60); //  get seconds

    return { hours, minutes, seconds }
}
