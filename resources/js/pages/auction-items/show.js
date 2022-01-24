// Initiation Section
// Build the remaining time
let auctionItemDetail = document.querySelector('#auction-item-detail')
let auctionItemDetailId = auctionItemDetail.dataset.id
let remainingSecondsElement = document.querySelector('#auction-item__remaining-time')
let remainingSeconds = parseInt(remainingSecondsElement.dataset.remainingSeconds)
let remainingTimeHoursElement = document.querySelector('#auction-item__remaining-time__hours')
let remainingTimeMinutesElement = document.querySelector('#auction-item__remaining-time__minutes')
let remainingTimeSecondsElement = document.querySelector('#auction-item__remaining-time__seconds')
let bidSubmissionButton = document.querySelector('#auction-item-bid-submission__button')
let emptyBidHistory = document.querySelector('#auction-item-no-bid-yet')
let bidEntryContainer = document.querySelector('#auction-item-bid-historical__entries')

// to be rewritten
let auctionItemLatestPrice = document.querySelector('#auction-item-latest-price')
let auctionBidderLatestPrice = document.querySelector('#auction-bidder-latest-bid-price')
let auctionBidderLatestName = document.querySelector('#auction-bidder-latest-bid-name')

// set the remaining time in separated format
if (remainingSeconds !== 0) {
    let remainingTimeIntervalId = setInterval(function() {

        if (remainingSeconds === 0) {
            clearInterval(remainingTimeIntervalId)
            window.location.reload()
        } else {
            let remainingTime = convertSecondsToRemainingTime(remainingSeconds)
            remainingTimeHoursElement.textContent = remainingTime.hours
            remainingTimeMinutesElement.textContent = remainingTime.minutes
            remainingTimeSecondsElement.textContent = remainingTime.seconds
            remainingSeconds--
        }

    }, 1000)
}


// Echo Section
Echo.join(`auction-item.${auctionItemDetailId}`)
    .listen('AuctionBidderPriceSubmitted', (e) => {

        auctionItemLatestPrice.textContent = `Rp. ${e.auctionBidder.formatted_bid_price}`
        auctionBidderLatestPrice.textContent = `Rp. ${e.auctionBidder.formatted_bid_price}`
        auctionBidderLatestPrice.classList.remove('hidden')
        auctionBidderLatestName.textContent = `oleh ${e.auctionBidder.user.profile.name}`

        if (emptyBidHistory !== null) {
            emptyBidHistory.remove()
        }

        let bidEntry = document.createElement('div')
        bidEntry.innerHTML = `
            <div class="general-box-shadow p-3 flex items-center rounded-xl mb-3">
                <span class="h-8 w-8 sm:h-5 sm:w-5 mr-3">
                    <img src="/images/icons/icon-money.svg" alt="Auction Item Bid Record"
                        class="h-full">
                </span>
                <h6 class="text-sm font-normal">${e.auctionBidder.user.profile.name} melakukan penawaran sebesar <span
                        class="text-primary-500 text-base font-bold">Rp. ${e.auctionBidder.formatted_bid_price}</span>
                </h6>
            </div>
        `

        bidEntryContainer.prepend(bidEntry)

    })


// Event Listener
if (bidSubmissionButton !== null) {
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
                heightAuto: false,
                text: response.data.message.text,
                imageWidth: "7rem",
                imageUrl: '/images/icons/icon-success.svg',
                confirmButtonColor: '#F87BDF',
                confirmButtonText: 'Semoga Beruntung'
            })
        }).catch(error => {
            Swal.fire({
                // title: error.response.data.message.title,
                heightAuto: false,
                text: error.response.data.message.text,
                imageWidth: "5rem",
                imageUrl: '/images/icons/icon-fail.png',
                confirmButtonColor: '#F87BDF',
                confirmButtonText: 'Coba Kembali'
            })
        })
    })
}


// Functions Section
function convertSecondsToRemainingTime(value) {
    const sec = parseInt(value, 10); // convert value to number if it's string
    let hours   = Math.floor(sec / 3600); // get hours
    let minutes = Math.floor((sec - (hours * 3600)) / 60); // get minutes
    let seconds = sec - (hours * 3600) - (minutes * 60); //  get seconds

    return { hours, minutes, seconds }
}
