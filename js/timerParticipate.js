let removeCount = 0;
function timer() {
  const date = document.getElementById('date').value;
  const form_contest = document.getElementById('form_contest');
  const info_timer = document.getElementById('info_timer');
  const divDays = document.getElementById('days');
  const divHours = document.getElementById('hours');
  const divMinutes = document.getElementById('minutes');
  const divSeconds = document.getElementById('seconds');
  document.getElementById('end-votes').style.display = 'none';

  let date_now = new Date().getTime();
  let date_end = new Date(date).getTime();
  date_end = date_end + 2 * 24 * 60 * 60 * 1000;
  let gab = date_end - date_now;
  const second = 1000;
  const minute = second * 60;
  const hour = minute * 60;
  const day = hour * 24;

  let days = Math.floor(gab / day);
  let hours = Math.floor((gab % day) / hour);
  let minutes = Math.floor((gab % hour) / minute);
  let seconds = Math.floor((gab % minute) / second);

  if (seconds.toString() !== divSeconds.innerHTML && divSeconds.innerHTML !== '') {
    divSeconds.classList.add('animated');
    setTimeout(function () {
      divSeconds.className = '';
    }, 700);
  }

  if (minutes.toString() !== divMinutes.innerHTML && divMinutes.innerHTML !== '') {
    divMinutes.classList.add('animated');
    setTimeout(function () {
      divMinutes.className = '';
    }, 700);
  }

  if (hours.toString() !== divHours.innerHTML && divHours.innerHTML !== '') {
    divHours.classList.add('animated');
    setTimeout(function () {
      divHours.className = '';
    }, 700);
  }

  if (days.toString() !== divDays.innerHTML && divDays.innerHTML !== '') {
    divDays.classList.add('animated');
    setTimeout(function () {
      divDays.className = '';
    }, 700);
  }

  divMinutes.innerHTML = minutes;
  divHours.innerHTML = hours;
  divDays.innerHTML = days;
  divSeconds.innerHTML = seconds;
  if (gab < 0) {
    divHours.innerHTML = '00';
    divMinutes.innerHTML = '00';
    divSeconds.innerHTML = '00';
    divDays.innerHTML = '00';

    divDays.classList.remove('animated');
    divHours.classList.remove('animated');
    divMinutes.classList.remove('animated');
    divSeconds.classList.remove('animated');
    document.getElementById('end-contest').innerHTML = "<p class='fs-3 end_contest'>Votes terminées !</p>";
    updateWinner();
  }
}
setInterval(timer, 1000);

function updateWinner() {
  let request = new XMLHttpRequest();
  request.open('GET', 'https://topcook.site/contest/updateContest.php', true);
  request.send();
}
