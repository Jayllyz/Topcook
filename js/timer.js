function timer() {
    const date = document.getElementById("date").value;
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

    document.getElementById("days").innerHTML = days;
    document.getElementById("hours").innerHTML = hours;
    document.getElementById("minutes").innerHTML = minutes;
    document.getElementById("seconds").innerHTML = seconds;
}
setInterval(timer, 1000);