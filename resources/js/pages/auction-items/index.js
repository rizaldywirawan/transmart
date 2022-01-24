let remainingSecondsElement = document.querySelector('#auction-item__remaining-time')
let remainingSeconds = parseInt(remainingSecondsElement.dataset.remainingSeconds)
let remainingTimeHoursElement = document.querySelector('#auction-item__remaining-time__hours')
let remainingTimeMinutesElement = document.querySelector('#auction-item__remaining-time__minutes')
let remainingTimeSecondsElement = document.querySelector('#auction-item__remaining-time__seconds')


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

// Functions Section
function convertSecondsToRemainingTime(value) {
    const sec = parseInt(value, 10); // convert value to number if it's string
    let hours   = Math.floor(sec / 3600); // get hours
    let minutes = Math.floor((sec - (hours * 3600)) / 60); // get minutes
    let seconds = sec - (hours * 3600) - (minutes * 60); //  get seconds

    return { hours, minutes, seconds }
}
