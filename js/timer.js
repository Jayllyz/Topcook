function timer() {
    const date = document.getElementById("date").value;
    const form_contest = document.getElementById("form_contest");
    const info_timer = document.getElementById("info_timer");
    const divDays = document.getElementById("days");
    const divHours = document.getElementById("hours");
    const divMinutes = document.getElementById("minutes");
    const divSeconds = document.getElementById("seconds");


    let date_now = new Date().getTime();
    let date_end = new Date(date).getTime();
    let gab = date_end - date_now;
    const second = 1000;
    const minute = second * 60;
    const hour = minute * 60;
    const day = hour * 24;

    let days = Math.floor(gab / day);
    let hours = Math.floor((gab % day) / hour);
    let minutes = Math.floor((gab % hour) / minute);
    let seconds = Math.floor((gab % minute) / second);

    if (seconds.toString() !== divSeconds.innerHTML && divSeconds.innerHTML !== "") {
        divSeconds.classList.add("animated");
        setTimeout(function() {
            divSeconds.className = "";
        }, 700);
    }

    if (minutes.toString() !== divMinutes.innerHTML && divMinutes.innerHTML !== "") {
        divMinutes.classList.add("animated");
        setTimeout(function() {
            divMinutes.className = "";
        }, 700);

    }

    if (hours.toString() !== divHours.innerHTML && divHours.innerHTML !== "") {
        divHours.classList.add("animated");
        setTimeout(function() {
            divHours.className = "";
        }, 700);

    }

    if (days.toString() !== divDays.innerHTML && divDays.innerHTML !== "") {
        divDays.classList.add("animated");
        setTimeout(function() {
            divDays.className = "";
        }, 700);


    }

    divMinutes.innerHTML = minutes;
    divHours.innerHTML = hours;
    divDays.innerHTML = days;
    divSeconds.innerHTML = seconds;

    if(divDays.innerHTML === "00" && divHours.innerHTML === "00" && divMinutes.innerHTML === "00" && divSeconds.innerHTML === "00"){
        info_timer.innerHTML = "<p class='text-center fs-3'>Inscriptions terminés !</p>";
        form_contest.innerHTML = "<div class='container'><p class='alert alert-warning'>Les inscriptions sont fermées</p></div>";
    }

}
setInterval(timer, 1000);