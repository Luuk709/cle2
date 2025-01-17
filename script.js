// get elements from document
const calendarDates = document.querySelector('.calendar-dates');
const monthYear = document.getElementById('month-year');
const prevMonthBtn = document.getElementById('prev-month');
const nextMonthBtn = document.getElementById('next-month');
const days = document.querySelectorAll('.calendar-previous-dates');

const months = [
    "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"
]
//get date info
let currentDate = new Date();
let currentYear = currentDate.getFullYear();
let currentMonth = currentDate.getMonth();

let monthRightNow = ""
let dateRightNow = ""

function showCalender(month, year) {
    calendarDates.innerHTML = '';
    monthYear.textContent = `${months[month]} ${year}`

    const firstDayOfMonth = new Date(year, month, 1).getDay()
    const numberOfDaysOfLastMonth = new Date(year, month, 0).getDate()
    const numberOfDaysOfMonth = new Date(year, month + 1, 0).getDate()

    for (let i = 0; i < firstDayOfMonth; i++) {
        //make blank spaces for previous days
        const prevDays = document.createElement('div')
        prevDays.classList.add("calendar-previous-dates");
        prevDays.id = "calendar-previous"
        prevDays.innerHTML = numberOfDaysOfLastMonth - firstDayOfMonth + 1 + i
        calendarDates.append(prevDays)
    }

    for (let i = 1; i < numberOfDaysOfMonth + 1; i++) {
        //make the rest of the days
        const days = document.createElement('div')
        days.innerHTML = i
        if (i === currentDate.getDate() && month === currentDate.getMonth() && year === currentDate.getFullYear()) {
            days.classList.add("current-day")
        }
        calendarDates.append(days)

    }
    for (let i = 0; i < 42 - (firstDayOfMonth + numberOfDaysOfMonth); i++) {
        const nextDays = document.createElement('div')
        nextDays.classList.add("calendar-previous-dates")
        nextDays.id = "calendar-next"
        nextDays.innerHTML = i + 1
        calendarDates.append(nextDays)
    }


}

prevMonthBtn.addEventListener("click", () => {
    currentMonth--
    if (currentMonth < 0) {
        currentMonth = 11
        currentYear--
    }
    showCalender(currentMonth, currentYear)

})
nextMonthBtn.addEventListener("click", () => {
    currentMonth++
    if (currentMonth > 11) {
        currentMonth = 0
        currentYear++
    }
    showCalender(currentMonth, currentYear)

})
days.forEach((day) => {
    day.addEventListener("click", () => {
        console.log(days)
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        showCalender(currentMonth, currentYear);
    });
});
calendarDates.addEventListener('click', (e) => {
    if (e.target.textContent < 10) {
        dateRightNow = `0${e.target.textContent}`
    } else {
        dateRightNow = e.target.textContent
    }
    if (currentMonth < 10) {
        monthRightNow = `0${currentMonth + 1}`
    } else {
        monthRightNow = currentMonth + 1
    }

    loadXMLDoc(`${currentYear}-${monthRightNow}-${dateRightNow}`)
});

showCalender(currentMonth, currentYear)

function loadXMLDoc(selectedDate) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            document.getElementById("formContainer").innerHTML = this.responseText;
        }
    };


    xhttp.open("GET", `getAppointments.php?q=${selectedDate}`, true);
    xhttp.send();
}