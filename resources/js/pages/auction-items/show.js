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

let auctionBidPrice = document.querySelector('#auction-item-bid-submission__bid-price')
let auctionBidPricePlaceholder = document.querySelector('#auction-item-bid-submission__bid-price-placeholder')

let bidPause = 0
let bidStack = []

let bidDecrement = document.querySelector('#bid-decrement')

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

        auctionItemLatestPrice.textContent = `Rp ${e.auctionBidder.formatted_bid_price}`
        auctionBidderLatestPrice.textContent = `Rp ${e.auctionBidder.formatted_bid_price}`
        auctionBidderLatestPrice.classList.remove('hidden')
        auctionBidderLatestName.textContent = `oleh ${e.auctionBidder.user.profile.name}`

        auctionBidPricePlaceholder.textContent = `Rp ${e.auctionBidder.formatted_bid_price}`
        auctionBidPrice.textContent = `Rp ${e.auctionBidder.bid_price}`

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
                        class="text-primary-500 text-base font-bold">Rp ${e.auctionBidder.formatted_bid_price}</span>
                </h6>
            </div>
        `

        bidEntryContainer.prepend(bidEntry)

    })


// Event Listener
if (bidSubmissionButton !== null) {
    bidSubmissionButton.addEventListener('click', function(el) {

        bidSubmissionButton.setAttribute('disabled', true)

        let bidPrice = document.querySelector('#auction-item-bid-submission__bid-price')

        if (bidPause === 0) {

            axios({
                method: 'post',
                url: `${window.location.pathname}/bids`,
                data: {
                    "bid-price": bidPrice.value
                }
            }).then(response => {

                bidPause = 5

                Swal.fire({
                    // title: error.response.data.message.title,
                    heightAuto: false,
                    text: response.data.message.text,
                    imageWidth: "7rem",
                    imageUrl: '/images/icons/icon-success.svg',
                    confirmButtonColor: '#F87BDF',
                    confirmButtonText: 'Semoga Beruntung'
                })

                countbidPause()

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

        } else {
            Swal.fire({
                // title: error.response.data.message.title,
                heightAuto: false,
                text: `Tunggu ${bidPause} detik setelah melakukan suatu bid.`,
                imageWidth: "5rem",
                imageUrl: '/images/icons/icon-fail.png',
                confirmButtonColor: '#F87BDF',
                confirmButtonText: 'Mohon Tunggu'
            })
        }

        bidSubmissionButton.removeAttribute('disabled')
    })
}

if (bidDecrement !== null) {
    bidDecrement.addEventListener('click', function(el) {

        if (bidStack.length) {
            let popBidValue = bidStack.pop()
            auctionBidPrice.value = parseInt(auctionBidPrice.value) - parseInt(popBidValue)
            auctionBidPricePlaceholder.textContent = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(auctionBidPrice.value)
        }

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

function countbidPause() {
    let countInterval = setInterval(function() {

        if (bidPause === 0) {
            clearInterval(countInterval)
        } else {
            bidPause--
        }

        console.log(bidPause)

    }, 1000)
}

document.body.addEventListener('click', function(el) {
    if (el.target.classList.contains('bid-value')) {

        bidStack.push(el.target.dataset.value)

        auctionBidPrice.value = parseInt(auctionBidPrice.value) + parseInt(el.target.dataset.value)
        auctionBidPricePlaceholder.textContent = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(auctionBidPrice.value)
    }
})
